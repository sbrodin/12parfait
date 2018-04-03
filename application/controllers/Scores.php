<?php

class Scores extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
    }

    public function index()
    {
        save_log('scores', 'index');
        if (!user_can('view_scores')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('ladder');

        // Récupération des éventuels filtres
        $filters['filters_scores'] = array(
            'championship' => '',
            'fixture' => '',
        );
        if (isset($this->session->filters_scores)) {
            $filters['filters_scores'] = $this->session->filters_scores;
        }
        $post = $this->input->post();
        if (!empty($post)) {
            if ($post['submit'] == $this->lang->line('del_filter')) {
                $filters['filters_scores']['championship'] = '';
                $filters['filters_scores']['fixture'] = '';
            } else {
                $filters['filters_scores']['championship'] = ($post['championship'] == 0) ? '' : $post['championship'];
                $filters['filters_scores']['fixture'] = ($post['fixture'] == 0) ? '' : $post['fixture'];
            }
            $this->session->set_userdata($filters);
        }
        if ($filters['filters_scores']['championship'] !== '' || $filters['filters_scores']['fixture'] !== '') {
            $data['collapse_filters'] = 'in';
        } else {
            $data['collapse_filters'] = '';
        }
        $data['filters_scores'] = $filters['filters_scores'];

        // Récupération des résultats de chaque utilisateur
        $select = 'user.user_id, user_name, bet.bet_id, bet.score';
        $where = array(
            'active' => '1',
            // 'acl !=' => 'admin',
            // 'bet.score !=' => '0',
        );
        if (isset($filters['filters_scores']['championship']) && $filters['filters_scores']['championship']!='') {
            $where = array_merge($where, array('championship.championship_id' => $filters['filters_scores']['championship']));
        }
        if (isset($filters['filters_scores']['fixture']) && $filters['filters_scores']['fixture']!='') {
            $where = array_merge($where, array('fixture.fixture_id' => $filters['filters_scores']['fixture']));
        }
        // $order = 'rand()';
        $order = 'user.user_id ASC';
        $data['scores'] = $this->db->select($select)
                                   ->from($this->config->item('user', 'table'))
                                   ->where($where)
                                   ->join('bet', 'user.user_id = bet.user_id', 'left')
                                   ->join('match', 'bet.match_id = match.match_id', 'left')
                                   ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'left')
                                   ->join('championship', 'fixture.championship_id = championship.championship_id', 'left')
                                   ->order_by($order)
                                   ->get()
                                   ->result();

        $user_id = '';
        $scores = array();
        $users = array();
        foreach ($data['scores'] as $key => $score) {
            if ($score->user_id != $user_id) {
                $scores[$score->user_id] = $score->score ? $score->score : 0;
                $users[$score->user_id] = ($score->user_name == '') ? $this->lang->line('anonymous') . $score->user_id : $score->user_name;
                $user_id = $score->user_id;
            } else {
                $scores[$score->user_id]+= $score->score;
            }
            $score->user_name = ($score->user_name == '') ? $this->lang->line('anonymous') . $score->user_id : $score->user_name;
        }
        arsort($scores);
        $data['user_scores'] = $scores;
        $data['users'] = $users;

        // Récupération des championnats et journées pour les filtres
        $select = 'championship.championship_id, championship.name AS championship_name, fixture.fixture_id, fixture.name AS fixture_name';
        $where = array(
            'championship.status' => 'open',
        );
        $where_in = array(
            'ongoing',
            'close',
        );
        $order = 'championship_name ASC, cast(fixture_name AS UNSIGNED) ASC';
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
                                     ->where_in('fixture.status', $where_in)
                                     ->join('championship', 'championship.championship_id = fixture.championship_id', 'left')
                                     ->order_by($order)
                                     ->get()
                                     ->result();
        $championship = '';
        $data['championships'] = array();
        foreach ($data['fixtures'] as $key => $fixture_infos) {
            if ($fixture_infos->championship_name !== $championship) {
                $data['championships'][$fixture_infos->championship_id] = $fixture_infos->championship_name;
                $championship = $fixture_infos->championship_name;
            }
        }

        // Gestion du podium
        foreach ($data['user_scores'] as $user_id => $score) {
            $user_ladder[$score][] = $data['users'][$user_id];
        }
        if (isset($user_ladder)) {
            $user_ladder = array_values($user_ladder);
            $nb_joueurs = 0;
            foreach ($user_ladder as $key => $users) {
                // On ne remplit que les 3 premières marches du podium ($key)
                // Et on s'arrête dès qu'il y a 3 joueurs
                if ($key < 3 && $nb_joueurs <= 3) {
                    $data['rank' . ($nb_joueurs+1) . '_users'] = implode('<br>', $users);
                    $nb_joueurs+= count($users);
                }
            }
        }
        $data['rank1_users'] = isset($data['rank1_users']) ? $data['rank1_users'] : '/';
        $data['rank2_users'] = isset($data['rank2_users']) ? $data['rank2_users'] : '/';
        $data['rank3_users'] = isset($data['rank3_users']) ? $data['rank3_users'] : '/';

        // Récupération du message d'information pour les filtres du classement
        $language = $this->session->user->language;
        if (empty($language)) {
            $language = 'french';
        }
        $this->load->model('message_model');
        $data['bet_filter_message'] = $this->message_model->get_message('bet-filter-message');
        if ($data['bet_filter_message'] !== '') {
            $data['bet_filter_message'] = $data['bet_filter_message'][0]->{$language.'_content'};
        }
        $data['bet_filter_message'] = html_entity_decode($data['bet_filter_message']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('scores/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function scores($user_id = 0)
    {
        save_log('scores', 'scores');
        if (!user_can('view_scores')) {
            show_404();
        }

        $data = array();
        $data['title'] = ($user_id === $this->session->user->user_id) ? $this->lang->line('my_scores') :  $this->lang->line('scores_of_player');
        $data['required_user_id'] = $user_id;
        $data['my_user_id'] = $this->session->user->user_id;

        $select = 'user.user_id,
                   user_name,
                   first_name,
                   last_name,
                   email,
                   bet.bet_id,
                   bet.score,
                   SUM(bet.score) as total_score';
        $where = array(
            'active' => '1',
            // 'bet.score !=' => '0',
            'user.user_id' => $user_id,
            'match.result !=' => 'NULL'
        );

        $order = 'user.user_id DESC';
        $data['scores'] = $this->db->select($select)
                                   ->from($this->config->item('user', 'table'))
                                   ->where($where)
                                   ->join('bet', 'user.user_id = bet.user_id', 'left')
                                   ->join('match', 'match.match_id = bet.match_id', 'left')
                                   ->order_by($order)
                                   ->get()
                                   ->result();
        if ($data['scores'][0]->user_id === NULL) {
            $data['info'] = $this->lang->line('no_user_with_this_id');

            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('scores/my_scores', $data);
            $this->load->view('templates/footer', $data);
            return true;
        }

        // Récupération en une seule requête des stats par score
        $select = 'bet.score, count(bet_id) AS nb_score';
        $where = array(
            'bet.user_id' => $user_id,
            'active' => 1,
            'match.result !=' => 'NULL'
        );
        $group_by = 'bet.score';
        $data['all_scores'] = $this->db->select($select)
                                       ->from($this->config->item('bet', 'table'))
                                       ->where($where)
                                       ->join('user', 'bet.user_id = user.user_id', 'left')
                                       ->join('match', 'match.match_id = bet.match_id', 'left')
                                       ->group_by($group_by)
                                       ->get()
                                       ->result();
        $data['total_bets'] = 0;
        foreach ($data['all_scores'] as $key => $score) {
            $data['scores_'.$score->score] = $score->nb_score;
            $data['total_bets']+= $score->nb_score;
        }
        if (!isset($data['scores_0'])) {
            $data['scores_0'] = 0;
        }
        if (!isset($data['scores_3'])) {
            $data['scores_3'] = 0;
        }
        if (!isset($data['scores_4'])) {
            $data['scores_4'] = 0;
        }
        if (!isset($data['scores_6'])) {
            $data['scores_6'] = 0;
        }
        if (!isset($data['scores_7'])) {
            $data['scores_7'] = 0;
        }
        if (!isset($data['scores_12'])) {
            $data['scores_12'] = 0;
        }

        $user_id = '';
        $scores = array();
        $users = array();
        foreach ($data['scores'] as $key => $score) {
            if ($score->user_id != $user_id) {
                $scores[$score->user_id] = $score->score ? $score->score : 0;
                $users[$score->user_id] = ($score->user_name == '') ? $this->lang->line('anonymous') . $score->user_id : $score->user_name;
                $user_id = $score->user_id;
            } else {
                $scores[$score->user_id]+= $score->score;
            }
            $score->user_name = ($score->user_name == '') ? $this->lang->line('anonymous') . $score->user_id : $score->user_name;
        }
        arsort($scores);
        $data['user_scores'] = $scores;
        $data['users'] = $users;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('scores/my_scores', $data);
        $this->load->view('templates/footer', $data);
    }
}

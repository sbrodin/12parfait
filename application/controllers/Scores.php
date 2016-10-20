<?php

class Scores extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!user_can('view_scores')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Scores';

        // Récupération des éventuels filtres
        $filters['filters_scores'] = array(
            'championship' => '',
            'fixture' => '',
        );
        if (isset($this->session->userdata['filters_scores'])) {
            $filters['filters_scores'] = $this->session->userdata['filters_scores'];
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
        $order = 'user.user_id DESC';
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
            'fixture.status' => 'close',
            'championship.status' => 'open',
        );
        $order = 'championship_name ASC, cast(fixture_name AS UNSIGNED) ASC';
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
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

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('scores/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function scores($user_id = 0)
    {
        if (!user_can('view_scores')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Scores';
        $data['required_user_id'] = $user_id;
        $data['my_user_id'] = $this->session->userdata['user']->user_id;

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
        $query = "SELECT DISTINCT
                     (SELECT count(bet.score)
                      FROM bet
                      JOIN `match` ON match.match_id = bet.match_id
                      WHERE bet.score = 0
                          AND user_id = $user_id
                          AND match.result IS NOT NULL ) AS nb_0,
                     (SELECT count(bet.score)
                      FROM bet
                      JOIN `match` ON match.match_id = bet.match_id
                      WHERE bet.score = 6
                          AND user_id = $user_id
                          AND match.result IS NOT NULL ) AS nb_6,
                     (SELECT count(bet.score)
                      FROM bet
                      JOIN `match` ON match.match_id = bet.match_id
                      WHERE bet.score = 3
                          AND user_id = $user_id
                          AND match.result IS NOT NULL ) AS nb_3,
                     (SELECT count(bet.score)
                      FROM bet
                      JOIN `match` ON match.match_id = bet.match_id
                      WHERE bet.score = 4
                          AND user_id = $user_id
                          AND match.result IS NOT NULL ) AS nb_4,
                     (SELECT count(bet.score)
                      FROM bet
                      JOIN `match` ON match.match_id = bet.match_id
                      WHERE bet.score = 7
                          AND user_id = $user_id
                          AND match.result IS NOT NULL ) AS nb_7,
                     (SELECT count(bet.score)
                      FROM bet
                      JOIN `match` ON match.match_id = bet.match_id
                      WHERE bet.score = 12
                          AND user_id = $user_id
                          AND match.result IS NOT NULL ) AS nb_12parfait
                  FROM `user`
                  LEFT JOIN `bet` ON `user`.`user_id` = `bet`.`user_id`
                  WHERE `active` = '1'
                      AND `user`.`user_id` = 1";
        $data['all_scores'] = $this->db->query($query)->result()[0];
        $data['total_bets'] = array_sum((array)$data['all_scores']);
        $data['scores_0'] = $data['all_scores']->nb_0;
        $data['scores_3'] = $data['all_scores']->nb_3;
        $data['scores_4'] = $data['all_scores']->nb_4;
        $data['scores_6'] = $data['all_scores']->nb_6;
        $data['scores_7'] = $data['all_scores']->nb_7;
        $data['scores_12'] = $data['all_scores']->nb_12parfait;

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

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

        $select = 'user.user_id, user_name, bet.bet_id, bet.score';
        $where = array(
            'active' => '1',
            'acl !=' => 'admin',
            // 'bet.score !=' => '0',
        );

        $order = 'user.user_id DESC';
        $data['scores'] = $this->db->select($select)
                                   ->from($this->config->item('user', 'table'))
                                   ->where($where)
                                   ->join('bet', 'user.user_id = bet.user_id', 'left')
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

        $select = 'user.user_id,
                   user_name,
                   first_name,
                   last_name,
                   email,
                   bet.bet_id,
                   bet.score,
                   SUM(bet.score) as total';
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

        // Nombre 12parfait
        $select = 'user_id, count(bet.score) as nb_12parfait';
        $where = array(
            'bet.score' => '12',
            'user_id' => $user_id,
            'match.result !=' => 'NULL'
        );
        $order = 'nb_12parfait DESC';
        $data['scores_12'] = $this->db->select($select)
                                      ->from($this->config->item('bet', 'table'))
                                      ->join('match', 'match.match_id=bet.match_id')
                                      ->where($where)
                                      ->order_by($order)
                                      ->get()
                                      ->result();
        if (!$data['scores_12'][0]->user_id) {
            $data['scores_12'] = 0;
        } else {
            $data['scores_12'] = $data['scores_12'][0]->nb_12parfait;
        }

        // Nombre 7
        $select = 'user_id, count(bet.score) as nb_7';
        $where = array(
            'bet.score' => '7',
            'user_id' => $user_id,
            'match.result !=' => 'NULL'
        );
        $order = 'nb_7 DESC';
        $data['scores_7'] = $this->db->select($select)
                                     ->from($this->config->item('bet', 'table'))
                                      ->join('match', 'match.match_id=bet.match_id')
                                     ->where($where)
                                     ->order_by($order)
                                     ->get()
                                     ->result();
        if (!$data['scores_7'][0]->user_id) {
            $data['scores_7'] = 0;
        } else {
            $data['scores_7'] = $data['scores_7'][0]->nb_7;
        }

        // Nombre 6
        $select = 'user_id, count(bet.score) as nb_6';
        $where = array(
            'bet.score' => '6',
            'user_id' => $user_id,
            'match.result !=' => 'NULL'
        );
        $order = 'nb_6 DESC';
        $data['scores_6'] = $this->db->select($select)
                                     ->from($this->config->item('bet', 'table'))
                                      ->join('match', 'match.match_id=bet.match_id')
                                     ->where($where)
                                     ->order_by($order)
                                     ->get()
                                     ->result();
        if (!$data['scores_6'][0]->user_id) {
            $data['scores_6'] = 0;
        } else {
            $data['scores_6'] = $data['scores_6'][0]->nb_6;
        }

        // Nombre 4
        $select = 'user_id, count(bet.score) as nb_4';
        $where = array(
            'bet.score' => '4',
            'user_id' => $user_id,
            'match.result !=' => 'NULL'
        );
        $order = 'nb_4 DESC';
        $data['scores_4'] = $this->db->select($select)
                                     ->from($this->config->item('bet', 'table'))
                                      ->join('match', 'match.match_id=bet.match_id')
                                     ->where($where)
                                     ->order_by($order)
                                     ->get()
                                     ->result();
        if (!$data['scores_4'][0]->user_id) {
            $data['scores_4'] = 0;
        } else {
            $data['scores_4'] = $data['scores_4'][0]->nb_4;
        }

        // Nombre 3
        $select = 'user_id, count(bet.score) as nb_3';
        $where = array(
            'bet.score' => '3',
            'user_id' => $user_id,
            'match.result !=' => 'NULL'
        );
        $order = 'nb_3 DESC';
        $data['scores_3'] = $this->db->select($select)
                                     ->from($this->config->item('bet', 'table'))
                                      ->join('match', 'match.match_id=bet.match_id')
                                     ->where($where)
                                     ->order_by($order)
                                     ->get()
                                     ->result();
        if (!$data['scores_3'][0]->user_id) {
            $data['scores_3'] = 0;
        } else {
            $data['scores_3'] = $data['scores_3'][0]->nb_3;
        }

        // Nombre 0
        $select = 'user_id, count(bet.score) as nb_0';
        $where = array(
            'bet.score' => '0',
            'user_id' => $user_id,
            'match.result !=' => 'NULL'
        );
        $order = 'nb_0 DESC';
        $data['scores_0'] = $this->db->select($select)
                                     ->from($this->config->item('bet', 'table'))
                                      ->join('match', 'match.match_id=bet.match_id')
                                     ->where($where)
                                     ->order_by($order)
                                     ->get()
                                     ->result();
        if (!$data['scores_0'][0]->user_id) {
            $data['scores_0'] = 0;
        } else {
            $data['scores_0'] = $data['scores_0'][0]->nb_0;
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

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
        $where = array('active' => '1');
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
}

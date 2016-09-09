<?php

class Scores extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        if (!user_can('view_scores')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Scores';

        $select = 'user_id, user_name, score';
        $where = array('active' => '1');
        $nb = NULL;
        $limit = NULL;
        $order = 'score DESC';
        $data['scores'] = $this->user_model->read($select, $where, $nb, $limit, $order);

        foreach ($data['scores'] as $key => $score) {
            $score->user_name = ($score->user_name == '') ? $this->lang->line('anonymous') . $score->user_id : $score->user_name;
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('scores/index', $data);
        $this->load->view('templates/footer', $data);
    }
}

<?php

class Matches extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('match_model');
    }

    public function index()
    {
        $data = array();
        $data['title'] = 'Admin - Matchs';

        $this->load->model('championship_model');
        $select = '*';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = ('name ASC');
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/matches/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        $data = array();
        $data['title'] = 'Admin - Ajouter un match';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/matches/add', $data);
        $this->load->view('templates/footer', $data);
    }
}

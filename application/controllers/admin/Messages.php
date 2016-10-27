<?php

class Messages extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
    }

    public function index()
    {
        if (!user_can('view_messages')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Message';

        $select = 'message_id, name, language, content';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'message_id ASC';
        $data['messages'] = $this->message_model->read($select, $where, $nb, $debut, $order);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/messages/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        if (!user_can('add_message')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Ajouter un message';

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/teams/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'team_name',
                    'label' => $this->lang->line('team_name'),
                    'rules' => 'trim|required|is_unique[team.name]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'is_unique' => $this->lang->line('already_in_db_field'),
                    ),
                ),
                array(
                    'field' => 'team_short_name',
                    'label' => $this->lang->line('team_short_name'),
                    'rules' => 'trim|required|max_length[5]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'max_length' => $this->lang->line('too_long_5_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/teams/add', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'name' => $post['team_name'],
                    'short_name' => $post['team_short_name'],
                );
                $this->message_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('team_successful_creation'));
                redirect(site_url('admin/teams'), 'location');
                exit;
            }
        }
    }

    public function edit($message_id = 0)
    {
        if (!user_can('edit_message')) {
            redirect(site_url(), 'location');
            exit;
        }

        if ($message_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Editer un message';
        $data['message_id'] = $message_id;
        $data['message_name'] = $this->message_model->get_message_name_from_id($message_id);

        $select = 'message_id, name, language, content';
        $where = array(
            'name' => $data['message_name'],
        );
        $nb = NULL;
        $debut = NULL;
        $order = 'message_id ASC';
        $messages = $this->message_model->read($select, $where, $nb, $debut, $order);
        if (!$messages) {
            redirect(site_url(), 'location');
            exit;
        }
        foreach ($messages as $key => $message) {
            $data['message'][$message->language] = $message;
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/messages/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'team_name',
                    'label' => $this->lang->line('team_name'),
                    'rules' => 'trim|ucfirst|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'team_short_name',
                    'label' => $this->lang->line('team_short_name'),
                    'rules' => 'trim|required|max_length[5]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'max_length' => $this->lang->line('too_long_5_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/messages/edit', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $where = array('team_id' => $team_id);
                $donnees_echapees = array(
                    'name' => $post['team_name'],
                    'short_name' => $post['team_short_name'],
                );
                $this->message_model->update($where, $donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('team_successful_edition'));
                redirect(site_url('admin/teams'), 'location');
                exit;
            }
        }
    }
}

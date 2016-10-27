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

        $select = 'message_id, name, french_content, english_content';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'name ASC';
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
            $this->load->view('admin/messages/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'message_name',
                    'label' => $this->lang->line('message_name'),
                    'rules' => 'trim|required|is_unique[message.name]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'is_unique' => $this->lang->line('already_in_db_field'),
                    ),
                ),
                array(
                    'field' => 'french_content',
                    'label' => $this->lang->line('french_content'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'english_content',
                    'label' => $this->lang->line('english_content'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/messages/add', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'name' => $post['message_name'],
                    'french_content' => htmlentities($post['french_content']),
                    'english_content' => htmlentities($post['english_content']),
                );
                $this->message_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('message_successful_creation'));
                redirect(site_url('admin/messages'), 'location');
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

        $select = 'message_id, name, french_content, english_content';
        $where = array(
            'message_id' => $message_id,
        );
        $data['message'] = $this->message_model->read($select, $where);
        if (!$data['message']) {
            redirect(site_url(), 'location');
            exit;
        } else {
            $data['message'] = $data['message'][0];
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
                    'field' => 'message_name',
                    'label' => $this->lang->line('message_name'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'french_content',
                    'label' => $this->lang->line('french_content'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'english_content',
                    'label' => $this->lang->line('english_content'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
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
                $where = array(
                    'message_id' => $message_id,
                );
                $donnees_echapees = array(
                    'name' => $post['message_name'],
                    'french_content' => htmlentities($post['french_content']),
                    'english_content' => htmlentities($post['english_content']),
                );
                $this->message_model->update($where, $donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('message_successful_edition'));
                redirect(site_url('admin/messages'), 'location');
                exit;
            }
        }
    }
}

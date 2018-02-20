<?php

class Contact extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');

        if (!is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->userdata['user']->language);
        }
    }

    public function index()
    {
        save_log('contact', 'index');
        $data = array();
        $data['title'] = $this->lang->line('contact');

        // Récupération du message d'information pour les pronostics
        $language = $this->session->userdata['user']->language;
        if ($language === '') {
            $language = 'french';
        }
        $this->load->model('message_model');
        $data['contact_message'] = $this->message_model->get_message('contact-message');
        if ($data['contact_message'] !== '') {
            $data['contact_message'] = $data['contact_message'][0]->{$language.'_content'};
        }
        $data['contact_message'] = html_entity_decode($data['contact_message']);

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('contact', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'motif',
                    'label' => $this->lang->line('motif'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'message',
                    'label' => $this->lang->line('your_message'),
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
                $this->load->view('contact', $data);
                $this->load->view('templates/footer', $data);
            } else {
                // Envoi d'email pour info
                $subject = '12parfait - Contact - ' . $post['motif'];
                $body = 'Message envoyé par "' . $this->session->userdata['user']->email . '" :<br/><br/>';
                $body.= $post['message'];
                send_email_interception('stanislas.brodin@gmail.com', $subject, $body);

                $this->session->set_flashdata('success', $this->lang->line('message_successfully_sent'));
                redirect(site_url(), 'location');
                exit;
            }
        }
    }
}

<?php

class Contact extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->userdata['user']->language);
        }
    }

    public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('contact');

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
                    'label' => $this->lang->line('message'),
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

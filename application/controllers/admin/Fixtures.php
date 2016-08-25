<?php

class Fixtures extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fixture_model');
    }

    public function index()
    {
        if (!user_can('view_fixtures')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Journées';

        $this->session->unset_userdata('championship');

        $select = 'fixture_id, fixture_name, championship.name AS championship_name';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'championship_name ASC, cast(fixture_name AS UNSIGNED) ASC';
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
                                     ->join('championship', 'championship.championship_id = fixture.fixture_championship_id', 'left')
                                     ->limit($nb, $debut)
                                     ->order_by($order)
                                     ->get()
                                     ->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/fixtures/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        if (!user_can('add_fixture')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Ajouter une journée';

        $this->load->model('championship_model');
        $select = '*';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'name ASC';
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/fixtures/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'championship',
                    'label' => $this->lang->line('championship'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'fixture_name',
                    'label' => $this->lang->line('fixture_name'),
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
                $this->load->view('admin/fixtures/add', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'fixture_name' => $post['fixture_name'],
                    'fixture_championship_id' => $post['championship'],
                );
                $this->fixture_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('fixture_successful_creation'));
                if (!empty($this->session->userdata['championship'])) {
                    $this->session->set_userdata('fixture', $this->db->insert_id());
                    redirect(site_url('admin/matches/add'), 'location');
                    exit;
                } else {
                    $this->session->set_userdata('championship', $post['championship']);
                    redirect(site_url('admin/fixtures/add'), 'location');
                    exit;
                }
            }
        }
    }

    public function edit($fixture_id = 0)
    {
        if (!user_can('edit_fixture')) {
            redirect(site_url(), 'location');
            exit;
        }

        if ($fixture_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Editer une journée';

        $select = '*';
        $where = array(
            'fixture_id' => $fixture_id,
        );
        $fixture = $this->fixture_model->read($select, $where);
        if (!$fixture) {
            redirect(site_url(), 'location');
            exit;
        } else {
            $fixture = $fixture[0];
        }
        $data['fixture'] = $fixture;

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/fixtures/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'fixture_name',
                    'label' => $this->lang->line('fixture_name'),
                    'rules' => 'trim|ucfirst|required|is_unique[fixture.name]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'is_unique' => $this->lang->line('already_in_db_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/fixtures/edit', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $where = array('fixture_id' => $fixture_id);
                $donnees_echapees = array(
                    'name' => $post['fixture_name'],
                );
                $this->fixture_model->update($where, $donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('fixture_successful_creation'));
                redirect(site_url('admin/fixtures'), 'location');
                exit;
            }
        }
    }
}

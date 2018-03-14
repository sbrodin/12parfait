<?php

class User_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('user', 'table');
    }

    public function get_user_by_auth($login, $password)
    {
        $select = '*';
        $where = array('email' => $login);
        $user = $this->read($select, $where)[0];

        if (password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }

    public function in_database_email($email)
    {
        $select = '1';
        $where = array('email' => $email);
        $user = $this->read($select, $where);

        if (empty($user)) {
            return false;
        } else {
            return true;
        }
    }

    public function is_active()
    {
        if (empty($this->session->user)) {
            return false;
        }
        $user_id = $this->session->user->user_id;
        $select = '1';
        $where = array('user_id' => $user_id, 'active' => 1);
        $user = $this->read($select, $where);

        if (empty($user)) {
            return false;
        } else {
            return true;
        }
    }
}
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
            return FALSE;
        }
    }

    public function in_database_email($email)
    {
        $select = '*';
        $where = array('email' => $email);
        $user = $this->read($select, $where);

        if (empty($user)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
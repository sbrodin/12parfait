<?php

class User_model extends MY_Model {

    public function __construct()
    {
        $this->table = $this->config->item('user', 'table');
        parent::__construct();
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

    public function is_connected($login, $password)
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
}
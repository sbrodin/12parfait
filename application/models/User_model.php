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
        $where = array('email' => $login, 'password' => password_hash($password, PASSWORD_BCRYPT));
        return $this->read($select, $where));
    }
}
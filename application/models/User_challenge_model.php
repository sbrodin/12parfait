<?php

class User_challenge_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('user_challenge', 'table');
    }
}
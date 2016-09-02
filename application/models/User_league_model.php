<?php

class User_league_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('user_league', 'table');
    }
}
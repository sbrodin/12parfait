<?php

class User_league_model extends MY_Model {

    private $table = $this->config->item('user_league', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
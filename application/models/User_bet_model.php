<?php

class User_bet_model extends MY_Model {

    private $table = $this->config->item('user_bet', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
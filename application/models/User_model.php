<?php

class User_model extends MY_Model {

    private $table = $this->config->item('user', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
<?php

class Team_model extends MY_Model {

    private $table = $this->config->item('team', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
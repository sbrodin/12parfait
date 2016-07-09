<?php

class Team_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('team', 'table');
    }
}
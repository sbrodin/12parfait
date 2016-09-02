<?php

class League_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('league', 'table');
    }
}
<?php

class League_championship_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('league_championship', 'table');
    }
}
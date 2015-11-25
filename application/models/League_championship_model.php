<?php

class League_championship_model extends MY_Model {

    private $table = $this->config->item('league_championship', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
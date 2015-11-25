<?php

class League_model extends MY_Model {

    private $table = $this->config->item('league', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
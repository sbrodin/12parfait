<?php

class Match_model extends MY_Model {

    private $table = $this->config->item('match', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
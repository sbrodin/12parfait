<?php

class Championship_team_model extends MY_Model {

    private $table = $this->config->item('championship_team', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
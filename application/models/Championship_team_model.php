<?php

class Championship_team_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('championship_team', 'table');
    }
}
<?php

class Bet_model extends MY_Model {

    private $table = $this->config->item('bet', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
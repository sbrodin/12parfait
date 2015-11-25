<?php

class Championship_model extends MY_Model {

    private $table = $this->config->item('championship', 'table');

    public function __construct()
    {
        parent::__construct();
    }
}
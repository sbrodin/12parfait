<?php

class Message_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('message', 'table');
    }

    public function get_message($message_name = '')
    {
        if ($message_name === '') {
            return '';
        } else {
            $select = 'french_content, english_content';
            $where = array('name' => $message_name);
            $message = $this->read($select, $where);
            return empty($message) ? '' : $message;
        }
    }
}
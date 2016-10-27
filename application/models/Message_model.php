<?php

class Message_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('message', 'table');
    }

    public function get_message($message_name = '', $message_language = '')
    {
        if ($message_name === '' || $message_language === '') {
            return '';
        } else {
            $select = 'content';
            $where = array(
                'name' => $message_name,
                'language' => $message_language,
            );
            return empty($this->read($select, $where)) ? '' : $this->read($select, $where);
        }
    }

    public function get_message_name_from_id($message_id = 0)
    {
        if ($message_id === 0) {
            return '';
        } else {
            $select = 'message_name';
            $where = array(
                'message_id' => $message_id,
            );
            return empty($this->read($select, $where)) ? '' : $this->read($select, $where);
        }
    }
}
<?php

class Message_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('message', 'table');
    }

    public function get_message($message_name = '', $message_language = '')
    {
        if ($message_name === '') {
            return '';
        } else {
            $select = 'content';
            if ($message_language !== '') {
                $where = array(
                    'name' => $message_name,
                    'language' => $message_language,
                );
            } else {
                $where = array(
                    'name' => $message_name,
                );
            }
            return empty($this->read($select, $where)) ? '' : $this->read($select, $where);
        }
    }

    public function get_message_name_from_id($message_id = 0)
    {
        if ($message_id === 0) {
            return '';
        } else {
            $select = 'name';
            $where = array(
                'message_id' => $message_id,
            );
            return empty($this->read($select, $where)) ? '' : $this->read($select, $where)[0]->name;
        }
    }
}
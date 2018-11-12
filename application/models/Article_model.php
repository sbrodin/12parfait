<?php

class Article_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('article', 'table');
    }

    // cas où on retourne tous les articles
    public function get_articles()
    {
        $select = 'category, date, DATE_FORMAT(date, "%d/%m/%Y") AS formated_date, french_title, french_content, english_title, english_content';
        $where = array();
        $nb = null;
        $debut = null;
        $order = 'date DESC';
        $articles = $this->read($select, $where, $nb, $debut, $order);
        return empty($articles) ? array() : $articles;
    }

    // cas où on retourne un articles spécifique
    public function get_article($article_name = '')
    {
        if ($article_name === '') {
            return empty($articles) ? array() : $articles;
        } else {
            $select = 'category, date, DATE_FORMAT(date, "%d/%m/%Y") AS formated_date, french_title, french_content, english_title, english_content';
            $where = array('name' => $article_name);
            $article = $this->read($select, $where);
            return empty($article) ? '' : $article;
        }
    }
}
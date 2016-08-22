<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
  * Classe étendue du model CI
  *
  * L'extension de la classe de base permet la création, la lecture, la mise à jour,
  * la suppression et le comptage des éléments d'une table de la base de données.
  */
class MY_Model extends CI_Model {

    protected $table;

    /**
     * Insère une nouvelle ligne dans la base de données.
     */
    public function create($options_echappees = array(), $options_non_echappees = array()) {
        // Vérification des données à insérer
        if(empty($options_echappees) AND empty($options_non_echappees)) {
            return FALSE;
        }

        return (bool) $this->db->set($options_echappees)
                               ->set($options_non_echappees, NULL, FALSE)
                               ->insert($this->table);
    }

    /**
     * Récupère des données dans la base de données.
     */
    public function read($select = '*', $where = array(), $nb = NULL, $debut = NULL, $order = '') {
        return $this->db->select($select)
                        ->from($this->table)
                        ->where($where)
                        ->limit($nb, $debut)
                        ->order_by($order)
                        ->get()
                        ->result();
    }

    /**
     * Modifie une ou plusieurs lignes dans la base de données.
     */
    public function update($where, $options_echappees = array(), $options_non_echappees = array()) {
        // Vérification des données à mettre à jour
        if(empty($options_echappees) AND empty($options_non_echappees)) {
            return FALSE;
        }

        // Raccourci dans le cas où on sélectionne l'id
        if(is_integer($where)) {
            $where = array('id' => $where);
        }

        return (bool) $this->db->set($options_echappees)
                               ->set($options_non_echappees, NULL, FALSE)
                               ->where($where)
                               ->update($this->table);
    }

    /**
     * Supprime une ou plusieurs lignes de la base de données.
     */
    public function delete($where) {
        if(is_integer($where)) {
            $where = array('id' => $where);
        }

        return (bool) $this->db->where($where)
                               ->delete($this->table);
    }

    /**
     * Retourne le nombre de résultats.
     *
     * Si $champ est un array, la variable $valeur sera ignorée par la méthode where()
     */
    public function count($champ = array(), $valeur = NULL) {
        return (int) $this->db->where($champ, $valeur)
                              ->from($this->table)
                              ->count_all_results();
    }
}

/* End of file MY_Model.php */
/* Location: ./system/application/core/MY_Model.php */
<?php

class Tags_Model extends CI_Model {

    protected $table = 'tags';

    /**
     * Retorna todas as tags que podem ser utilizadas
     *
     * @param array $campos
     * @param array $where
     * @return mixed
     */
    public function all($campos = array('*'), $where = array())
    {
        $this->db->where($where);
        $this->db->select($campos);
        $resultado = $this->db->get($this->table);
        return $resultado->result();
    }

    /**
     * Retorna todas as tags relacionadas a um artigo
     *
     * @param $artigo_id
     * @param array $campos
     * @return mixed
     */
    public function allTagsByArtigo($artigo_id, $campos = array('*'))
    {
        $this->db->select($campos);
        $this->db->join('artigos_tags', 'artigos_tags.tags_id = tags.id and artigos_tags.artigos_id = '.$artigo_id, 'inner');
        $resultado = $this->db->get($this->table);
        return $resultado->result();
    }

}
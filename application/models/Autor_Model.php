<?php

class Autor_Model extends CI_Model {

    protected $table = 'autores';

    /**
     * Retorna todos os autores
     *
     * @param array $campos
     * @return mixed
     */
    public function all($campos = array('*'))
    {
        $this->db->select($campos);
        $resultado = $this->db->get($this->table);
        return $resultado->result();
    }


}
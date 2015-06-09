<?php


class Artigos_Tags_Model extends CI_Model {

    protected $table = 'artigos_tags';

    /**
     * Linka tags a um artigo
     *
     * @param $artigos_id
     * @param array $dados
     * @return bool
     */
    public function doInsert($artigos_id, array $dados = null)
    {
        if( $dados != null ) {
            // Apaga o relacionamento antigo
            $this->db->where('artigos_id', $artigos_id);
            $this->db->delete($this->table);

            // Salva os novos
            $dados = current(elements(array('tags_id'), $dados));
            foreach($dados as $tag):
                $this->db->set('artigos_id', $artigos_id);
                $this->db->set('tags_id', $tag);
                $this->db->insert($this->table);
            endforeach;

            return true;
        }
        return false;
    }

}
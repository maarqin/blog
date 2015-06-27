<?php

class Artigo_Model extends CI_Model {

    protected $table = 'artigos';

    /**
     * Get todos os registros da artigos
     *
     * @param string $type
     * @return mixed
     */
    public function all($type = 'object', $where = array())
    {
        $this->db->select(array('artigos.id', 'titulo', 'DATE_FORMAT(dtPublicacao,"%d/%m/%Y") as dtPublicacao_modified', 'autor',
            'autor_id', 'conteudo', 'status'));
        $this->db->join('autores', 'artigos.autor_id = autores.id', 'inner');
        $this->db->where($where);
        $this->db->order_by('dtPublicacao', 'desc');
        $resultado = $this->db->get($this->table);

        $artigos = $resultado->result($type);
        $this->allTagsByArtigo($artigos);
        return $artigos;
    }

    /**
     * Obtem um artigo pelo registro
     *
     * @param $id
     * @param string $type
     * @return mixed
     */
    public function getById($id, $type = 'object')
    {
        $this->db->where('id', $id);
        $resultado = $this->db->get($this->table);
        return current($resultado->result($type));
    }

    /**
     * Get meses que tiveram artigos
     *
     * @return mixed
     */
    public function archives()
    {
        $this->db->select("MONTH(dtPublicacao) as mes, YEAR(dtPublicacao) as ano, DATE_FORMAT(dtPublicacao, '%M %y') as mesAno");
        $this->db->group_by('MONTH(dtPublicacao), YEAR(dtPublicacao)');
        $resultado = $this->db->get($this->table);
        return $resultado->result();
    }

    /**
     * Searching by tag id
     *
     * @param array $where
     * @return mixed
     */
    public function allByTags(array $where)
    {
        $this->db->select(array('artigos.id', 'titulo', 'DATE_FORMAT(dtPublicacao,"%d/%m/%Y") as dtPublicacao_mod',
            'autor', 'autor_id'));
        $this->db->join('artigos_tags', 'artigos.id = artigos_tags.artigos_id', 'inner');
        $this->db->join('autores', 'artigos.autor_id = autores.id', 'inner');
        $this->db->where($where);
        $this->db->order_by('dtPublicacao', 'desc');
        $this->db->group_by('artigos.id');
        $resultado = $this->db->get($this->table);

        $artigos = $resultado->result();
        return $artigos;
    }

    /**
     * Metodo inserir registro
     *
     * @param array $dados
     */
    public function doInsert(array $dados = null)
    {
        if( $dados != null ){
            $aux = elements(array('titulo', 'conteudo', 'dtPublicacao', 'autor_id', 'status'), $dados);
            $this->db->insert($this->table, $aux);
            $this->session->set_flashdata('infoartigo', 'Novo artigo salvo com sucesso!');

            $insert_id = $this->db->insert_id();
            $this->artigos_tags->doInsert($insert_id, $dados);
            $this->session->set_flashdata('infoartigo', 'Artigo criado com sucesso!');
        }
        redirect('admin/artigo');
    }

    /**
     * Metodo de alterar um registro
     *
     * @param $id
     * @param array $dados
     */
    public function doUpdate($id, array $dados = null)
    {
        if( $dados != null ){
            $aux = elements(array('titulo', 'conteudo', 'dtPublicacao', 'autor_id', 'status'), $dados);

            $this->db->where('id', $id);
            $this->db->update($this->table, $aux);

            $this->artigos_tags->doInsert($id, $dados);

            $this->session->set_flashdata('infoartigo', 'Artigo atualizado com sucesso!');
        }
        redirect('admin/artigo');
    }

    /**
     * Metodo remover registro da tabela artigos
     *
     * @param $id
     * @return string | bool
     */
    public function doDelete($id)
    {
        $this->db->where('id', $id);
        if( !$this->db->delete($this->table) )
            return $this->db->error();
        return true;
    }

    /**
     * Metodo que vai trazer as tags de cada artigo
     * Metodo referenciado
     *
     * @param array $artigos
     */
    private function allTagsByArtigo(array &$artigos)
    {
        foreach( $artigos as &$artigo ){
            $aux = $this->tags->allTagsByArtigo($artigo['id'], array('tags.id', 'tags.tag'));
            $artigo['tags'] = $aux;
            $artigo = (object) $artigo;
        }
    }
}
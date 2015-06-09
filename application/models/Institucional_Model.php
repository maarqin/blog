<?php


class Institucional_Model extends CI_Model {

    protected $table = 'institucionais';

    /**
     * Retorna todos os registros da table institucionais
     *
     * @return mixed
     */
    public function all()
    {
        $this->db->select("id, descricao, conteudo, DATE_FORMAT(dtAlteracao, '%d/%m/%Y às %H:%i') as dtAlteracao_modified");
        $resultado = $this->db->get($this->table);
        return $resultado->result();
    }

    /**
     * Metodo carregar campos para alteracao de um registro
     *
     * @param $id
     * @param array $campos
     * @return mixed
     */
    public function getById($id, $campos = array('*'))
    {
        $this->db->select($campos);
        $this->db->where('id', $id);
        $resultado = $this->db->get($this->table);
        return current($resultado->result('object'));
    }

    /**
     * Gerar atualizaçao do registro
     *
     */
    public function doUpdate($id, array $dados = null)
    {
        if( $dados != null ){
            $this->db->where('id', $id);
            $this->db->update($this->table, $dados);
            $this->session->set_flashdata('infoinstitucional', 'Registro atualizado com sucesso!');
        }
        redirect('admin/institucional');
    }

}
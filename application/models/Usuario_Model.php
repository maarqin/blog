<?php


class Usuario_Model extends CI_Model {

    protected $table = 'usuarios';

    private $C_ERRO_EMAIL = 1;
    private $C_ERRO_SENHA = 2;
    private $C_ERRO_STATUS = 3;

    /**
     * Metodo que procura o usuario que está tentando se conectar com o sistema
     *
     * @param array $dados
     * @return boolean | int
     */
    public function findUser(array $dados)
    {
        $aux = $dados;
        $resultado = $this->db->get_where($this->table, $dados);
        if( $dados = $resultado->result() ){
            return (boolean) $resultado->num_rows();
        } else {
            $resultado = $this->db->get_where($this->table, array('email=' => $aux['email']));
            if( $dados = $resultado->result() ){
                $resultado = $this->db->get_where($this->table, array('senha=' => $aux['senha']));
                if( $dados = $resultado->result() ){
                    return (int) $this->C_ERRO_STATUS;
                }
                return (int) $this->C_ERRO_SENHA;
            }
            return (int) $this->C_ERRO_EMAIL;
        }
    }

    /**
     * Retorna o codigo do erro
     *
     * @param string $name
     * @return int
     */
    public function getC_Erro($name){
        return $this->{$name};
    }


}
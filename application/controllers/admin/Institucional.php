<?php


class Institucional extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers(array('form', 'array'));
        $this->load->model('Institucional_Model', 'institucional');
    }

    /**
     * Pagina inicial do modulo institucional dentro do backend
     */
    public function index()
    {
        $resultado = $this->institucional->all();
        $this->load->view('admin/institucional/index', compact('resultado'));
    }

    /**
     * View de atualizacao de registros institucionais
     *
     * @param $id
     */
    public function edit($id)
    {
        $dados = $this->institucional->getById($id);
        $this->load->view('admin/institucional/formulario', compact('dados'));
    }

    /**
     * Metodo que atualiza o registro de fato
     *
     */
    public function update()
    {
        $dados = $this->input->post();
        $done = elements(array('descricao', 'conteudo', 'status', 'dtAlteracao'), $dados, date('Y-m-y H:i'));
        $this->institucional->doUpdate($dados['id'], $done);
    }

}
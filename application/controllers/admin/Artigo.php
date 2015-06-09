<?php

class Artigo extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helpers(['form', 'array', 'formaters']);
        $this->load->model('Artigo_Model', 'artigo');
        $this->load->model('Autor_Model', 'autor');
        $this->load->model('Tags_Model', 'tags');
        $this->load->model('Artigos_Tags_Model', 'artigos_tags');
    }

    /**
     * Lista os artigos
     *
     */
    public function index()
    {
        $resultado = $this->artigo->all('array');
        $this->load->view('admin/artigo/index', compact('resultado'));
    }

    /**
     * Exibe formulario para criar novo artigo
     *
     */
    public function create()
    {
        $dados = (object) array(
            'autores' => formated_dropdown($this->autor->all(array('id', 'autor as name'))),
            'all_tags' => formated_dropdown($this->tags->all(array('id', 'tag as name')))
        );
        $this->load->view('admin/artigo/create', compact('dados'));
    }

    /**
     * Salva novo artigo
     *
     */
    public function store()
    {
        $dados = $this->input->post();

        $this->artigo->doInsert($dados);
    }

    /**
     * Exibe formulario de alteracao de um artigo
     *
     * @param $id
     */
    public function edit($id)
    {
        $dados = (object) array(
            'dados'=>  $this->artigo->getById($id),
            'autores'=>formated_dropdown($this->autor->all(array('id', 'autor as name'))),
            'all_tags'=>formated_dropdown($this->tags->all(array('id', 'tag as name'))),
            'tags_selected'=>formated_dropdown($this->tags->allTagsByArtigo($id, array('id')))
        );
        $this->load->view('admin/artigo/edit', compact('dados'));
    }

    /**
     * Retorna o numero de registros alterados
     *
     * @return mixed
     */
    public function update()
    {
        $dados = $this->input->post();
        $this->artigo->doUpdate($dados['id'], $dados);
    }

    /**
     * Confirmar a exclusao
     *
     */
    public function remove($id)
    {
        $dados = (object) array(
            'controller'=>'admin/artigo/',
            'id'=>$id
        );
        $this->load->view('admin/default/remove', compact('dados'));
    }

    /**
     * Finaliza a exclusao
     * Se falhar exibe o erro
     *
     */
    public function destroy($id)
    {
        $exclusao = $this->artigo->doDelete($id);
        if( $exclusao !== true ){
            $this->session->set_flashdata('erroaoexcluir', "Error(".$exclusao['code']."): ".$exclusao['message']);

            redirect('admin/artigo/remove/'.$id);
        }
        redirect('admin/artigo');
    }

}
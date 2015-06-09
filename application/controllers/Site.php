<?php

class Site extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers(array('url'));
        $this->load->model('Artigo_Model', 'artigo');
        $this->load->model('Institucional_Model', 'institucional');
        $this->load->model('Tags_Model', 'tags');
    }

    /**
     * Index do blog
     */
    public function index()
    {
        $resultado = array(
            'artigos'=>$this->artigo->all('array', array('status' => 1)),
            'sobre'=>$this->institucional->getById(1),
            'archives'=>$this->artigo->archives(),
        );

        $this->load->view('site/index', $resultado);
    }

    /**
     * Pagina de contato
     */
    public function contato()
    {
        echo "Contato";
    }

    /**
     * Procurar algo dentro do blog
     *
     * @param $where
     * @param $how
     * @return string
     */
    public function search($where, $how){

//        $resultado = $this->{$where}->all(array('*'), array('id' => $how));
//
//        print_r($resultado);

        $this->load->view('site/search');
    }

}
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
     * Home page
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
     * About me page
     */
    public function sobre_mim()
    {
        echo "Sobre mim";
    }

    /**
     * Contact page
     */
    public function contato()
    {
        echo "Contato";
    }

    /**
     * Searching something into blog
     *
     * @param $what
     * @param $how
     */
    public function search($what, $how)
    {
        $artigos = $this->{$what}->allByTags(array('artigos_tags.tags_id' => $how));

        $this->load->view('site/search', compact('artigos'));
    }

}
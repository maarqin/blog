<?php

class Authentication extends CI_Controller {

    /**
     * Tela de autenticacao de usuario
     * Verifica se já há uma sessao aberta para este usuario
     *
     */
    public function index()
    {
        if( $this->session->userdata('auth_admin') == null ){
            $this->load->view('admin/authentication/index');
            return;
        }
        redirect('admin/dashboard');
    }

    public function login()
    {
        if( !$this->authentication_library->login() ) $this->load->view('admin/authentication/index');
    }

    public function logout()
    {
        $this->authentication_library->logout();
    }

}
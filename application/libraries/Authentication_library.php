<?php

class Authentication_library extends CI_Controller {

    private $ci;
    const STATUS_PROCURAR = 1;

    public function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->load->helpers(['form', 'array']);
        $this->ci->load->model(['Usuario_Model' => 'usuario']);
        $this->ci->load->library(['form_validation']);

        $this->concierge();
    }

    /**
     * Main function
     * It designs a user login itself to system
     *
     * @return bool
     */
    public function login()
    {
        if( $this->validateForm() == false ) return false;

        $dados = $this->ci->input->post();

        if (isset($dados['lembrarMe'])) $this->rememberMe($dados);

        $dados['status'] = self::STATUS_PROCURAR;
        $dados['senha'] = md5($dados['senha']);

        $authenticated = $this->findUser($dados);
        if( $authenticated === true ) {
            $this->setUser();
        } else {
            $failsLoginMessage = $this->setFailsLogin($authenticated);

            $this->ci->session->set_flashdata('usuarionaoencontrado', $failsLoginMessage);
        }
        redirect('admin');

        return true;
    }

    /**
     * Clean the actual user session
     *
     */
    public function logout()
    {
        $this->unsetUser();
        redirect('admin');
    }

    /**
     * Form validation login
     *
     * @return boolean
     */
    private function validateForm()
    {
        $this->ci->form_validation->set_rules("email", "EMAIL", "trim|required|valid_email");
        $this->ci->form_validation->set_rules("senha", "SENHA", "trim|required|min_length[4]");
        $resultado = $this->ci->form_validation->run();
        return $resultado;
    }

    /**
     * Sets a msg to user about fails to execute login
     *
     * @param $c_erro
     * @return string
     */
    private function setFailsLogin($c_erro)
    {
        if( $c_erro == $this->ci->usuario->getC_Erro('C_ERRO_EMAIL') ){
            return "Email informado é inválido";
        } elseif( $c_erro == $this->ci->usuario->getC_Erro('C_ERRO_SENHA') ){
            return "Senha informada não confere com o email";
        }
        return "Este usuário encontra-se indisponível no sistema";
    }

    /**
     * To validate a user
     *
     * @param array $dados
     * @return int
     */
    private function findUser(array $dados)
    {
        return $this->ci->usuario->findUser($dados);
    }

    /**
     * Create a new session to enable the user to navigate in the system
     *
     */
    private function setUser()
    {
        $this->ci->session->set_userdata('auth_admin', md5(date('Y-m-d H:i:s')));
    }

    /**
     * Remove the cookie
     *
     */
    private function unsetUser()
    {
        $this->ci->session->unset_userdata('auth_admin');
    }

    /**
     * Function to remember users
     *
     * @param array $dados
     */
    private function rememberMe(array &$dados)
    {
        unset($dados['lembrarMe']);
    }

    /**
     * Always check if exists conditions to user keep itself logged
     * Put it out an invalid user
     *
     */
    private function concierge()
    {
        $uri = $this->ci->uri->uri_string();
        if( !strstr($uri, "authentication") ) {
            if ((bool)preg_match("/admin\/([a-zA-Z0-9]+)/", $uri)) {
                if ($this->ci->session->userdata('auth_admin') != null) return;

                $this->ci->session->set_flashdata('usuarionaoencontrado', "Oops, você deve fazer o login antes");
                redirect('admin');
            }
        }
    }

}
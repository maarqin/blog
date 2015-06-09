<?php

class AuthenticationLibrary {

    private $ci;

    const STATUS_PROCURAR = 1;

    public function __construct()
    {
        $this->ci =& get_instance();

        $this->ci->load->helpers(['form', 'array']);
        $this->ci->load->model('Autenticacao_Model', 'auth');
        $this->ci->load->library(['form_validation']);
    }

    /**
     * Metodo de autenticacao e login do usuario
     * Testa se o formulario foi preenchido com os informacoes e tipos corretos
     *
     */
    public function signIn()
    {
        // Regras basicas do formulario de login
        if( $this->validarFormulario() == false ) {
            $this->load->view('admin/autenticacao/index');
            return;
        }

        // Dados vindos do post[email e senha]
        $dados = $this->input->post();

        // Verifica se a opcao lembrar-me foi marcada
        if (isset($dados['lembrarMe'])) {
            $this->lembrarMe($dados);
        }
        // Prepara dados
        $dados['status'] = self::STATUS_PROCURAR;
        $dados['senha'] = md5($dados['senha']);

        // Finalmente verifica se o usuario e valido e trata se nao for
        $authUsuario = $this->authUsuario($dados);
        if( $authUsuario === true ) {
            $this->setNewUsuario();
            redirect('admin');
        } else {
            if( $authUsuario != $this->auth->getC_Erro('C_ERRO_EMAIL') ) $email = $dados['email'];

            $msgFalhaLogin = $this->definirFalhaLogin($authUsuario);

            $this->session->set_flashdata('usuarionaoencontrado', $msgFalhaLogin);
        }
        $this->load->view('admin/autenticacao/index', compact('email'));
    }

    /**
     * Limpar a sessao do usuario
     *
     */
    public function logout()
    {
        $this->unsetUsuario();
        redirect('admin');
    }

    /**
     * Validacao do formulario de login de acesso ao admin
     *
     * @return boolean
     */
    private function validarFormulario()
    {
        $this->form_validation->set_rules("email", "EMAIL", "trim|required|valid_email");
        $this->form_validation->set_rules("senha", "SENHA", "trim|required|min_length[4]");
        $resultado = $this->form_validation->run();
        return $resultado;
    }

    /**
     * Define uma msg ao usuario sobre a falha ao executar o login
     *
     * @param $c_erro
     * @return string
     */
    private function definirFalhaLogin($c_erro)
    {
        if( $c_erro == $this->auth->getC_Erro('C_ERRO_EMAIL') ){
            return "Email informado é inválido";
        } elseif( $c_erro == $this->auth->getC_Erro('C_ERRO_SENHA') ){
            return "Senha informada não confere com o email";
        }
        return "Este usuário encontra-se indisponível no sistema";
    }

    /**
     * Validar um usuario de fato no banco de dados
     *
     * @param array $dados
     * @return int
     */
    private function authUsuario(array $dados)
    {
        return $this->auth->authUsuario($dados);
    }

    /**
     * Cria uma sessao que autoriza o usuario a navegar pelo sistema
     *
     */
    private function setNewUsuario()
    {
        $this->session->set_userdata('auth_admin', md5(date('Y-m-d H:i:s')));
    }

    /**
     * Remove a autorizacao que havia ao usuario
     *
     */
    private function unsetUsuario()
    {
        $this->session->unset_userdata('auth_admin');
    }

    /**
     * Metodo lembrar-me
     *
     * @param array $dados
     */
    private function lembrarMe(array &$dados)
    {
        unset($dados['lembrarMe']);
    }

}
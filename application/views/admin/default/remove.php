<?php $this->load->view('admin/default/header') ?>
<?php $this->load->view('admin/default/menu') ?>

<div class="container">

    <?php if( $this->session->flashdata('erroaoexcluir') ): ?>
        <?= '<p class="bg-warning" style="padding: 15px">' . $this->session->flashdata('erroaoexcluir') . '</p>' ?>
    <?php endif; ?>

    <div class="jumbotron">
        <h1>Continuar?</h1>
        <p>Ao continuar, você estará removendo um registro da sua base de dados, remoção esta que poderá ocasionar danos aos
        relatórios, outros cadastros, etc.</p>

        <p>
            <?= anchor($dados->controller, 'Não, voltar', array('class'=>'btn btn-lg btn-primary', 'role'=>'button')) ?>
            <?= anchor($dados->controller.'destroy/'.$dados->id, 'Sim, apagar registro',
                array('class'=>'btn btn-lg btn-danger', 'role'=>'button')) ?>
        </p>
    </div>
</div>

<?php $this->load->view('admin/default/footer') ?>
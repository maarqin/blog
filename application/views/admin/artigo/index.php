<?php $this->load->view('admin/default/header') ?>
<?php $this->load->view('admin/default/menu') ?>

<div class="container">

    <h1>Artigos</h1>
    <hr/>

    <?php if( $this->session->flashdata('infoartigo') ): ?>
        <p class="bg-success" style="padding: 15px"><?= $this->session->flashdata('infoartigo') ?></p>
    <?php endif; ?>

    <?= anchor('admin/artigo/create', 'Criar novo', array('class' => 'btn btn-success')) ?>
    <?= anchor('admin/artigo', 'Recarregar', array('class' => 'btn btn-default')) ?>

    <br>
    <br>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Título</th>
            <th>Data da publicação</th>
            <th>Autor</th>
            <th></th>
        </tr>
        <tbody>

        <?php foreach( $resultado as $dados ): ?>
            <tr>
                <td><?= $dados->titulo ?></td>
                <td><?= $dados->dtPublicacao_modified ?></td>
                <td><?= $dados->autor ?></td>
                <td>
                    <?= anchor('admin/artigo/edit/' . $dados->id, 'Editar', array('class' => 'btn btn-sm btn-primary')) ?>
                    <?= anchor('admin/artigo/remove/' . $dados->id, 'Apagar', array('class' => 'btn btn-sm btn-danger')) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php $this->load->view('admin/default/footer') ?>

<?php $this->load->view('admin/default/header') ?>
<?php $this->load->view('admin/default/menu') ?>

<div class="container">

    <h1>Institucional</h1>
    <hr/>

    <?php if( $this->session->flashdata('infoinstitucional') ): ?>
        <p class="bg-success" style="padding: 15px"><?= $this->session->flashdata('infoinstitucional') ?></p>
    <?php endif; ?>

    <?= anchor('admin/institucional', 'Recarregar', array('class' => 'btn btn-default')) ?>

    <br>
    <br>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Descrição</th>
            <th>Última alteração</th>
            <th></th>
        </tr>
        <tbody>
        <?php foreach( $resultado as $dados ): ?>
            <tr>
                <td><?= $dados->descricao ?></td>
                <td><?= $dados->dtAlteracao_modified ?></td>
                <td>
                    <?= anchor('admin/institucional/edit/' . $dados->id, 'Editar', array('class' => 'btn btn-sm btn-primary')) ?>
                    <?= anchor('admin/institucional/remove/' . $dados->id, 'Apagar', array('class' => 'btn btn-sm btn-danger disabled')) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php $this->load->view('admin/default/footer') ?>

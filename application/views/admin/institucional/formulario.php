<?php $this->load->view('admin/default/header') ?>
<?php $this->load->view('admin/default/menu') ?>

<div class="container">

    <h1>Institucional</h1>
    <hr/>
    <?= form_open('admin/institucional/update', array('class' => 'form-horizontal', 'role' => 'form', 'autocomplete'=>'off')) ?>
    <?= form_hidden('id', $dados->id) ?>
    <div class="form-group">
        <?= form_label('Descrição', 'descricao', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_input(array('name' => 'descricao', 'class' => 'form-control', 'id' => 'descricao'), $dados->descricao) ?>
        </div>
    </div>

    <div class="form-group">
        <?= form_label('Conteúdo', 'conteudo', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_textarea(array('name' => 'conteudo', 'class' => 'form-control', 'id' => 'conteudo'), $dados->conteudo) ?>
        </div>
    </div>

    <div class="form-group">
        <?= form_label('Status', 'status', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_label(form_radio(array('name' => 'status', 'id'=>'ativo'), 1, ($dados->status == 1) ? true : false) . 'Ativo', 'ativo', array('class' => 'radio-inline')) ?>
            <?= form_label(form_radio(array('name' => 'status', 'id'=>'inativo'), 0, ($dados->status == 0) ? true : false) . 'Inativo', 'inativo', array('class' => 'radio-inline')) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <?= anchor('admin/institucional', 'Cancelar', array('class' => 'btn btn-default')) ?>
        </div>
    </div>
    <?= form_close() ?>

</div>

<?php $this->load->view('admin/default/footer') ?>

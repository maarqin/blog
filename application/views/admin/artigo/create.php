<?php $this->load->view('admin/default/header') ?>
<?php $this->load->view('admin/default/menu') ?>

<div class="container">

<h1>Artigos</h1>
<hr/>
<?= form_open('admin/artigo/store', array('class' => 'form-horizontal', 'role' => 'form', 'autocomplete'=>'off')) ?>
    <div class="form-group">
        <?= form_label('Título', 'titulo', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_input(array('name' => 'titulo', 'class' => 'form-control', 'id' => 'titulo'), null) ?>
        </div>
    </div>

    <div class="form-group">
        <?= form_label('Conteúdo', 'conteudo', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_textarea(array('name' => 'conteudo', 'class' => 'form-control', 'id' => 'conteudo')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= form_label('Data da publicação', 'dtPublicacao', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_input(array('name' => 'dtPublicacao', 'class' => 'form-control', 'id' => 'dtPublicacao', 'type' => 'date'), null) ?>
        </div>
    </div>

    <div class="form-group">
        <?= form_label('Tags', 'tags_id', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_dropdown(array('name' => 'tags_id[]', 'class' => 'form-control', 'id' => 'tags_id'), $dados->all_tags, array(), array('multiple'=>'multiple')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= form_label('Autor', 'autor_id', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_dropdown(array('name' => 'autor_id', 'class' => 'form-control', 'id' => 'autor_id'), $dados->autores) ?>
        </div>
    </div>

    <div class="form-group">
        <?= form_label('Status', 'status', array('class' => 'control-label col-sm-2')) ?>
        <div class="col-sm-8">
            <?= form_label(form_radio(array('name' => 'status', 'id'=>'ativo'), 1, false) . 'Ativo', 'ativo', array('class' => 'radio-inline')) ?>
            <?= form_label(form_radio(array('name' => 'status', 'id'=>'inativo'), 0, true) . 'Inativo', 'inativo', array('class' => 'radio-inline')) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <?= anchor('admin/artigo', 'Cancelar', array('class' => 'btn btn-default')) ?>
        </div>
    </div>
<?= form_close() ?>

</div>

<?php $this->load->view('admin/default/footer') ?>

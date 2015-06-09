<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
<!--    <link rel="icon" href="../../favicon.ico">-->

    <title>Signin Template for Bootstrap</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/signin.css" rel="stylesheet">

    <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!--[if lt IE 9]>
    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <?= validation_errors('<p class="bg-danger" style="padding: 15px">','</p>') ?>

    <?php if( $this->session->flashdata('usuarionaoencontrado') ): ?>
        <?= '<p class="bg-warning" style="padding: 15px">' . $this->session->flashdata('usuarionaoencontrado') . '</p>' ?>
    <?php endif; ?>

    <?= form_open('admin/autenticacao/signin', array('class' => 'form-signin')) ?>
        <h2 class="form-signin-heading">Entrar no sistema</h2>
        <?= form_label('Email', 'inputEmail', array('class' => 'sr-only')) ?>
        <?= form_input(array('name'=>'email','class'=>'form-control','required'=>'required','autofocus'=>'autofocus',
            'placeholder'=>'Email','id'=>'inputEmail','type'=>'email'), @$email) ?>
        <?= form_label('Senha', 'inputPassword', array('class' => 'sr-only')) ?>
        <?= form_input(array('name'=>'senha','class'=>'form-control','required'=>'required',
            'placeholder'=>'Senha','id'=>'inputPassword','type'=>'password'), null) ?>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="lembrarMe" value="1"> Lembrar-me
            </label>
        </div>

        <?= form_button(array('class'=>'btn btn-lg btn-primary btn-block','type'=>'submit'), 'Entrar') ?>
    <?= form_close() ?>

</div>

<script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>

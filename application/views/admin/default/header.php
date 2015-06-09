<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex">
<!--    <link rel="icon" href="imagens/favicon.ico">-->

    <title>Backend - we coding for humans.</title>

    <?= link_tag('css/bootstrap.min.css') ?>
    <?= link_tag('css/navbar-fixed-top.css') ?>
    <?php if( isset($css) ): ?>
        <?php foreach($css as $extra): ?>
            <?= link_tag($extra) ?>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>
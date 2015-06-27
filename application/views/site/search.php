<?php $this->load->view('site/default/header') ?>
<?php $this->load->view('site/default/menu') ?>

    <style type="text/css">
        .page-header:last-child {
            border-bottom: none;
        }
    </style>
    <div class="container">
        <?php $this->load->view('site/default/title') ?>

        <h2>Results 🔍</h2>
        <?php foreach( $artigos as $artigo ): ?>

            <div class="page-header">
                <h3><a href="#"><?= $artigo->titulo ?></a></h3>
            <p>Criado em <?= $artigo->dtPublicacao_mod ?> por <?= $artigo->autor ?></p>
            </div>

        <?php endforeach; ?>

    </div>

<?php $this->load->view('site/default/footer') ?>
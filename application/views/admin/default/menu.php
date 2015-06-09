<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
            <?= anchor('/', '~/ we coding for humans;', array('class' => 'navbar-brand', 'target' => '_blank')) ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="<?php if("dashboard" == $this->uri->segment(2)) echo "active"; ?>">
                    <?= anchor('admin/dashboard', 'Dashboard') ?>
                </li>
                <?= $this->menu->html ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><?= anchor('#', 'Sua conta') ?></li>
                <li><?= anchor('admin/autenticacao/logout', 'Sair') ?></li>
            </ul>
        </div>
    </div>
</nav>
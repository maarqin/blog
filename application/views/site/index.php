<?php $this->load->view('site/default/header') ?>
<?php $this->load->view('site/default/menu') ?>

<div class="container">

    <?php $this->load->view('site/default/title') ?>

    <div class="row">

        <div class="col-sm-8 blog-main">

            <?php foreach( $artigos as $artigo ): ?>

                <div class="blog-post">
                    <h2 class="blog-post-title"><?= $artigo->titulo ?></h2>
                    <p class="blog-post-meta"><?= $artigo->dtPublicacao_modified ?> por <?= anchor('autor/' . $artigo->autor_id, $artigo->autor)?></p>

                    <p><?= nl2br($artigo->conteudo) ?></p>
                    <hr/>

                    <?php if( !empty($artigo->tags) ): ?>
                    <h6><strong>Tags:</strong>
                        <?php foreach( $artigo->tags as $tag ): ?>
                            <?= anchor('search/tags/'.$tag->id, '<code>#' . $tag->tag . '</code>').PHP_EOL ?>
                        <?php endforeach; ?>
                    </h6>
                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

            <nav>
                <ul class="pager">
                    <li><a href="#">Previous</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </nav>

        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <?php if( $sobre->status == 1 ): ?>
            <div class="sidebar-module sidebar-module-inset">
                <h4><?= $sobre->descricao ?></h4>
                <p><?= nl2br($sobre->conteudo) ?></p>
            </div>
            <?php endif; ?>
            <div class="sidebar-module">
                <h4>Archives</h4>
                <ol class="list-unstyled">
                    <?php foreach( $archives as $archive ): ?>
                        <?= anchor('#/' . $archive->mes . '/' . $archive->ano, $archive->mesAno) ?>
                    <?php endforeach; ?>

                </ol>
            </div>
            <div class="sidebar-module">
                <h4>Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><?= anchor('http://github.com/maarqin', 'GitHub') ?></li>
                    <li><?= anchor('http://www.fb.com/maarqin', 'Facebook') ?></li>
                </ol>
            </div>
        </div>

    </div>

</div>

<?php $this->load->view('site/default/footer') ?>
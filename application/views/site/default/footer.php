<footer class="blog-footer">
    <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a></p>
    <p>
        <a href="#">Voltar pra cima</a>
    </p>
</footer>

<!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="/js/ie-emulation-modes-warning.js"></script>
<!--[if lt IE 9]>
<script src="/js/html5shiv.min.js"></script>
<script src="/js/respond.min.js"></script>
<![endif]-->

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/ie10-viewport-bug-workaround.js"></script>

<?php if( isset($js) ): ?>
    <?php foreach($js as $extra): ?>
        <?= '<script src="'.base_url($extra).'" type="text/javascript"></script>' ?>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>

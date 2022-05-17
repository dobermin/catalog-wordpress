<?php $name = get_bloginfo('name') ?>
<footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
    <div class="container-fluid tm-container-small">
        <div class="row">
            <?php if ($name) : ?>
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">About <?= $name ?></h3>
                    <?php
                    echo get_option('catalog_post_in_footer');
                    ?>
                </div>
            <?php endif; ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                <h3 class="tm-text-primary mb-4 tm-footer-title"><?php _e('Our Links', 'catalog'); ?></h3>
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container' => false,
                    'menu_class' => 'tm-footer-links pl-0',
                    'menu_id' => '',
                    'before' => '',
                    "after" => '',
                    'menu' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'link_before' => '',
                    'link_after' => ''
                )); ?>
            </div>
            <?php if ($socials = get_option('catalog_social')) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <ul class="tm-social-links pl-0 col-10 d-flex flex-wrap">
                        <?php foreach ($socials as $key => $value) : ?>
                            <?php if (!$value) continue; ?>
                            <li class="mb-2"><a href="<?= $value ?>"><i class="fab fa-<?= strtolower($key) ?>"></i></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-12 px-5 mb-3">
                Copyright &copy; <?php echo date('Y');
                if ($name) echo " " . $name ?> Company. All rights reserved.
            </div>
            <div class="col-lg-4 col-md-5 col-12 px-5 text-right">
                Designed by <a href="https://templatemo.com" class="tm-text-gray" rel="sponsored" target="_parent">TemplateMo</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

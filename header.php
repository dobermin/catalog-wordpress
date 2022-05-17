<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <?php if (has_custom_logo()) : ?>
            <i class="fas fa-film mr-2">
                <?php the_custom_logo(); ?>
            </i>
        <?php endif; ?>
        <?php if (display_header_text()) : ?>
            <a class="navbar-brand" href="<?= esc_url(home_url('/')) ?>">
                <?= get_bloginfo('name') ?>
            </a>
        <?php endif; ?>

        <?php if (has_nav_menu('header-menu')) : ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'navbar-nav ml-auto mb-2 mb-lg-0',
                    'menu_id' => '',
                    'before' => '<li class="nav-item">',
                    "after" => '</li>',
                    'menu' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'walker' => new My_Walker_Nav_Menu()
                )); ?>
            </div>
        <?php endif; ?>
    </div>
</nav>

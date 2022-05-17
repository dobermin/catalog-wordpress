<?php
$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$jpg = explode('.', $image[0]);
$format = $jpg[count($jpg) - 1];
$licence = get_option('catalog_licence');
$ctn = get_option('catalog_posts_on_page');
?>
<div class="container-fluid tm-container-content tm-mt-60">
    <div class="row mb-4">
        <h2 class="col-12 tm-text-primary"><?= the_title() ?></h2>
    </div>
    <div class="row tm-mb-90">
        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
            <img class="img-fluid" src="<?= $image[0] ?>" alt="<?= the_title() ?>"/>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
            <div class="tm-bg-gray tm-video-details">
                <h3 class="tm-text-gray-dark mb-3">License</h3>
                <p><?= $licence ?></p>
                <div class="text-center mb-5">
                    <a href="<?= $image[0] ?>" download="<?= the_title() ?>-<?= md5(rand()) ?>.<?= $format ?>"
                       class="btn btn-primary tm-btn-big"><?php _e('Download', 'catalog') ?></a>
                </div>
                <?php if ($jpg) : ?>
                    <div class="mb-4 d-flex flex-wrap">
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Dimension: </span><span
                                    class="tm-text-primary"><?= $image[1] ?><span>x</span><?= $image[2] ?></span>
                        </div>
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark"><?= __('Format', 'catalog') ?>: </span><span
                                    class="tm-text-primary"><?= $format ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <h2 class="col-12 tm-text-primary">
            <?= __('Related Photos', 'catalog'); ?>
        </h2>
    </div>
    <?php if ($ctn) : ?>
        <?php
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => $ctn,
            'post__not_in' => array(get_post()->ID)
        );

        $query = new WP_Query($args);
        ?>
        <div class="row mb-3 tm-gallery">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('template-parts/content', 'post'); ?>
            <?php endwhile;
            wp_reset_query(); ?>
        </div> <!-- row -->
    <?php endif; ?>
</div>
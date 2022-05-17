<?php get_header() ?>
<?php get_template_part('template-parts/content', 'photo-without-form'); ?>
    </div>
    <div class="container-fluid tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                <?= get_the_title() ?>
            </h2>
        </div>
        <div class="row tm-mb-74 tm-row-1640">
            <div class="col-lg-5 col-md-6 col-12 mb-3">
                <img src="<?= get_the_post_thumbnail_url() ?>"
                     alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>"
                     class="img-fluid">
            </div>
            <div class="col-lg-7 col-md-6 col-12">
                <div class="tm-about-img-text">
                    <?= get_the_content() ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>
<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
    <figure class="effect-ming tm-video-item">
        <?php if (get_post()->post_type === 'video') : ?>
            <?php video_controls(); ?>
        <?php else : ?>
            <?= get_template_part('template-parts/content', 'img'); ?>
        <?php endif; ?>
        <figcaption class="d-flex align-items-center justify-content-center">
            <h2><?= the_title() ?></h2>
            <a href="<?= get_the_permalink() ?>">View more</a>
        </figcaption>
    </figure>
    <div class="d-flex justify-content-between tm-text-gray">
        <span class="tm-text-gray-light"><?php the_time('j M Y'); ?></span>
    </div>
</div>
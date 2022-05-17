<div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-5">
    <?php $url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/img/avatar.png'; ?>
    <img src="<?= $url ?>" alt="Image" class="mb-4 img-fluid">
    <h2 class="tm-text-primary mb-4"><?= get_the_title() ?></h2>
    <h3 class="tm-text-secondary h5 mb-4"><?= get_post_meta(get_post()->ID, 'team_position', true) ?></h3>
    <p class="mb-4">
        <?= get_the_content() ?>
    </p>
    <?php if ($socials = get_post_meta(get_post()->ID, 'team_social[]', true)) : ?>
        <ul class="tm-social pl-0 mb-0">
            <?php foreach ($socials as $key => $value) :
                if (empty($value)) continue;
                echo '<li><a href="' . $value . '"><i class="fab fa-' . $key . '"></i></a></li>';
            endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
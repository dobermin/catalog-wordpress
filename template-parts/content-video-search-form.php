<div class="tm-hero d-flex justify-content-center align-items-center" id="tm-video-container">
    <video autoplay="" muted="" loop="" id="tm-video" style="">
        <source src="<?= get_template_directory_uri() . '/assets/video/hero.mp4'; ?>" type="video/mp4">
    </video>
    <i id="tm-video-control-button" class="fas fa-pause"></i>
    <?= get_search_form() ?>
</div>
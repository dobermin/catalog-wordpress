<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll"
     data-image-src="<?php if ($image = wp_get_attachment_image_src(get_option('catalog_search_bg'), 'full')) echo $image[0]; else echo get_template_directory_uri() . '/assets/img/hero.jpg'; ?>">
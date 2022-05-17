<?php get_header() ?>
<?php
$ctn = get_option('catalog_posts_on_page');
global $paged;
global $pagination;
global $query;
if ($ctn) :

    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

    $args = array(
        'post_type' => 'video',
        'posts_per_page' => $ctn,
        'paged' => $paged
    );

    $query = new WP_Query($args);
    ?>
    <?php get_template_part('template-parts/content', 'video-search-form'); ?>
    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Latest Videos
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <label>Page <span class="tm-text-primary"><?= $paged . "</span> of " . $query->max_num_pages ?>
                </label>
            </div>
        </div>
        <div class="row tm-mb-90 tm-gallery">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('template-parts/content', 'post'); ?>
            <?php endwhile; ?>
        </div>
        <?php
        get_template_part('template-parts/content', 'pagination');
        thePagination($query, $paged);
        ?>
        <?php wp_reset_query(); ?>
    </div>
<?php endif; ?>
<?php get_footer() ?>
<?php get_header() ?>
<?php
$ctn = get_option('catalog_posts_on_page');
global $paged;
global $pagination;
global $query;
if ($ctn) :

    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $post_type = (str_contains(wp_get_referer(), 'videos')) ? 'video' : 'photo';

    $args = array(
        'posts_per_page' => $ctn,
        'paged' => $paged,
        's' => get_search_query(),
        'post_type' => $post_type
    );

    $query = new WP_Query($args);
    ?>
    <?php get_template_part('template-parts/content', $post_type . '-search-form'); ?>
    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                <?php
                printf(esc_html__('Search Results for: %s', 'catalog'), '<span>' . get_search_query() . '</span>');
                ?>
            </h2>
        </div>
        <div class="row tm-mb-90 tm-gallery">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php get_template_part('template-parts/content', 'post'); ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p><?php _e('No entries', 'catalog') ?></p>
            <?php endif; ?>
        </div>
        <?php
        get_template_part('template-parts/content', 'pagination');
        thePagination($query, $paged);
        ?>
    </div> <!-- container-fluid, tm-container-content -->
<?php endif; ?>
<?php get_footer() ?>

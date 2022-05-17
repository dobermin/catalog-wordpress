<?php

require_once __DIR__ . "/MyWalker.php";
require_once __DIR__ . '/catalog_metabox-team.php';
require_once __DIR__ . '/catalog_metabox-video.php';

function catalog_setup()
{
    load_theme_textdomain('catalog', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    register_nav_menus(
        array(
            'header-menu' => esc_html__('Header', 'catalog'),
            'footer-menu' => esc_html__('Footer', 'catalog'),
        )
    );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    add_theme_support(
        'custom-background',
        apply_filters(
            'catalog_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support(
        'custom-logo',
        array(
            'height' => 32,
            'width' => 32,
            'flex-width' => false,
            'flex-height' => false,
            'unlink-homepage-logo' => true,
            'header-text' => '',
        )
    );
    add_theme_support('post-formats', array('image', 'video'));

    register_post_type('photo', [
        'label' => 'Photos',
        'labels' => array(
            'name' => 'Photos',
            'singular_name' => 'Photo',
            'menu_name' => 'Photos',
            'all_items' => 'Все фото',
            'add_new' => 'Добавить фото',
            'add_new_item' => 'Добавить новое фото',
            'edit' => 'Редактировать',
            'edit_item' => 'Редактировать фото',
            'new_item' => 'Новое фото',
        ),
        'description' => '',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'show_in_menu' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => get_template_directory_uri() . "/assets/img/photo.png",
        'taxonomies' => array('photos'),
    ]);

    register_post_type('video', [
        'label' => 'Videos',
        'labels' => array(
            'name' => 'Videos',
            'singular_name' => 'Video',
            'menu_name' => 'Videos',
            'all_items' => 'Все видео',
            'add_new' => 'Добавить видео',
            'add_new_item' => 'Добавить новое видео',
            'edit' => 'Редактировать',
            'edit_item' => 'Редактировать видео',
            'new_item' => 'Новое видео',
        ),
        'description' => '',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'show_in_menu' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array('title'),
        'menu_icon' => get_template_directory_uri() . "/assets/img/video.png",
        'taxonomies' => array('videos'),
    ]);

    register_post_type('team', [
        'label' => 'Team',
        'labels' => array(
            'name' => 'Team',
            'singular_name' => 'Team',
            'menu_name' => 'Team',
            'all_items' => 'Вся команда',
            'add_new' => 'Добавить сотрудника',
            'add_new_item' => 'Добавить нового сотрудника',
            'edit' => 'Редактировать',
            'edit_item' => 'Редактировать сотрудника',
            'new_item' => 'Новый сотрудник',
        ),
        'description' => '',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'show_in_menu' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => get_template_directory_uri() . "/assets/img/team.png",
        'taxonomies' => array('team'),
    ]);

}

add_action('after_setup_theme', 'catalog_setup');

function catalog_scripts()
{
    wp_enqueue_style('catalog-bootstrap-style', get_template_directory_uri() . "/assets/css/bootstrap.min.css", array(), false);
    wp_enqueue_style('catalog-fontawesome-style', get_template_directory_uri() . "/assets/fontawesome/css/all.min.css", array(), false);
    wp_enqueue_style('catalog-templatemo-style', get_template_directory_uri() . "/assets/css/templatemo-style.css", array(), false);
    wp_enqueue_style('catalog-main-style', get_stylesheet_uri(), array(), false);

    wp_enqueue_script('catalog-plugins-script', get_template_directory_uri() . '/assets/js/plugins.js', array(), false, true);
    wp_enqueue_script('catalog-templatemo-script', get_template_directory_uri() . '/assets/js/js.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'catalog_scripts');

require get_template_directory() . '/inc/admin-functions.php';

require get_template_directory() . '/inc/custom-header.php';

function video_controls($controls = false)
{
    $video = get_post_meta(get_post()->ID, 'videos_video[]', true);
    if ($video)
        if ($controls) {
            echo '<video controls id="tm-video" style="" type="video/mp4" controlsList="nodownload" src="' . $video['url'] . '" >
</video>';
        } else {
            echo '<video id="tm-video" style="" type="video/mp4" controlsList="nodownload" src="' . $video['url'] . '" >
</video>';
        }
}

function wph_search_by_title($search, $wp_query)
{
    global $wpdb;
    if (empty($search)) return $search;

    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';
    $search = $searchand = '';

    foreach ((array)$q['search_terms'] as $term) {
        $term = esc_sql($wpdb->esc_like($term));
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }

    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in())
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}

add_filter('posts_search', 'wph_search_by_title', 500, 10);

function prefix_send_email_to_admin()
{
    if (isset($_POST['action'])) {
        $to = '';
        $subject = esc_html($_POST['inquiry']);
        $message = wordwrap(esc_html($_POST['message']), 70, "\r\n");
        $headers = array(
            'From' => esc_html($_POST['email']),
            'Reply-To' => esc_html($_POST['email'])
        );
        mail($to, $subject, $message, $headers);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

add_action('admin_post_nopriv_contact_form', 'prefix_send_email_to_admin');
add_action('admin_post_contact_form', 'prefix_send_email_to_admin');
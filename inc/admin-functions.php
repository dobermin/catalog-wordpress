<?php
if (!did_action('wp_enqueue_media')) {
    wp_enqueue_media();
}
add_action('admin_menu', function () {
    $hook_suffix = add_menu_page(
        'CatalogOptions',
        'CatalogOptions',
        'manage_options',
        'catalog-options',
        function () {
            require get_template_directory() . '/inc/template-catalog-options.php';
        },
        get_template_directory_uri() . '/assets/img/tiles-20x20.png'
    );
    add_action("admin_print_scripts-{$hook_suffix}", function () {
        wp_enqueue_style("catalog-admin-style", get_template_directory_uri() . '/assets/css/admin-style.css');

        wp_enqueue_script('catalog-admin-script', get_template_directory_uri() . '/assets/js/admin-main.js', array('jquery'), false, true);
    });
});
add_action('admin_init', function () {
    register_setting('catalog_general_group', 'catalog_search_bg');
    add_settings_section(
        'catalog_general_section',
        __('Страница настроек', 'catalog'),
        '',
        'catalog-options');
    add_settings_field(
        'catalog_search_bg',
        __('Изменить фон поиска фото', 'catalog'),
        function () {
            catalog_image('catalog_search_bg');
        },
        'catalog-options',
        'catalog_general_section');

    register_setting('catalog_general_group', 'catalog_posts_on_page');
    add_settings_field(
        'catalog_posts_on_page',
        __('Кол-во постов на страницу', 'catalog'),
        function () {
            catalog_number('catalog_posts_on_page');
        },
        'catalog-options',
        'catalog_general_section');

    register_setting('catalog_general_group', 'catalog_licence');
    add_settings_field(
        'catalog_licence',
        __('Лицензия', 'catalog'),
        function () {
            catalog_textarea('catalog_licence');
        },
        'catalog-options',
        'catalog_general_section');

    register_setting('catalog_general_group', 'catalog_our_address');
    add_settings_field(
        'catalog_our_address',
        __('Наш адрес', 'catalog'),
        function () {
            catalog_textarea('catalog_our_address');
        },
        'catalog-options',
        'catalog_general_section');

    register_setting('catalog_general_group', 'catalog_post_in_footer');
    add_settings_field(
        'catalog_post_in_footer',
        __('Пост в футере', 'catalog'),
        function () {
            catalog_textarea('catalog_post_in_footer');
        },
        'catalog-options',
        'catalog_general_section');

    register_setting('catalog_general_group', 'catalog_social');
    add_settings_field(
        'catalog_social',
        __('Сети (может быть пустым)', 'catalog'),
        function () {
            catalog_social('catalog_social');
        },
        'catalog-options',
        'catalog_general_section');

    add_settings_section(
        'catalog_contacts',
        __('Контакты', 'catalog'),
        '',
        'catalog-options');
    register_setting('catalog_general_group', 'catalog_email');
    add_settings_field(
        'catalog_email',
        __('', 'catalog'),
        function () {
            catalog_email('catalog_email');
        },
        'catalog-options',
        'catalog_contacts');
    register_setting('catalog_general_group', 'catalog_tel');
    add_settings_field(
        'catalog_tel',
        __('', 'catalog'),
        function () {
            catalog_tel('catalog_tel');
        },
        'catalog-options',
        'catalog_contacts');
    register_setting('catalog_general_group', 'catalog_url');
    add_settings_field(
        'catalog_url',
        __('', 'catalog'),
        function () {
            catalog_url('catalog_url');
        },
        'catalog-options',
        'catalog_contacts');

    register_setting('catalog_general_group', 'catalog_our_location');
    add_settings_field(
        'catalog_our_location',
        __('Местоположение', 'catalog'),
        function () {
            catalog_textarea('catalog_our_location');
        },
        'catalog-options',
        'catalog_general_section');
});

add_action('admin_head', function () {
    echo '<style>
           #adminmenu .wp-menu-image img {
                padding: 0;
                opacity: .6;
                background-color: white;
                margin-top: 9px;
                width: 40%;
            }   
      </style>';
});

add_action('admin_print_scripts-post-new.php', 'video_admin_script', 11);
add_action('admin_print_scripts-post.php', 'video_admin_script', 11);
function video_admin_script()
{
    wp_enqueue_script('catalog-admin-script', get_template_directory_uri() . '/assets/js/admin-video.js', array('jquery'), false, true);
}

function catalog_textarea($name)
{
    $content = get_option($name);
    wp_editor($content, $name, array(
        'wpautop' => 1,
        'media_buttons' => 0,
        'textarea_name' => $name,
        'textarea_rows' => 5,
        'tabindex' => null,
        'editor_css' => '',
        'editor_class' => '',
        'teeny' => 0,
        'dfw' => 0,
        'tinymce' => 1,
        'quicktags' => 1,
        'drag_drop_upload' => false
    ));
}

function catalog_social($name)
{
    $options = get_option($name, []);

    $socials = ['Facebook', 'Twitter', 'Instagram', 'Pinterest', 'Telegram', 'Viber', 'WhatsApp'];
    foreach ($socials as $social) {
        $out = '<p>';
        $out .= '<label for="' . $social . '">' . $social . '</label>';
        $out .= '<input type="text" id="' . $social . '" name="catalog_social[' . $social . ']"';
        if (isset($options[$social])) $out .= 'value=' . $options[$social] . '>';
        $out .= '</p>';
        echo $out;
    }
}

function catalog_email($name)
{
    $out = '<p>';
    $out .= '<label for="email">Email</label>';
    $out .= '<input type="email" id="email" name="' . $name . '" value="' . get_option($name) . '">';
    $out .= '</p>';
    echo $out;
}

function catalog_tel($name)
{
    $out = '<p>';
    $out .= '<label for="tel">Tel</label>';
    $out .= '<input type="tel" id="tel" name="' . $name . '" value="' . get_option($name) . '">';
    $out .= '</p>';
    echo $out;
}

function catalog_url($name)
{
    $out = '<p>';
    $out .= '<label for="url">URL</label>';
    $out .= '<input type="text" id="url" name="' . $name . '" value="' . get_option($name) . '">';
    $out .= '</p>';
    echo $out;
}

function catalog_number($name)
{
    $num = get_option($name) ?: 0;
    echo '<input type="number" min="0" value="' . $num . '" name="' . $name . '">';
}

function catalog_image($name)
{
    $image_id = get_option($name);
    if ($image = wp_get_attachment_image_src($image_id)) {
        echo '<a href="#" class="catalog-upl"><img src="' . $image[0] . '"/></a>
<a href="#" class="catalog-rmv">Удалить фон</a>
<input type="hidden" name="' . $name . '" value="' . $image_id . '">';
    } else {
        echo '<a href="#" class="catalog-upl">Загрузить фон</a>
<a href="#" class="catalog-rmv" style="display:none">Удалить фон</a>
<input type="hidden" name="' . $name . '" value="">';
    }
}

function catalog_debug($data)
{
    return '
<pre>' . print_r($data) . '</pre>';
}
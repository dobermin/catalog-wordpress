<?php
add_action('add_meta_boxes', function () {
    add_meta_box(
        'catalog_team_position',
        __('Данные сотрудника', 'catalog'),
        function ($post) {
            wp_nonce_field('catalog_action', 'catalog_nonce');
            $position = get_post_meta($post->ID, 'team_position', true);
            ?>
            <table class="form-table">
                <tbody>
                <tr>
                    <th><label for="team_position"><?= __('Position', 'catalog') ?></label></th>
                    <td><input type="text" id="team_position" name="team_position" class="regular-text"
                               value="<?= $position ?>"></td>
                </tr>
                </tbody>
            </table>
            <?
        },
        ['team']
    );
    add_meta_box(
        'catalog_team_social',
        __('Социальные сети', 'catalog'),
        function ($post) {
            $socialArr = ['Facebook', 'Twitter', 'Linkedin'];
            wp_nonce_field('catalog_action', 'catalog_nonce');
            $socials = get_post_meta($post->ID, 'team_social[]', true) ?? [];
            ?>
            <table class="form-table">
                <tbody>
                <?php foreach ($socialArr as $social) :
                    $value = is_array($socials) ? $socials[strtolower($social)] : '';
                    echo '<tr>
                        <th><label for="team_social_' . strtolower($social) . '">' . $social . '</label></th>
                        <td><input type="text" id="team_social_' . strtolower($social) . '" name="team_social[' . strtolower($social) . ']" class="regular-text" value="' . $value . '"></td>
                    </tr>';
                endforeach; ?>
                </tbody>
            </table>
            <?
        },
        ['team']
    );
});

add_action('save_post', function ($post_id) {
    if (!isset($_POST['catalog_nonce']) || !wp_verify_nonce($_POST['catalog_nonce'], 'catalog_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!empty($_POST['team_position'])) update_post_meta($post_id, 'team_position', sanitize_text_field($_POST['team_position']));
    else delete_post_meta($post_id, 'team_position');

    if (!empty($_POST['team_social'])) update_post_meta($post_id, 'team_social[]', $_POST['team_social']);
    else delete_post_meta($post_id, 'team_social');
});
<?php
add_action('add_meta_boxes', function () {
    add_meta_box(
        'catalog_videos_video',
        __('Видео', 'catalog'),
        function ($post) {
            wp_nonce_field('catalog_action', 'catalog_nonce');
            $video = get_post_meta($post->ID, 'videos_video[]', true);
            $btn = ($video) ? 'Изменить видео' : 'Добавить видео';
            ?>
            <table class="form-table">
                <tbody>
                <tr>
                    <td>
                        <video id="videos_video_src" style="max-width: 50%"
                               type="<?= isset($video['mime']) ? $video['mime'] : 'video/mp4' ?>"
                               controlslist="nodownload" controls
                               src="<?= isset($video['url']) ? $video['url'] : '' ?>">
                        </video>
                        <input type="hidden" name="videos_video[url]" id="videos_video_url" value="">
                        <input type="hidden" name="videos_video[width]" id="videos_video_width" value="">
                        <input type="hidden" name="videos_video[height]" id="videos_video_height" value="">
                        <input type="hidden" name="videos_video[mime]" id="videos_video_mime" value="">
                        <input type="hidden" name="videos_video[subtype]" id="videos_video_subtype" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" id="videos_video_btn" class="button button-primary" value="<?= $btn ?>">
                    </td>
                </tr>
                </tbody>
            </table>
            <?
        },
        ['video']
    );
});

add_action('save_post', function ($post_id) {
    var_dump($_POST);
    if (!isset($_POST['catalog_nonce']) || !wp_verify_nonce($_POST['catalog_nonce'], 'catalog_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!empty($_POST['videos_video'])) update_post_meta($post_id, 'videos_video[]', $_POST['videos_video']);
    else delete_post_meta($post_id, 'videos_video');
});


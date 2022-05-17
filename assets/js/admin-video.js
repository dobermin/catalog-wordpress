jQuery(document).ready(function ($) {
    $('body').on('click', '#videos_video_btn', function (e) {
        e.preventDefault();

        const button = $(this),
            custom_uploader = wp.media({
                title: 'Вставить видео',
                library: {
                    type: 'video'
                },
                button: {
                    text: 'Вставить'
                },
                multiple: false
            }).on('select', function () {
                const attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#videos_video_src').attr('src', attachment.url);
                $('#videos_video_url').val(attachment.url);
                $('#videos_video_height').val(attachment.height);
                $('#videos_video_width').val(attachment.width);
                $('#videos_video_mime').val(attachment.mime);
                $('#videos_video_subtype').val(attachment.subtype);
                button.val("Изменить видео")
            }).open();

    })
})
jQuery(document).ready(function ($) {

    $('body').on('click', '.catalog-upl', function (e) {

        e.preventDefault();

        const button = $(this),
            custom_uploader = wp.media({
                title: 'Вставка изображения',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Вставить'
                },
                multiple: false
            }).on('select', function () {
                const attachment = custom_uploader.state().get('selection').first().toJSON();
                button.html('<img src="' + attachment.url + '">').next().show().next().val(attachment.id);
            }).open();

    });


    $('body').on('click', '.catalog-rmv', function (e) {

        e.preventDefault();

        var button = $(this);
        button.next().val('');
        button.hide().prev().html('Загрузить фон');
    });
});
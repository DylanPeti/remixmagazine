jQuery(function ($) {
    $('.vls-gf-item a').colorbox({
        rel: 'vls-gf',
        maxWidth: '96%',
        maxHeight: '96%',
        title: function () {
            var caption = $(this).find('.vls-gf-info-caption');
            if (caption.length > 0) {
                return caption.text();
            }
        }
    });
});

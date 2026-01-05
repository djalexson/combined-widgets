/**
 * CW Menu Admin JS
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Checkbox styling
        $('.cw-field').each(function() {
            var $cb = $(this).find('.cw-parent-toggle');
            if ($cb.is(':checked')) $(this).addClass('cw-active');
        });

        // AJAX checkbox update
        $(document).on('change', '.cw-parent-toggle', function() {
            var $cb = $(this);
            var $field = $cb.closest('.cw-field');
            var $item = $cb.closest('.menu-item');
            var id = $item.attr('id').replace('menu-item-', '');
            var val = $cb.is(':checked') ? 1 : 0;

            $field.toggleClass('cw-active', val).addClass('cw-loading');

            $.post(CW_HM.ajaxurl, {
                action: 'update_checkbox_state',
                menu_item_id: id,
                checkbox_value: val,
                nonce: CW_HM.nonce
            }, function(r) {
                $field.removeClass('cw-loading');
                if (!r.success) {
                    $cb.prop('checked', !val);
                    $field.toggleClass('cw-active', !val);
                }
            }).fail(function() {
                $field.removeClass('cw-loading');
                $cb.prop('checked', !val);
                $field.toggleClass('cw-active', !val);
            });
        });

        // Image upload
        var frame;
        $(document).on('click', '.cw-select-image', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var id = $btn.data('item-id');
            var $input = $('#image_id_' + id);
            var $preview = $btn.closest('.cw-image-field').find('.cw-preview');

            if (frame) { frame.open(); return; }

            frame = wp.media({ title: 'Выберите изображение', button: { text: 'Выбрать' }, multiple: false, library: { type: 'image' } });

            frame.on('select', function() {
                var att = frame.state().get('selection').first().toJSON();
                var url = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                $input.val(att.id);
                $preview.html('<img src="' + url + '" style="max-width:80px;display:block;margin-bottom:6px"/><button type="button" class="button cw-remove-image" data-item-id="' + id + '">Удалить</button>');
            });

            frame.open();
        });

        $(document).on('click', '.cw-remove-image', function(e) {
            e.preventDefault();
            var id = $(this).data('item-id');
            $('#image_id_' + id).val('');
            $(this).closest('.cw-preview').html('<em style="color:#777">Изображение не выбрано</em>');
        });
    });
})(jQuery);

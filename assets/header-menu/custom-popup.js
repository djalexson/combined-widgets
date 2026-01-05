/**
 * CW Magnific Popup Init
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize Magnific Popup for popup links
        if (typeof $.fn.magnificPopup !== 'undefined') {
            $('.cw-popup-link').magnificPopup({
                type: 'inline',
                midClick: true,
                mainClass: 'cw-mfp-zoom',
                removalDelay: 300,
                callbacks: {
                    open: function() {
                        $('body').addClass('cw-popup-open');
                    },
                    close: function() {
                        $('body').removeClass('cw-popup-open');
                    }
                }
            });

            // Image popup
            $('.cw-popup-image').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'cw-mfp-zoom',
                image: {
                    verticalFit: true
                }
            });

            // Gallery
            $('.cw-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true
                },
                mainClass: 'cw-mfp-zoom'
            });
        }
    });
})(jQuery);

/**
 * CW Magnific Popup Init
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize Magnific Popup for popup links
        if (typeof $.fn.magnificPopup !== 'undefined') {
            
            // Header widget callback buttons with popup
            $('.header-widget__callback-button[data-effect="mfp-zoom-in"]').magnificPopup({
                type: 'inline',
                midClick: true,
                mainClass: 'mfp-zoom-in',
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

            // Buttons with data-mfp-src attribute
            $('button[data-mfp-src], a[data-mfp-src]').magnificPopup({
                type: 'inline',
                midClick: true,
                mainClass: 'mfp-zoom-in',
                removalDelay: 300,
                callbacks: {
                    beforeOpen: function() {
                        var src = $(this.st.el).attr('data-mfp-src');
                        if (src) {
                            this.st.items = [{
                                src: src,
                                type: 'inline'
                            }];
                        }
                    },
                    open: function() {
                        $('body').addClass('cw-popup-open');
                    },
                    close: function() {
                        $('body').removeClass('cw-popup-open');
                    }
                }
            });

            // Generic popup links
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
        } else {
            console.error('Magnific Popup not loaded. Please ensure the library is included.');
        }
    });
})(jQuery);

/**
 * CW Custom Header JS
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Mobile menu toggle
        $('.cw-header__toggle').on('click', function() {
            $(this).toggleClass('is-active');
            $('.cw-header__nav').toggleClass('is-open');
            $('body').toggleClass('cw-menu-open');
        });

        // Close on escape
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('.cw-header__nav').hasClass('is-open')) {
                $('.cw-header__toggle').removeClass('is-active');
                $('.cw-header__nav').removeClass('is-open');
                $('body').removeClass('cw-menu-open');
            }
        });

        // Close on outside click
        $(document).on('click', function(e) {
            if ($('.cw-header__nav').hasClass('is-open')) {
                if (!$(e.target).closest('.cw-header__nav, .cw-header__toggle').length) {
                    $('.cw-header__toggle').removeClass('is-active');
                    $('.cw-header__nav').removeClass('is-open');
                    $('body').removeClass('cw-menu-open');
                }
            }
        });

        // Submenu toggle on mobile
        if (window.innerWidth <= 991) {
            $('.cw-header__menu > li.menu-item-has-children > a').on('click', function(e) {
                var $li = $(this).parent();
                if (!$li.hasClass('is-expanded')) {
                    e.preventDefault();
                    $li.addClass('is-expanded').siblings().removeClass('is-expanded');
                }
            });
        }

    });
})(jQuery);

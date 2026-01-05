<?php
namespace CW;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Assets {

    public static function init() {
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'register_frontend_assets' ] );
        add_action( 'elementor/frontend/after_register_styles', [ __CLASS__, 'register_elementor_styles' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ __CLASS__, 'register_elementor_scripts' ] );
    }

    public static function register_frontend_assets() {
        $ver = defined( 'CW_VERSION' ) ? CW_VERSION : '1.2.0';

        // Combined Widgets CSS
        wp_register_style(
            'cw-sbalance',
            CW_URL . 'assets/css/combined-widgets.css',
            [],
            $ver
        );

        // Combined Widgets JS (animations)
        wp_register_script(
            'cw-sbalance-anim',
            CW_URL . 'assets/js/combined-widgets.js',
            [ 'jquery' ],
            $ver,
            true
        );

        // Enqueue globally so styles are always available
        wp_enqueue_style( 'cw-sbalance' );
        wp_enqueue_script( 'cw-sbalance-anim' );
    }

    public static function register_elementor_styles() {
        $ver = defined( 'CW_VERSION' ) ? CW_VERSION : '1.2.0';

        wp_register_style(
            'cw-sbalance',
            CW_URL . 'assets/css/combined-widgets.css',
            [],
            $ver
        );
    }

    public static function register_elementor_scripts() {
        $ver = defined( 'CW_VERSION' ) ? CW_VERSION : '1.2.0';

        wp_register_script(
            'cw-sbalance-anim',
            CW_URL . 'assets/js/combined-widgets.js',
            [ 'jquery' ],
            $ver,
            true
        );
    }
}
?>

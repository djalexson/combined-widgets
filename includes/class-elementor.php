<?php
namespace CW;

use Elementor\Plugin as ElementorPlugin;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Elementor_Integration {

    public static function init() {
        add_action( 'elementor/elements/categories_registered', [ __CLASS__, 'register_category' ] );
        add_action( 'elementor/widgets/register', [ __CLASS__, 'register_widgets' ] );
    }

    public static function register_category( $elements_manager ) {
        $elements_manager->add_category(
            'as-widgets',
            [
                'title' => __( 'AS widgets', 'combined-widgets' ),
                'icon'  => 'fa fa-plug',
            ]
        );
    }

    public static function register_widgets( $widgets_manager ) {
        $base = CW_PATH . 'includes/widgets/';

        // Register SBalance widgets
        require_once $base . 'class-widget-hero-split.php';
        require_once $base . 'class-widget-packages.php';
        require_once $base . 'class-widget-trust-strip.php';
        require_once $base . 'class-widget-process.php';
        require_once $base . 'class-widget-reviews.php';
        require_once $base . 'class-widget-form-1040.php';
        require_once $base . 'class-widget-team.php';
        require_once $base . 'class-widget-guides.php';
        require_once $base . 'class-widget-faq.php';
        require_once $base . 'class-widget-final-cta.php';
        require_once $base . 'class-widget-landing-all.php';

        $widgets_manager->register( new \CW\Widgets\Hero_Split() );
        $widgets_manager->register( new \CW\Widgets\Packages() );
        $widgets_manager->register( new \CW\Widgets\Trust_Strip() );
        $widgets_manager->register( new \CW\Widgets\Process_Steps() );
        $widgets_manager->register( new \CW\Widgets\Reviews() );
        $widgets_manager->register( new \CW\Widgets\Form_1040() );
        $widgets_manager->register( new \CW\Widgets\Team() );
        $widgets_manager->register( new \CW\Widgets\Guides() );
        $widgets_manager->register( new \CW\Widgets\FAQ() );
        $widgets_manager->register( new \CW\Widgets\Final_CTA() );
        $widgets_manager->register( new \CW\Widgets\Landing_All() );

        // Register Custom Header Widget
        require_once $base . 'class-widget-custom-header.php';
        $widgets_manager->register( new \CW\Widgets\Custom_Header() );
    }
}
?>

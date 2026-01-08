<?php
/**
 * Plugin Name: Combined Widgets & Header Menu
 * Description: Объединённый плагин: Elementor виджеты (SBalance) + Header Menu Helper. Включает CSS, JS анимации, форм-виджеты и функции для меню.
 * Version: 1.3.2
 * Author: Alex
 * Text Domain: combined-widgets
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'CW_VERSION', '1.3.2' );
define( 'CW_PATH', plugin_dir_path( __FILE__ ) );
define( 'CW_URL', plugin_dir_url( __FILE__ ) );

// ===== Load Traits =====
require_once CW_PATH . 'includes/traits/trait-common-controls.php';

// ===== SBalance Widgets Integration =====
require_once CW_PATH . 'includes/class-assets.php';
require_once CW_PATH . 'includes/class-elementor.php';

// ===== Header Menu Helper Integration =====
require_once CW_PATH . 'includes/class-header-menu.php';

// Register activation hook immediately
\CW\Header_Menu::register_activation();

// Initialize Elementor integration on proper hook
add_action( 'elementor/loaded', function () {
    \CW\Elementor_Integration::init();
}, 1 );

add_action( 'plugins_loaded', function () {
    
    // Load translations
    load_plugin_textdomain( 'combined-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

    // Initialize Header Menu Helper
    \CW\Header_Menu::init();

    // Register CSS/JS for Elementor widgets
    \CW\Assets::init();
    
    // Clear contact forms cache when CF7 forms are saved/deleted
    add_action( 'save_post_wpcf7_contact_form', function() {
        delete_transient( 'cw_contact_forms_list' );
    } );
    add_action( 'delete_post', function( $post_id ) {
        if ( get_post_type( $post_id ) === 'wpcf7_contact_form' ) {
            delete_transient( 'cw_contact_forms_list' );
        }
    } );
    
} );
?>

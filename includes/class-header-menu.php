<?php
namespace CW;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Header Menu Helper Class
 * Handles menu item custom fields, checkbox, image uploads, and related functionality
 */
class Header_Menu {

    public static function init() {
        add_action( 'wp_nav_menu_item_custom_fields', [ __CLASS__, 'add_checkbox_to_menu' ], 10, 3 );
        add_action( 'save_post', [ __CLASS__, 'save_menu_item_meta' ] );
        add_action( 'wp_ajax_update_checkbox_state', [ __CLASS__, 'ajax_update_checkbox_state' ] );
        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_admin_menu_assets' ] );
        add_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'enqueue_popup_assets' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_front_assets' ] );
        add_action( 'admin_menu', [ __CLASS__, 'register_admin_menu' ] );
        add_action( 'admin_notices', [ __CLASS__, 'activation_notice' ] );
        add_filter( 'plugin_action_links_' . plugin_basename( CW_PATH . 'combined-widgets.php' ), [ __CLASS__, 'action_links' ] );
        
        // CF7 settings
        add_filter( 'wpcf7_autop_or_not', '__return_false' );
    }

    /**
     * Add checkbox field to menu items
     */
    public static function add_checkbox_to_menu( $item_id, $item, $args ) {
        if ( (int) $item->menu_item_parent === 0 ) {
            $value = get_post_meta( $item_id, '_checkbox_value', true );
            $checked = $value ? 'checked' : '';
            echo '<p class="cw-field" style="margin:6px 0 12px"><label>';
            echo '<input type="checkbox" class="cw-parent-toggle" name="checkbox_value_' . esc_attr( $item_id ) . '" value="1" ' . $checked . '>';
            echo '<strong> Включить загрузку изображения для дочерних пунктов</strong></label></p>';
        } else {
            $parent_checked = get_post_meta( $item->menu_item_parent, '_checkbox_value', true );
            if ( $parent_checked ) {
                $image_id = (int) get_post_meta( $item_id, '_image_id', true );
                $img_url = $image_id ? wp_get_attachment_url( $image_id ) : '';
                ?>
                <div id="image_upload_container_<?php echo esc_attr( $item_id ); ?>" class="cw-image-field" style="margin:8px 0 14px">
                    <label style="display:block;margin-bottom:6px">Изображение для пункта меню:</label>
                    <input type="button" class="button cw-select-image" value="Выбрать изображение" data-item-id="<?php echo esc_attr( $item_id ); ?>"/>
                    <input type="hidden" name="image_id_<?php echo esc_attr( $item_id ); ?>" id="image_id_<?php echo esc_attr( $item_id ); ?>" value="<?php echo esc_attr( $image_id ); ?>"/>
                    <div class="cw-preview" style="margin-top:10px">
                        <?php if ( $img_url ) : ?>
                            <img src="<?php echo esc_url( $img_url ); ?>" style="max-width:80px;display:block;margin-bottom:6px"/>
                            <button type="button" class="button cw-remove-image" data-item-id="<?php echo esc_attr( $item_id ); ?>">Удалить изображение</button>
                        <?php else : ?>
                            <em style="color:#777">Изображение не выбрано</em>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
        }
    }

    /**
     * Save menu item meta data
     */
    public static function save_menu_item_meta( $post_id ) {
        if ( 'nav_menu_item' !== get_post_type( $post_id ) ) {
            return;
        }
        if ( isset( $_POST['checkbox_value_' . $post_id] ) ) {
            update_post_meta( $post_id, '_checkbox_value', 1 );
        } else {
            delete_post_meta( $post_id, '_checkbox_value' );
        }
        if ( isset( $_POST['image_id_' . $post_id] ) ) {
            update_post_meta( $post_id, '_image_id', (int) $_POST['image_id_' . $post_id] );
        } else {
            delete_post_meta( $post_id, '_image_id' );
        }
    }

    /**
     * AJAX handler for checkbox state updates
     */
    public static function ajax_update_checkbox_state() {
        check_ajax_referer( 'cw_update_checkbox', 'nonce' );
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_send_json_error( 'Нет прав.' );
        }
        $menu_item_id = isset( $_POST['menu_item_id'] ) ? (int) $_POST['menu_item_id'] : 0;
        $checkbox_value = isset( $_POST['checkbox_value'] ) ? (int) $_POST['checkbox_value'] : 0;
        if ( $menu_item_id <= 0 ) {
            wp_send_json_error( 'Некорректный ID.' );
        }
        if ( $checkbox_value ) {
            update_post_meta( $menu_item_id, '_checkbox_value', 1 );
        } else {
            delete_post_meta( $menu_item_id, '_checkbox_value' );
        }
        wp_send_json_success( 'OK' );
    }

    /**
     * Enqueue admin menu assets
     */
    public static function enqueue_admin_menu_assets( $hook ) {
        if ( 'nav-menus.php' !== $hook ) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_style( 'cw-menu-css', CW_URL . 'assets/header-menu/menu-checkbox.css', [], CW_VERSION );
        wp_enqueue_script( 'cw-menu-js', CW_URL . 'assets/header-menu/menu-checkbox.js', [ 'jquery' ], CW_VERSION, true );
        wp_localize_script( 'cw-menu-js', 'CW_HM', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'cw_update_checkbox' )
        ] );
    }

    /**
     * Enqueue popup and frontend assets
     */
    public static function enqueue_popup_assets( $widget ) {
        if ( ! method_exists( $widget, 'get_name' ) ) {
            return;
        }
        if ( $widget->get_name() !== 'cw_custom_header_widget' ) {
            return;
        }
        if ( method_exists( $widget, 'get_settings_for_display' ) ) {
            $settings = $widget->get_settings_for_display();
            if ( empty( $settings['enable_popup'] ) || $settings['enable_popup'] !== 'yes' ) {
                return;
            }
        }
        if ( ! wp_style_is( 'magnific-popup', 'registered' ) && ! wp_style_is( 'magnific-popup', 'enqueued' ) ) {
            wp_register_style( 'magnific-popup', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css', [], '1.1.0' );
        }
        if ( ! wp_script_is( 'magnific-popup', 'registered' ) && ! wp_script_is( 'magnific-popup', 'enqueued' ) ) {
            wp_register_script( 'magnific-popup', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js', [ 'jquery' ], '1.1.0', true );
        }
        wp_enqueue_style( 'magnific-popup' );
        wp_enqueue_script( 'magnific-popup' );
				  wp_enqueue_script('as-custom-popup',CW_URL.'assets/header-menu/custom-popup.js',['jquery','magnific-popup'],CW_VERSION,true);

    }

    /**
     * Enqueue frontend assets
     */
    public static function enqueue_front_assets() {
        // Frontend assets if needed
    }

    /**
     * Register admin menu page
     */
    public static function register_admin_menu() {
        add_menu_page(
            'CW Helper',
            'CW Helper',
            'manage_options',
            'cw-helper',
            [ __CLASS__, 'render_helper_page' ],
            'dashicons-editor-code',
            58
        );
    }

    /**
     * Render helper page
     */
    public static function render_helper_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        $cf7_template = <<<HTML
<div hidden>
[text* text-843]
[tel* tel-phone]
</div>
<div class="form-label">
  <span class="form-name">Ваше имя</span>
  <input size="40" maxlength="400" class="form-input-name" value="" type="text" name="name">
</div>
<div class="alert-mess"></div>
<div class="form-label">
  <span class="form-name">Ваш телефон <sub>*</sub></span>
  <input size="40" maxlength="400" class="form-input-phone" value="" type="tel" name="tel">
</div>
<div class="alert-mess"></div>
<div class="form-check-wrap">
  <label class="custom-checkbox">
    <input type="checkbox" class="form-check" checked="checked" name="Agreement" data-validation="valid">
    <svg viewBox="0 0 24 24" class="checkmark" aria-hidden="true">
      <path d="M20 6L9 17l-5-5" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
  </label>
  <label class="form-check-label">
    Я даю свое согласие на обработку персональных данных и соглашаюсь с&nbsp;<a href="/politika-konfidentsialnosti/" target="_blank">политикой конфиденциальности</a>
  </label>
</div>
<div class="form-btn-wrap">
  [submit "Отправить" class:form-btn]
</div>
HTML;
        ?>
        <div class="wrap">
            <h1>CW Helper — шаблон Contact Form 7</h1>
            <p>Ниже — готовый HTML-шаблон. Он рассчитан на отключённые автопараграфы. Скопируйте и вставьте в «Форма» у нужной CF7.</p>
            <textarea id="cw-cf7-template" rows="18" style="width:100%;font-family:monospace;"><?php echo esc_textarea( $cf7_template ); ?></textarea>
            <p><button class="button button-primary" id="cw-copy">Скопировать</button></p>
            <script>
            (function($){
              $('#cw-copy').on('click',function(){
                const ta=document.getElementById('cw-cf7-template');
                ta.select();ta.setSelectionRange(0,ta.value.length);
                try{document.execCommand('copy');}catch(e){}
              });
            })(jQuery);
            </script>
        </div>
        <?php
    }

    /**
     * Plugin action links
     */
    public static function action_links( $links ) {
        $url = admin_url( 'admin.php?page=cw-helper' );
        $link = '<a href="' . esc_url( $url ) . '"><strong>Открыть Helper</strong></a>';
        array_unshift( $links, $link );
        return $links;
    }

    /**
     * Activation notice
     */
    public static function activation_notice() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        if ( get_transient( 'cw_just_activated' ) ) {
            delete_transient( 'cw_just_activated' );
            $url = admin_url( 'admin.php?page=cw-helper' );
            echo '<div class="notice notice-success is-dismissible"><p>Плагин активирован. Перейти в <a href="' . esc_url( $url ) . '"><strong>CW Helper</strong></a>.</p></div>';
        }
    }

    /**
     * Register activation hook
     */
    public static function register_activation() {
        register_activation_hook( CW_PATH . 'combined-widgets.php', [ __CLASS__, 'on_activate' ] );
    }

    /**
     * Activation callback
     */
    public static function on_activate() {
        set_transient( 'cw_just_activated', 1, 60 );
    }
}

// Global function for activation hook
\CW\Header_Menu::register_activation();

?>

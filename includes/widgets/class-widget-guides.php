<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use CW\Traits\Common_Controls;

class Guides extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_guides'; }
    public function get_title() { return __( 'AS: Guides (Products)', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-products'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('content', [
            'label' => __( 'Контент', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_id', [ 'label' => __('ID секции', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'guides' ]);
        $this->add_control('heading_icon', [ 'label' => __('Иконка заголовка (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-book-open', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'PDF-гайды' ]);
        $this->add_control('text', [ 'label' => __('Подзаголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Гайды по QuickBooks и формам IRS — для самостоятельных пользователей.' ]);
        $this->add_control('shortcode', [ 'label' => __('Шорткод WooCommerce', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => '[products limit="6" columns="3" category="guides" orderby="popularity"]' ]);
        $this->add_control('button_icon', [ 'label' => __('Иконка кнопки (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-arrow-right', 'placeholder' => 'fas fa-icon', 'separator' => 'before' ]);
        $this->add_control('shop_text', [ 'label' => __('Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Перейти в магазин' ]);
        $this->add_control('shop_link', [ 'label' => __('Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '/shop/' ], 'show_external' => false ]);

        $this->end_controls_section();

        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_button_style_controls();
        $this->register_responsive_controls();
    }

    private function icon_html( $icon ) {
        if ( ! $this->show_icons() || empty( $icon ) ) return '';
        $icon_class = is_array( $icon ) ? ( $icon['value'] ?? '' ) : $icon;
        if ( empty( $icon_class ) ) return '';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true" style="margin-right: 0.4em;"></i>';
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $anim_class = $this->get_anim_class();
        $link = $s['shop_link'];
        $href = !empty($link['url']) ? esc_url($link['url']) : '#';
        $target = !empty($link['is_external']) ? ' target="_blank" rel="noopener"' : '';
        $shortcode = trim((string)$s['shortcode']);

        echo '<section class="sb-section sb-guides' . $anim_class . '" id="' . esc_attr(sanitize_title($s['section_id'])) . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2>' . $this->icon_html($s['heading_icon']) . esc_html($s['title']) . '</h2><p>' . esc_html($s['text']) . '</p></div>';

        echo '<div class="sb-products sb-anim__item">';
        if ($shortcode !== '') {
            echo do_shortcode($shortcode);
        } else {
            echo '<div class="sb-products__placeholder"><i class="fas fa-cart-shopping"></i> Здесь будет вывод товаров WooCommerce</div>';
        }
        echo '</div>';

        echo '<div class="sb-center sb-anim__item"><a class="sb-btn sb-btn--ghost" href="' . $href . '"' . $target . '>' . $this->icon_html($s['button_icon']) . esc_html($s['shop_text']) . '</a></div>';
        echo '</div></section>';
    }
}








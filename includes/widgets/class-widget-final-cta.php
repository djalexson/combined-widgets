<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use CW\Traits\Common_Controls;

class Final_CTA extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_final_cta'; }
    public function get_title() { return __( 'AS: Final CTA + Form', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-mail'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('content', [
            'label' => __( 'Контент', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_id', [ 'label' => __('ID секции', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'quickbooks-form' ]);
        $this->add_control('heading_icon', [ 'label' => __('Иконка заголовка (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-paper-plane', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Оставьте заявку на QuickBooks Setup' ]);
        $this->add_control('text', [ 'label' => __('Текст', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Опишите задачу — я отвечу и предложу следующий шаг.' ]);
        $this->add_control('form_shortcode', [ 'label' => __('Шорткод формы', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => '', 'placeholder' => '[contact-form-7 id="123"]', 'separator' => 'before' ]);

        $this->end_controls_section();

        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_responsive_controls();

        // CTA specific styles
        $this->start_controls_section('cta_style', [
            'label' => __('📧 Стиль CTA', 'combined-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('cta_box_bg', [
            'label' => __('Фон блока', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .sb-final__box' => 'background-color: {{VALUE}};' ],
        ]);

        $this->add_responsive_control('cta_box_padding', [
            'label' => __('Отступы блока', 'combined-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em' ],
            'selectors' => [ '{{WRAPPER}} .sb-final__box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);

        $this->end_controls_section();
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
        $shortcode = trim((string)$s['form_shortcode']);

        echo '<section class="sb-section sb-final' . $anim_class . '" id="' . esc_attr(sanitize_title($s['section_id'])) . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container"><div class="sb-final__box">';
        
        echo '<div class="sb-final__text sb-anim__item">';
        echo '<h2>' . $this->icon_html($s['heading_icon']) . esc_html($s['title']) . '</h2>';
        echo '<p>' . esc_html($s['text']) . '</p>';
        echo '</div>';

        echo '<div class="sb-final__form sb-anim__item">';
        if ($shortcode !== '') {
            echo do_shortcode($shortcode);
        } else {
            echo '<div class="sb-form-placeholder"><i class="fas fa-envelope"></i> Здесь будет форма (Elementor Form / CF7)</div>';
        }
        echo '</div>';

        echo '</div></div></section>';
    }
}








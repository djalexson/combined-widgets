<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use CW\Traits\Common_Controls;

class Hero_Split extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_hero_split'; }
    public function get_title() { return __( 'AS: Hero Split', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-banner'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('content', [
            'label' => __( 'Контент', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('title', [
            'label' => __( 'Заголовок', 'combined-widgets' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => "Управляйте бизнесом,<br>а учёт оставьте мне",
        ]);

        $this->add_control('text', [
            'label' => __( 'Текст', 'combined-widgets' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => "Ваш QuickBooks ежемесячно настроен, обновлён и подготовлен к отчётам.\nЯ веду учёт, а вы — свой бизнес.",
        ]);

        $this->add_control('button_icon', [
            'label' => __( 'Иконка кнопки (CSS-класс)', 'combined-widgets' ),
            'type'  => Controls_Manager::TEXT,
            'default' => 'fas fa-paper-plane',
            'placeholder' => 'fas fa-icon',
        ]);

        $this->add_control('button_text', [
            'label' => __( 'Текст кнопки', 'combined-widgets' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Заявка на QuickBooks Setup',
        ]);

        $this->add_control('button_link', [
            'label' => __( 'Ссылка кнопки', 'combined-widgets' ),
            'type' => Controls_Manager::URL,
            'default' => [ 'url' => '#quickbooks-form' ],
            'placeholder' => '#quickbooks-form',
            'show_external' => false,
        ]);

        $this->add_control('image', [
            'label' => __( 'Изображение справа', 'combined-widgets' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [ 'url' => '' ],
        ]);

        $this->end_controls_section();

        // Animation Controls
        $this->register_animation_controls();
        
        // Style Controls
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_button_style_controls();
        $this->register_icon_controls();
        $this->register_responsive_controls();
        
        // Hero specific styles
        $this->start_controls_section('hero_style', [
            'label' => __( '🖼️ Стиль Hero', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('hero_min_height', [
            'label'      => __( 'Минимальная высота', 'combined-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vh' ],
            'range'      => [
                'px' => [ 'min' => 200, 'max' => 1000 ],
                'vh' => [ 'min' => 20, 'max' => 100 ],
            ],
            'default'    => [ 'unit' => 'vh', 'size' => 70 ],
            'selectors'  => [
                '{{WRAPPER}} .sb-hero-split' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('hero_content_width', [
            'label'      => __( 'Ширина контента', 'combined-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'range'      => [
                '%'  => [ 'min' => 30, 'max' => 70 ],
                'px' => [ 'min' => 300, 'max' => 800 ],
            ],
            'default'    => [ 'unit' => '%', 'size' => 50 ],
            'selectors'  => [
                '{{WRAPPER}} .sb-hero-split__content' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('hero_overlay_color', [
            'label'     => __( 'Затемнение изображения', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__media::after' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        $title = wp_kses_post( $s['title'] );
        $text  = wp_kses_post( nl2br( esc_html( $s['text'] ) ) );

        $btn_text = isset($s['button_text']) ? $s['button_text'] : '';
        $btn_text = esc_html( $btn_text );

        $link = $s['button_link'];
        $href = ! empty( $link['url'] ) ? esc_url( $link['url'] ) : '#';
        $target = ! empty( $link['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';

        $img = '';
        if ( ! empty( $s['image']['url'] ) ) {
            $img = esc_url( $s['image']['url'] );
        }

        $style = $img ? ' style="background-image:url(\'' . $img . '\');"' : '';
        $anim_class = $this->get_anim_class();

        // Render icon - support both old array format and new string format
        $btn_icon = '';
        $icon_val = $s['button_icon'] ?? '';
        $icon_class = is_array( $icon_val ) ? ( $icon_val['value'] ?? '' ) : $icon_val;
        if ( $this->show_icons() && ! empty( $icon_class ) ) {
            $btn_icon = '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true" style="margin-right: 0.4em;"></i>';
        }

        echo '<section class="sb-hero-split' . $anim_class . '"' . $this->get_animation_attrs() . '>';
        echo '  <div class="sb-hero-split__inner">';
        echo '    <div class="sb-hero-split__content sb-anim__item">';
        echo '      <h1>' . $title . '</h1>';
        echo '      <p>' . $text . '</p>';
        echo '      <a class="sb-hero-split__btn" href="' . $href . '"' . $target . '>' . $btn_icon . $btn_text . '</a>';
        echo '    </div>';
        echo '    <div class="sb-hero-split__media sb-anim__item"' . $style . '></div>';
        echo '  </div>';
        echo '</section>';
    }
}








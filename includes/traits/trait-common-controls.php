<?php
/**
 * Trait: Common Controls for all widgets
 * Adds: Animation, Style, Responsive settings
 */
namespace CW\Traits;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

trait Common_Controls {

    /**
     * Register Animation Controls Section
     */
    protected function register_animation_controls() {
        $this->start_controls_section('cw_animation_section', [
            'label' => __( '🎬 Анимация', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('cw_animation_enable', [
            'label'        => __( 'Включить анимацию', 'combined-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('cw_animation_type', [
            'label'   => __( 'Тип анимации', 'combined-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'fade-up',
            'options' => [
                'fade'       => __( 'Fade', 'combined-widgets' ),
                'fade-up'    => __( 'Fade Up', 'combined-widgets' ),
                'fade-down'  => __( 'Fade Down', 'combined-widgets' ),
                'fade-left'  => __( 'Fade Left', 'combined-widgets' ),
                'fade-right' => __( 'Fade Right', 'combined-widgets' ),
                'zoom-in'    => __( 'Zoom In', 'combined-widgets' ),
                'zoom-out'   => __( 'Zoom Out', 'combined-widgets' ),
                'flip'       => __( 'Flip', 'combined-widgets' ),
                'slide-up'   => __( 'Slide Up', 'combined-widgets' ),
            ],
            'condition' => [ 'cw_animation_enable' => 'yes' ],
        ]);

        $this->add_control('cw_animation_duration', [
            'label'   => __( 'Длительность (ms)', 'combined-widgets' ),
            'type'    => Controls_Manager::NUMBER,
            'default' => 600,
            'min'     => 100,
            'max'     => 3000,
            'step'    => 50,
            'condition' => [ 'cw_animation_enable' => 'yes' ],
        ]);

        $this->add_control('cw_animation_delay', [
            'label'   => __( 'Задержка (ms)', 'combined-widgets' ),
            'type'    => Controls_Manager::NUMBER,
            'default' => 0,
            'min'     => 0,
            'max'     => 2000,
            'step'    => 50,
            'condition' => [ 'cw_animation_enable' => 'yes' ],
        ]);

        $this->add_control('cw_animation_offset', [
            'label'       => __( 'Порог видимости', 'combined-widgets' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ '%' ],
            'range'       => [
                '%' => [ 'min' => 0, 'max' => 50, 'step' => 5 ],
            ],
            'default'     => [ 'unit' => '%', 'size' => 15 ],
            'condition'   => [ 'cw_animation_enable' => 'yes' ],
            'description' => __( 'Когда элемент виден на X% экрана, запускается анимация', 'combined-widgets' ),
        ]);

        $this->add_control('cw_animation_once', [
            'label'        => __( 'Только один раз', 'combined-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'condition'    => [ 'cw_animation_enable' => 'yes' ],
            'description'  => __( 'Анимация сработает только при первом появлении', 'combined-widgets' ),
        ]);

        $this->add_control('cw_animation_stagger', [
            'label'   => __( 'Каскад для дочерних (ms)', 'combined-widgets' ),
            'type'    => Controls_Manager::NUMBER,
            'default' => 60,
            'min'     => 0,
            'max'     => 500,
            'step'    => 10,
            'condition' => [ 'cw_animation_enable' => 'yes' ],
            'description' => __( 'Задержка между появлением дочерних элементов', 'combined-widgets' ),
        ]);

        $this->end_controls_section();
    }

    /**
     * Register Style Controls Section (colors, spacing)
     */
    protected function register_style_controls() {
        $this->start_controls_section('cw_style_section', [
            'label' => __( '🎨 Стили секции', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        // Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'cw_section_bg',
                'label'    => __( 'Фон секции', 'combined-widgets' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} > section, {{WRAPPER}} > .sb-section, {{WRAPPER}} .sb-hero-split, {{WRAPPER}} .sb-team',
            ]
        );

        // Padding
        $this->add_responsive_control('cw_section_padding', [
            'label'      => __( 'Внутренние отступы', 'combined-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} > section, {{WRAPPER}} > .sb-section, {{WRAPPER}} .sb-hero-split, {{WRAPPER}} .sb-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        // Margin
        $this->add_responsive_control('cw_section_margin', [
            'label'      => __( 'Внешние отступы', 'combined-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} > section, {{WRAPPER}} > .sb-section, {{WRAPPER}} .sb-hero-split, {{WRAPPER}} .sb-team' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        // Border Radius
        $this->add_responsive_control('cw_section_radius', [
            'label'      => __( 'Скругление углов', 'combined-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} > section, {{WRAPPER}} > .sb-section, {{WRAPPER}} .sb-hero-split, {{WRAPPER}} .sb-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        // Box Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'cw_section_shadow',
                'selector' => '{{WRAPPER}} > section, {{WRAPPER}} > .sb-section, {{WRAPPER}} .sb-hero-split, {{WRAPPER}} .sb-team',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Typography Controls Section
     */
    protected function register_typography_controls() {
        $this->start_controls_section('cw_typography_section', [
            'label' => __( '🔤 Типографика', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        // Heading Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cw_heading_typo',
                'label'    => __( 'Заголовок (H2)', 'combined-widgets' ),
                'selector' => '{{WRAPPER}} h2',
            ]
        );

        $this->add_control('cw_heading_color', [
            'label'     => __( 'Цвет заголовка', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} h2' => 'color: {{VALUE}};',
            ],
        ]);

        // Subheading Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cw_subheading_typo',
                'label'    => __( 'Подзаголовок', 'combined-widgets' ),
                'selector' => '{{WRAPPER}} .sb-head > p, {{WRAPPER}} .sb-team__sub',
                'separator' => 'before',
            ]
        );

        $this->add_control('cw_subheading_color', [
            'label'     => __( 'Цвет подзаголовка', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-head > p, {{WRAPPER}} .sb-team__sub' => 'color: {{VALUE}};',
            ],
        ]);

        // Text Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cw_text_typo',
                'label'    => __( 'Основной текст', 'combined-widgets' ),
                'selector' => '{{WRAPPER}} p, {{WRAPPER}} li',
                'separator' => 'before',
            ]
        );

        $this->add_control('cw_text_color', [
            'label'     => __( 'Цвет текста', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} p, {{WRAPPER}} li' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();
    }

    /**
     * Register Button Style Controls
     */
    protected function register_button_style_controls() {
        $this->start_controls_section('cw_button_style_section', [
            'label' => __( '🔘 Стиль кнопок', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        // Button Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cw_button_typo',
                'label'    => __( 'Типографика', 'combined-widgets' ),
                'selector' => '{{WRAPPER}} .sb-btn, {{WRAPPER}} .sb-hero-split__btn',
            ]
        );

        $this->start_controls_tabs('cw_button_tabs');

        // Normal state
        $this->start_controls_tab('cw_button_normal', [
            'label' => __( 'Обычное', 'combined-widgets' ),
        ]);

        $this->add_control('cw_button_text_color', [
            'label'     => __( 'Цвет текста', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-btn, {{WRAPPER}} .sb-hero-split__btn' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('cw_button_bg_color', [
            'label'     => __( 'Цвет фона', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-btn, {{WRAPPER}} .sb-hero-split__btn' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'cw_button_border',
                'selector' => '{{WRAPPER}} .sb-btn, {{WRAPPER}} .sb-hero-split__btn',
            ]
        );

        $this->end_controls_tab();

        // Hover state
        $this->start_controls_tab('cw_button_hover', [
            'label' => __( 'При наведении', 'combined-widgets' ),
        ]);

        $this->add_control('cw_button_text_color_hover', [
            'label'     => __( 'Цвет текста', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-btn:hover, {{WRAPPER}} .sb-hero-split__btn:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('cw_button_bg_color_hover', [
            'label'     => __( 'Цвет фона', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-btn:hover, {{WRAPPER}} .sb-hero-split__btn:hover' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('cw_button_border_color_hover', [
            'label'     => __( 'Цвет рамки', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-btn:hover, {{WRAPPER}} .sb-hero-split__btn:hover' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Button padding & radius
        $this->add_responsive_control('cw_button_padding', [
            'label'      => __( 'Внутренние отступы', 'combined-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .sb-btn, {{WRAPPER}} .sb-hero-split__btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_responsive_control('cw_button_radius', [
            'label'      => __( 'Скругление', 'combined-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .sb-btn, {{WRAPPER}} .sb-hero-split__btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    /**
     * Register Icon Controls Section
     */
    protected function register_icon_controls() {
        $this->start_controls_section('cw_icons_section', [
            'label' => __( '✨ Иконки', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('cw_icons_show', [
            'label'        => __( 'Показывать иконки', 'combined-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('cw_icon_size', [
            'label'      => __( 'Размер иконок', 'combined-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'range'      => [
                'px' => [ 'min' => 10, 'max' => 60, 'step' => 1 ],
                'em' => [ 'min' => 0.5, 'max' => 4, 'step' => 0.1 ],
            ],
            'default'    => [ 'unit' => 'px', 'size' => 18 ],
            'selectors'  => [
                '{{WRAPPER}} .sb-head h2 i, {{WRAPPER}} h3 i, {{WRAPPER}} .sb-ico i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [ 'cw_icons_show' => 'yes' ],
        ]);

        $this->add_control('cw_icon_color', [
            'label'     => __( 'Цвет иконок (заголовки)', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-head h2 i, {{WRAPPER}} h3 i' => 'color: {{VALUE}};',
            ],
            'condition' => [ 'cw_icons_show' => 'yes' ],
        ]);

        $this->add_control('cw_icon_color_accent', [
            'label'     => __( 'Цвет иконок (акцент)', 'combined-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-ico i, {{WRAPPER}} .sb-list i' => 'color: {{VALUE}};',
            ],
            'condition' => [ 'cw_icons_show' => 'yes' ],
        ]);

        $this->add_responsive_control('cw_icon_spacing', [
            'label'      => __( 'Отступ после иконки', 'combined-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'range'      => [
                'px' => [ 'min' => 0, 'max' => 30 ],
                'em' => [ 'min' => 0, 'max' => 2, 'step' => 0.1 ],
            ],
            'default'    => [ 'unit' => 'px', 'size' => 8 ],
            'selectors'  => [
                '{{WRAPPER}} h2 i, {{WRAPPER}} h3 i, {{WRAPPER}} .sb-btn i' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [ 'cw_icons_show' => 'yes' ],
        ]);

        $this->end_controls_section();
    }

    /**
     * Register Responsive Controls Section
     */
    protected function register_responsive_controls() {
        $this->start_controls_section('cw_responsive_section', [
            'label' => __( '📱 Адаптивность', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        // Columns on tablet
        $this->add_control('cw_columns_tablet', [
            'label'   => __( 'Колонок на планшете', 'combined-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'default' => '2',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
            ],
            'selectors' => [
                '(tablet){{WRAPPER}} .sb-grid--3, (tablet){{WRAPPER}} .sb-team__grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr) !important;',
            ],
        ]);

        // Columns on mobile
        $this->add_control('cw_columns_mobile', [
            'label'   => __( 'Колонок на мобильном', 'combined-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
            ],
            'selectors' => [
                '(mobile){{WRAPPER}} .sb-grid--3, (mobile){{WRAPPER}} .sb-team__grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr) !important;',
            ],
        ]);

        // Text alignment on mobile
        $this->add_responsive_control('cw_text_align', [
            'label'   => __( 'Выравнивание текста', 'combined-widgets' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => __( 'Слева', 'combined-widgets' ), 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => __( 'Центр', 'combined-widgets' ), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __( 'Справа', 'combined-widgets' ), 'icon' => 'eicon-text-align-right' ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sb-head, {{WRAPPER}} .sb-card, {{WRAPPER}} .sb-team__card' => 'text-align: {{VALUE}};',
            ],
            'separator' => 'before',
        ]);

        // Hide elements on mobile
        $this->add_control('cw_hide_on_mobile', [
            'label'        => __( 'Скрыть на мобильном', 'combined-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => '',
            'separator'    => 'before',
            'prefix_class' => 'cw-hide-mobile-',
        ]);

        // Hide elements on tablet
        $this->add_control('cw_hide_on_tablet', [
            'label'        => __( 'Скрыть на планшете', 'combined-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => '',
            'prefix_class' => 'cw-hide-tablet-',
        ]);

        $this->end_controls_section();
    }

    /**
     * Register Card Style Controls
     */
    protected function register_card_style_controls() {
        $this->start_controls_section('cw_card_style_section', [
            'label' => __( '🃏 Стиль карточек', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'cw_card_bg',
                'label'    => __( 'Фон карточки', 'combined-widgets' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sb-card, {{WRAPPER}} .sb-quote, {{WRAPPER}} .sb-team__card, {{WRAPPER}} .sb-step',
            ]
        );

        $this->add_responsive_control('cw_card_padding', [
            'label'      => __( 'Внутренние отступы', 'combined-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .sb-card, {{WRAPPER}} .sb-quote, {{WRAPPER}} .sb-team__card, {{WRAPPER}} .sb-step' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_responsive_control('cw_card_gap', [
            'label'      => __( 'Расстояние между карточками', 'combined-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'range'      => [
                'px' => [ 'min' => 0, 'max' => 60 ],
                'em' => [ 'min' => 0, 'max' => 4, 'step' => 0.1 ],
            ],
            'default'    => [ 'unit' => 'px', 'size' => 24 ],
            'selectors'  => [
                '{{WRAPPER}} .sb-grid, {{WRAPPER}} .sb-team__grid, {{WRAPPER}} .sb-steps' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('cw_card_radius', [
            'label'      => __( 'Скругление углов', 'combined-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .sb-card, {{WRAPPER}} .sb-quote, {{WRAPPER}} .sb-team__card, {{WRAPPER}} .sb-step' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'cw_card_border',
                'selector' => '{{WRAPPER}} .sb-card, {{WRAPPER}} .sb-quote, {{WRAPPER}} .sb-team__card, {{WRAPPER}} .sb-step',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'cw_card_shadow',
                'selector' => '{{WRAPPER}} .sb-card, {{WRAPPER}} .sb-quote, {{WRAPPER}} .sb-team__card, {{WRAPPER}} .sb-step',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get animation wrapper attributes based on settings
     */
    protected function get_animation_attrs() {
        $s = $this->get_settings_for_display();

        if ( empty( $s['cw_animation_enable'] ) || $s['cw_animation_enable'] !== 'yes' ) {
            return '';
        }

        $attrs = ' class="sb-anim"';
        $attrs .= ' data-anim="' . esc_attr( $s['cw_animation_type'] ) . '"';

        if ( ! empty( $s['cw_animation_duration'] ) && $s['cw_animation_duration'] !== 600 ) {
            $attrs .= ' data-duration="' . intval( $s['cw_animation_duration'] ) . '"';
        }

        if ( ! empty( $s['cw_animation_delay'] ) && $s['cw_animation_delay'] > 0 ) {
            $attrs .= ' data-delay="' . intval( $s['cw_animation_delay'] ) . '"';
        }

        if ( ! empty( $s['cw_animation_offset']['size'] ) ) {
            $offset = $s['cw_animation_offset']['size'] / 100;
            if ( $offset != 0.15 ) {
                $attrs .= ' data-offset="' . floatval( $offset ) . '"';
            }
        }

        if ( empty( $s['cw_animation_once'] ) || $s['cw_animation_once'] !== 'yes' ) {
            $attrs .= ' data-once="false"';
        }

        if ( ! empty( $s['cw_animation_stagger'] ) && $s['cw_animation_stagger'] !== 60 ) {
            $attrs .= ' data-stagger="' . intval( $s['cw_animation_stagger'] ) . '"';
        }

        return $attrs;
    }

    /**
     * Get animation class
     */
    protected function get_anim_class() {
        $s = $this->get_settings_for_display();
        return ( ! empty( $s['cw_animation_enable'] ) && $s['cw_animation_enable'] === 'yes' ) ? ' sb-anim' : '';
    }

    /**
     * Check if icons should be displayed
     */
    protected function show_icons() {
        $s = $this->get_settings_for_display();
        return ! empty( $s['cw_icons_show'] ) && $s['cw_icons_show'] === 'yes';
    }

    /**
     * Render icon from CSS class string if enabled
     * @param string $icon_class CSS class like "fas fa-star"
     * @param bool $before_text Add margin-right (true) or margin-left (false)
     */
    protected function render_icon( $icon_class, $before_text = true ) {
        if ( ! $this->show_icons() || empty( $icon_class ) ) {
            return '';
        }
        $margin = $before_text ? ' style="margin-right: 0.4em;"' : ' style="margin-left: 0.4em;"';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true"' . $margin . '></i>';
    }

    /**
     * Render icon from CSS class string (always, ignores show_icons setting)
     * Use for icons that should always appear
     */
    protected function render_icon_always( $icon_class, $before_text = true ) {
        if ( empty( $icon_class ) ) {
            return '';
        }
        $margin = $before_text ? ' style="margin-right: 0.4em;"' : ' style="margin-left: 0.4em;"';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true"' . $margin . '></i>';
    }

    /**
     * Register all common controls at once
     */
    protected function register_all_common_controls() {
        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_button_style_controls();
        $this->register_card_style_controls();
        $this->register_responsive_controls();
    }
}

<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use CW\Traits\Common_Controls;

class Trust_Strip extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_trust_strip'; }
    public function get_title() { return __( 'AS: Trust Strip', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-check-circle'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('items', [
            'label' => __( 'Элементы', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $defaults = [
            [ 'icon' => 'fas fa-language', 'title' => 'На русском', 'text' => 'Понятно и без стресса' ],
            [ 'icon' => 'fas fa-shield-halved', 'title' => 'Аккуратно', 'text' => 'Чистая структура учёта' ],
            [ 'icon' => 'fas fa-rocket', 'title' => 'Быстрый старт', 'text' => 'Двигаемся по шагам' ],
        ];

        for ($i=1; $i<=3; $i++){
            $d = $defaults[$i-1];
            $this->add_control('item_' . $i . '_icon', [
                'label' => sprintf( __( 'Элемент %d — Иконка (CSS)', 'combined-widgets' ), $i ),
                'type' => Controls_Manager::TEXT,
                'default' => $d['icon'],
                'placeholder' => 'fas fa-icon',
            ]);
            $this->add_control('item_' . $i . '_title', [
                'label' => sprintf( __( 'Элемент %d — Заголовок', 'combined-widgets' ), $i ),
                'type' => Controls_Manager::TEXT,
                'default' => $d['title'],
            ]);
            $this->add_control('item_' . $i . '_text', [
                'label' => sprintf( __( 'Элемент %d — Текст', 'combined-widgets' ), $i ),
                'type' => Controls_Manager::TEXT,
                'default' => $d['text'],
            ]);
            if ($i<3) $this->add_control('hr_' . $i, [ 'type' => Controls_Manager::DIVIDER ]);
        }

        $this->end_controls_section();

        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_responsive_controls();
    }

    private function icon_html( $icon ) {
        if ( ! $this->show_icons() || empty( $icon ) ) return '';
        $icon_class = is_array( $icon ) ? ( $icon['value'] ?? '' ) : $icon;
        if ( empty( $icon_class ) ) return '';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true"></i>';
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $anim_class = $this->get_anim_class();

        echo '<section class="sb-section sb-trust' . $anim_class . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container"><div class="sb-strip">';

        for ($i=1; $i<=3; $i++){
            $icon = $s['item_' . $i . '_icon'] ?? '';
            echo '<div class="sb-strip__item sb-anim__item">';
            echo '<div class="sb-ico">' . $this->icon_html($icon) . '</div>';
            echo '<div><div class="sb-strip__title">' . esc_html($s['item_' . $i . '_title']) . '</div>';
            echo '<div class="sb-strip__text">' . esc_html($s['item_' . $i . '_text']) . '</div></div>';
            echo '</div>';
        }

        echo '</div></div></section>';
    }
}








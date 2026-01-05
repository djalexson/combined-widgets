<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use CW\Traits\Common_Controls;

class Reviews extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_reviews'; }
    public function get_title() { return __( 'AS: Reviews', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-testimonial'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('section', [
            'label' => __( 'Секция', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_id', [ 'label' => __('ID секции', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'reviews' ]);
        $this->add_control('heading_icon', [ 'label' => __('Иконка заголовка (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-comment-dots', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Отзывы клиентов' ]);
        $this->add_control('text', [ 'label' => __('Подзаголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Несколько коротких отзывов — чтобы было понятнее, как я работаю.' ]);

        $this->end_controls_section();

        // Reviews repeater
        $this->start_controls_section('reviews_list', [
            'label' => __( 'Отзывы', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new Repeater();
        $repeater->add_control('badge', [ 'label' => __('Бейдж', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Setup' ]);
        $repeater->add_control('stars', [ 'label' => __('Звёзды', 'combined-widgets'), 'type' => Controls_Manager::NUMBER, 'min' => 1, 'max' => 5, 'default' => 5 ]);
        $repeater->add_control('quote', [ 'label' => __('Цитата', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => '«Отличная работа!»' ]);
        $repeater->add_control('who', [ 'label' => __('Автор', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Клиент' ]);
        $repeater->add_control('who_icon', [ 'label' => __('Иконка автора (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-user', 'placeholder' => 'fas fa-icon' ]);

        $this->add_control('reviews', [
            'label' => __('Отзывы', 'combined-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [ 'badge' => 'Setup', 'stars' => 5, 'quote' => '«Стало понятно, где деньги и почему отчёты "не сходились". Всё настроили аккуратно и быстро.»', 'who' => 'Клиент, бизнес в США' ],
                [ 'badge' => 'Cleanup', 'stars' => 5, 'quote' => '«Было много дублей и неправильных категорий. После cleanup отчёты стали выглядеть нормально.»', 'who' => 'Клиент, сервисный бизнес' ],
                [ 'badge' => 'Support', 'stars' => 5, 'quote' => '«Ежемесячно всё под контролем: сверки, отчёты, ответы на вопросы. Очень спокойно.»', 'who' => 'Клиент, e-commerce' ],
            ],
            'title_field' => '{{{ who }}}',
        ]);

        $this->end_controls_section();

        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_card_style_controls();
        $this->register_responsive_controls();
    }

    private function icon_html( $icon ) {
        if ( ! $this->show_icons() || empty( $icon ) ) return '';
        $icon_class = is_array( $icon ) ? ( $icon['value'] ?? '' ) : $icon;
        if ( empty( $icon_class ) ) return '';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true" style="margin-right: 0.4em;"></i>';
    }

    private function stars($n){
        $n = max(1, min(5, intval($n)));
        $out = '';
        for($i=0; $i<$n; $i++) $out .= '<i class="fas fa-star"></i>';
        return $out;
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $anim_class = $this->get_anim_class();

        echo '<section class="sb-section sb-reviews' . $anim_class . '" id="' . esc_attr(sanitize_title($s['section_id'])) . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2>' . $this->icon_html($s['heading_icon']) . esc_html($s['title']) . '</h2><p>' . esc_html($s['text']) . '</p></div>';
        echo '<div class="sb-grid sb-grid--3">';

        if ( !empty($s['reviews']) && is_array($s['reviews']) ) {
            foreach ($s['reviews'] as $r) {
                echo '<article class="sb-quote sb-anim__item">';
                echo '<div class="sb-quote__top">';
                echo '<div class="sb-quote__stars">' . $this->stars($r['stars']) . '</div>';
                echo '<div class="sb-quote__badge"><i class="fas fa-check"></i> ' . esc_html($r['badge']) . '</div>';
                echo '</div>';
                echo '<p>' . esc_html($r['quote']) . '</p>';
                $who_icon = $r['who_icon'] ?? 'fas fa-user';
                echo '<div class="sb-quote__who">' . $this->icon_html($who_icon) . esc_html($r['who']) . '</div>';
                echo '</article>';
            }
        }

        echo '</div></div></section>';
    }
}








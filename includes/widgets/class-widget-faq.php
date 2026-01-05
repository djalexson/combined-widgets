<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use CW\Traits\Common_Controls;

class FAQ extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_faq'; }
    public function get_title() { return __( 'AS: FAQ', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-help-o'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('content', [
            'label' => __( 'Контент', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('heading_icon', [ 'label' => __('Иконка заголовка (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-circle-question', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Частые вопросы' ]);
        $this->add_control('text', [ 'label' => __('Подзаголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Коротко — по делу.' ]);

        $repeater = new Repeater();
        $repeater->add_control('icon', [ 'label' => __('Иконка (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-angle-down', 'placeholder' => 'fas fa-icon' ]);
        $repeater->add_control('q', [ 'label' => __('Вопрос', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Вопрос' ]);
        $repeater->add_control('a', [ 'label' => __('Ответ', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Ответ...' ]);

        $this->add_control('items', [
            'label' => __('Вопросы', 'combined-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [ 'q' => 'Сколько времени занимает Setup?', 'a' => 'Зависит от объёма и состояния учёта. После заявки дам оценку.' ],
                [ 'q' => 'Можно ли начать с Cleanup?', 'a' => 'Да. Часто логичнее сначала Cleanup, затем фиксируем настройки.' ],
                [ 'q' => 'Вы работаете на русском?', 'a' => 'Да — коммуникация и объяснения на русском.' ],
            ],
            'title_field' => '{{{ q }}}',
        ]);

        $this->end_controls_section();

        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_responsive_controls();

        // FAQ specific styles
        $this->start_controls_section('faq_style', [
            'label' => __('📋 Стиль FAQ', 'combined-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('faq_border_color', [
            'label' => __('Цвет рамки', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .sb-faq__item' => 'border-color: {{VALUE}};' ],
        ]);

        $this->add_control('faq_bg_color', [
            'label' => __('Фон вопроса', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .sb-faq__item summary' => 'background-color: {{VALUE}};' ],
        ]);

        $this->add_control('faq_answer_bg', [
            'label' => __('Фон ответа', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .sb-faq__content' => 'background-color: {{VALUE}};' ],
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

        echo '<section class="sb-section sb-faq' . $anim_class . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2>' . $this->icon_html($s['heading_icon']) . esc_html($s['title']) . '</h2><p>' . esc_html($s['text']) . '</p></div>';
        echo '<div class="sb-faq__items">';

        if ( !empty($s['items']) && is_array($s['items']) ) {
            foreach ($s['items'] as $it) {
                $item_icon = $it['icon'] ?? 'fas fa-angle-down';
                echo '<details class="sb-faq__item sb-anim__item">';
                echo '<summary>' . $this->icon_html($item_icon) . esc_html($it['q']) . '</summary>';
                echo '<div class="sb-faq__content">' . esc_html($it['a']) . '</div>';
                echo '</details>';
            }
        }

        echo '</div></div></section>';
    }
}








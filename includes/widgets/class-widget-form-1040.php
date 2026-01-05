<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use CW\Traits\Common_Controls;

class Form_1040 extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_form_1040'; }
    public function get_title() { return __( 'AS: Form 1040', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-document-file'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', [
            'label' => __( 'Контент', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_id', [ 'label' => __('ID секции', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'form-1040' ]);
        $this->add_control('heading_icon', [ 'label' => __('Иконка заголовка (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-file-invoice', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Помощь по Form 1040' ]);
        $this->add_control('text', [ 'label' => __('Текст', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Консультации и поддержка по индивидуальным налоговым декларациям (Form 1040).' ]);
        $this->add_control('items', [ 'label' => __('Пункты списка', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => "Разбор вашей ситуации\nОтветы простым языком\nПроверка логики/документов" ]);
        $this->add_control('list_icon', [ 'label' => __('Иконка пунктов (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-check', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('button_icon', [ 'label' => __('Иконка кнопки (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-arrow-right', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('button_text', [ 'label' => __('Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Нужна консультация' ]);
        $this->add_control('button_link', [ 'label' => __('Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false ]);

        $this->add_control('side_icon', [ 'label' => __('Иконка карточки (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-circle-info', 'placeholder' => 'fas fa-icon', 'separator' => 'before' ]);
        $this->add_control('side_title', [ 'label' => __('Заголовок карточки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Если вы пришли "только по налогам"' ]);
        $this->add_control('side_text', [ 'label' => __('Текст карточки', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Оставьте заявку — уточню детали и предложу подходящий формат помощи.' ]);

        $this->end_controls_section();

        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_button_style_controls();
        $this->register_card_style_controls();
        $this->register_responsive_controls();
    }

    private function icon_html( $icon ) {
        if ( ! $this->show_icons() || empty( $icon ) ) return '';
        $icon_class = is_array( $icon ) ? ( $icon['value'] ?? '' ) : $icon;
        if ( empty( $icon_class ) ) return '';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true" style="margin-right: 0.4em;"></i>';
    }

    private function render_list($raw, $icon_class) {
        $lines = preg_split('/\r\n|\r|\n/', (string)$raw);
        $out = '';
        $ih = $this->icon_html($icon_class);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line !== '') $out .= '<li>' . $ih . esc_html($line) . '</li>';
        }
        return $out;
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $anim_class = $this->get_anim_class();
        $link = $s['button_link'];
        $href = !empty($link['url']) ? esc_url($link['url']) : '#';
        $target = !empty($link['is_external']) ? ' target="_blank" rel="noopener"' : '';

        echo '<section class="sb-section sb-secondary' . $anim_class . '" id="' . esc_attr(sanitize_title($s['section_id'])) . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container"><div class="sb-two">';
        
        echo '<div class="sb-anim__item">';
        echo '<h2>' . $this->icon_html($s['heading_icon']) . esc_html($s['title']) . '</h2>';
        echo '<p>' . esc_html($s['text']) . '</p>';
        echo '<ul class="sb-list">' . $this->render_list($s['items'], $s['list_icon']) . '</ul>';
        echo '<a class="sb-btn sb-btn--ghost" href="' . $href . '"' . $target . '>' . $this->icon_html($s['button_icon']) . esc_html($s['button_text']) . '</a>';
        echo '</div>';

        echo '<div class="sb-card sb-card--soft sb-anim__item">';
        echo '<h3>' . $this->icon_html($s['side_icon']) . esc_html($s['side_title']) . '</h3>';
        echo '<p>' . esc_html($s['side_text']) . '</p>';
        echo '</div>';

        echo '</div></div></section>';
    }
}








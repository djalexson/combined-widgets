<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use CW\Traits\Common_Controls;

class Packages extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_packages'; }
    public function get_title() { return __( 'AS: Packages', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-price-table'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('section', [
            'label' => __( 'Секция', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_id', [
            'label' => __( 'ID секции', 'combined-widgets' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'quickbooks',
        ]);

        $this->add_control('heading_icon', [
            'label' => __( 'Иконка заголовка (CSS-класс)', 'combined-widgets' ),
            'type'  => Controls_Manager::TEXT,
            'default' => 'fas fa-bolt',
            'placeholder' => 'fas fa-icon',
        ]);

        $this->add_control('title', [
            'label' => __( 'Заголовок', 'combined-widgets' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'QuickBooks Online: Setup / Cleanup / Monthly Support',
        ]);

        $this->add_control('text', [
            'label' => __( 'Подзаголовок', 'combined-widgets' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Выберите формат — я настрою QBO так, чтобы учёт был чистым, а отчёты — точными.',
        ]);

        $this->end_controls_section();

        $defaults = [
            [ 'name' => 'Setup', 'badge' => 'Основной', 'featured' => 'yes', 'items' => "Правильный Chart of Accounts\nБанки, правила и автоматизация\nКатегории, налоги, отчёты\nШаблоны инвойсов", 'btn' => 'Заявка на QuickBooks Setup', 'btn_style' => 'accent' ],
            [ 'name' => 'Cleanup', 'badge' => '', 'featured' => '', 'items' => "Исправлю категории и дубли\nСверю банковские операции\nПриведу отчёты в порядок\nПодготовлю к CPA/сдаче", 'btn' => 'Нужен Cleanup', 'btn_style' => 'ghost' ],
            [ 'name' => 'Monthly Support', 'badge' => '', 'featured' => '', 'items' => "Ежемесячный контроль учёта\nСверки и отчётность\nРекомендации по улучшению\nПоддержка вопрос-ответ", 'btn' => 'Хочу сопровождение', 'btn_style' => 'ghost' ],
        ];

        foreach ($defaults as $i => $d) {
            $n = $i + 1;
            $this->start_controls_section('card_' . $n, [
                'label' => sprintf( __( 'Карточка %d', 'combined-widgets' ), $n ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control('card_' . $n . '_icon', [
                'label' => __( 'Иконка (CSS-класс)', 'combined-widgets' ),
                'type'  => Controls_Manager::TEXT,
                'default' => 'fas fa-gear',
                'placeholder' => 'fas fa-icon',
            ]);

            $this->add_control('card_' . $n . '_title', [ 'label' => __( 'Заголовок', 'combined-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => $d['name'] ]);
            $this->add_control('card_' . $n . '_badge', [ 'label' => __( 'Бейдж', 'combined-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => $d['badge'] ]);
            $this->add_control('card_' . $n . '_featured', [ 'label' => __( 'Выделенная', 'combined-widgets' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => $d['featured'] ]);
            $this->add_control('card_' . $n . '_items', [ 'label' => __( 'Пункты списка', 'combined-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => $d['items'] ]);
            $this->add_control('card_' . $n . '_list_icon', [ 'label' => __( 'Иконка пунктов (CSS)', 'combined-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-check', 'placeholder' => 'fas fa-icon' ]);
            $this->add_control('card_' . $n . '_btn_icon', [ 'label' => __( 'Иконка кнопки (CSS)', 'combined-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-paper-plane', 'placeholder' => 'fas fa-icon' ]);
            $this->add_control('card_' . $n . '_btn_text', [ 'label' => __( 'Текст кнопки', 'combined-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => $d['btn'] ]);
            $this->add_control('card_' . $n . '_btn_style', [ 'label' => __( 'Стиль кнопки', 'combined-widgets' ), 'type' => Controls_Manager::SELECT, 'default' => $d['btn_style'], 'options' => [ 'accent' => 'Accent', 'ghost' => 'Ghost' ] ]);
            $this->add_control('card_' . $n . '_btn_link', [ 'label' => __( 'Ссылка', 'combined-widgets' ), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false ]);

            if (1 === $n) {
                $this->add_control('card_1_note', [ 'label' => __( 'Примечание', 'combined-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Ответ в течение 1 рабочего дня' ]);
            }
            $this->end_controls_section();
        }

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

        echo '<section class="sb-section sb-packages' . $anim_class . '" id="' . esc_attr(sanitize_title($s['section_id'])) . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2>' . $this->icon_html($s['heading_icon']) . esc_html($s['title']) . '</h2><p>' . esc_html($s['text']) . '</p></div>';
        echo '<div class="sb-grid sb-grid--3">';

        for ($n=1; $n<=3; $n++){
            $featured = !empty($s['card_' . $n . '_featured']) && $s['card_' . $n . '_featured'] === 'yes';
            $badge = trim((string)$s['card_' . $n . '_badge']);
            $items = $this->render_list($s['card_' . $n . '_items'], $s['card_' . $n . '_list_icon'] ?? '');
            $btn_style = $s['card_' . $n . '_btn_style'] === 'accent' ? 'sb-btn--accent' : 'sb-btn--ghost';
            $link = $s['card_' . $n . '_btn_link'];
            $href = !empty($link['url']) ? esc_url($link['url']) : '#';
            $target = !empty($link['is_external']) ? ' target="_blank" rel="noopener"' : '';

            echo '<article class="sb-card sb-anim__item' . ($featured ? ' sb-card--featured' : '') . '">';
            if ($badge) echo '<div class="sb-badge"><i class="fas fa-star"></i> ' . esc_html($badge) . '</div>';
            echo '<h3>' . $this->icon_html($s['card_' . $n . '_icon']) . esc_html($s['card_' . $n . '_title']) . '</h3>';
            echo '<ul class="sb-list">' . $items . '</ul>';
            echo '<a class="sb-btn ' . $btn_style . '" href="' . $href . '"' . $target . '>' . $this->icon_html($s['card_' . $n . '_btn_icon']) . esc_html($s['card_' . $n . '_btn_text']) . '</a>';
            if ($n === 1 && !empty($s['card_1_note'])) echo '<div class="sb-note"><i class="far fa-clock"></i> ' . esc_html($s['card_1_note']) . '</div>';
            echo '</article>';
        }

        echo '</div></div></section>';
    }
}








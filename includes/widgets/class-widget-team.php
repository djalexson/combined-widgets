<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use CW\Traits\Common_Controls;

class Team extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_team'; }
    public function get_title() { return __( 'AS: Team', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-person'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('content', [
            'label' => __( 'Контент', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_id', [ 'label' => __('ID секции', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'team' ]);
        $this->add_control('title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Ваши эксперты SBalance' ]);
        $this->add_control('subtitle', [ 'label' => __('Подзаголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Команда, которая ведёт учёт в QuickBooks и помогает с налогами. Понятно, аккуратно и без стресса.' ]);
        $this->add_control('columns', [ 'label' => __('Колонок (десктоп)', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => '3', 'options' => [ '2' => '2', '3' => '3', '4' => '4' ] ]);

        $repeater = new Repeater();
        $repeater->add_control('photo', [ 'label' => __('Фото', 'combined-widgets'), 'type' => Controls_Manager::MEDIA ]);
        $repeater->add_control('name', [ 'label' => __('Имя', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Имя Фамилия' ]);
        $repeater->add_control('role', [ 'label' => __('Должность', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Должность / специализация' ]);
        $repeater->add_control('meta', [ 'label' => __('Описание', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Коротко: 1–2 предложения про опыт' ]);
        $repeater->add_control('telegram', [ 'label' => __('Telegram URL', 'combined-widgets'), 'type' => Controls_Manager::URL, 'show_external' => true ]);
        $repeater->add_control('linkedin', [ 'label' => __('LinkedIn URL', 'combined-widgets'), 'type' => Controls_Manager::URL, 'show_external' => true ]);
        $repeater->add_control('website', [ 'label' => __('Website URL', 'combined-widgets'), 'type' => Controls_Manager::URL, 'show_external' => true ]);
        $repeater->add_control('email', [ 'label' => __('Email', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'placeholder' => 'hello@example.com' ]);

        $this->add_control('members', [
            'label' => __('Участники', 'combined-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [ 'name' => 'Синкевич Ирина', 'role' => 'Основатель компании', 'meta' => 'Лицензированный бухгалтер и налоговый специалист', 'email' => 'hello@sbalance.us' ],
                [ 'name' => 'Имя Фамилия', 'role' => 'Должность / специализация', 'meta' => 'Коротко: 1–2 предложения про опыт' ],
                [ 'name' => 'Имя Фамилия', 'role' => 'Должность / специализация', 'meta' => 'Коротко: 1–2 предложения про опыт' ],
            ],
            'title_field' => '{{{ name }}}',
        ]);

        $this->end_controls_section();

        // Social icons section
        $this->start_controls_section('social_icons', [
            'label' => __('🔗 Иконки соцсетей', 'combined-widgets'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('telegram_icon', [ 'label' => __('Telegram (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fab fa-telegram', 'placeholder' => 'fab fa-icon' ]);
        $this->add_control('linkedin_icon', [ 'label' => __('LinkedIn (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fab fa-linkedin', 'placeholder' => 'fab fa-icon' ]);
        $this->add_control('website_icon', [ 'label' => __('Website (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-link', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('email_icon', [ 'label' => __('Email (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-envelope', 'placeholder' => 'fas fa-icon' ]);

        $this->end_controls_section();

        $this->register_animation_controls();
        $this->register_style_controls();
        $this->register_typography_controls();
        $this->register_icon_controls();
        $this->register_card_style_controls();
        $this->register_responsive_controls();

        // Team specific styles
        $this->start_controls_section('team_style', [
            'label' => __('👥 Стиль карточек команды', 'combined-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('photo_size', [
            'label' => __('Размер фото', 'combined-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [ 'px' => [ 'min' => 60, 'max' => 200 ] ],
            'default' => [ 'unit' => 'px', 'size' => 100 ],
            'selectors' => [
                '{{WRAPPER}} .sb-team__photo' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .sb-team__photo img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('photo_border_radius', [
            'label' => __('Скругление фото', 'combined-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [ '%' => [ 'min' => 0, 'max' => 50 ] ],
            'default' => [ 'unit' => '%', 'size' => 50 ],
            'selectors' => [
                '{{WRAPPER}} .sb-team__photo, {{WRAPPER}} .sb-team__photo img' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('social_icon_color', [
            'label' => __('Цвет иконок соцсетей', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .sb-team__links a' => 'color: {{VALUE}};' ],
        ]);

        $this->add_control('social_icon_hover_color', [
            'label' => __('Цвет при наведении', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .sb-team__links a:hover' => 'color: {{VALUE}};' ],
        ]);

        $this->end_controls_section();
    }

    private function icon_html( $icon ) {
        if ( empty( $icon ) ) return '';
        $icon_class = is_array( $icon ) ? ( $icon['value'] ?? '' ) : $icon;
        if ( empty( $icon_class ) ) return '';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true"></i>';
    }

    private function link_attrs($url){
        if (empty($url) || empty($url['url'])) return '';
        $href = esc_url($url['url']);
        $target = !empty($url['is_external']) ? ' target="_blank" rel="noopener"' : '';
        return ' href="' . $href . '"' . $target;
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $anim_class = $this->get_anim_class();
        $cols = max(1, min(4, intval($s['columns'])));

        echo '<section class="sb-team' . $anim_class . '" id="' . esc_attr(sanitize_title($s['section_id'])) . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container">';
        echo '<header class="sb-team__head sb-anim__item"><h2>' . esc_html($s['title']) . '</h2><p class="sb-team__sub">' . esc_html($s['subtitle']) . '</p></header>';
        echo '<div class="sb-team__grid" style="grid-template-columns: repeat(' . $cols . ', 1fr);">';

        if (!empty($s['members']) && is_array($s['members'])) {
            foreach ($s['members'] as $m) {
                $img = '';
                if (!empty($m['photo']['url'])) {
                    $img = '<img src="' . esc_url($m['photo']['url']) . '" alt="' . esc_attr($m['name']) . '">';
                } else {
                    $img = '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" alt="' . esc_attr($m['name']) . '" style="background:rgba(11,43,75,.06);">';
                }

                echo '<article class="sb-team__card sb-anim__item">';
                echo '<div class="sb-team__photo">' . $img . '</div>';
                echo '<div class="sb-team__name">' . esc_html($m['name']) . '</div>';
                echo '<div class="sb-team__role">' . esc_html($m['role']) . '</div>';
                echo '<div class="sb-team__meta">' . esc_html($m['meta']) . '</div>';

                $links = [];
                if (!empty($m['telegram']['url'])) $links[] = '<a' . $this->link_attrs($m['telegram']) . ' aria-label="Telegram">' . $this->icon_html($s['telegram_icon']) . '</a>';
                if (!empty($m['linkedin']['url'])) $links[] = '<a' . $this->link_attrs($m['linkedin']) . ' aria-label="LinkedIn">' . $this->icon_html($s['linkedin_icon']) . '</a>';
                if (!empty($m['website']['url'])) $links[] = '<a' . $this->link_attrs($m['website']) . ' aria-label="Website">' . $this->icon_html($s['website_icon']) . '</a>';
                if (!empty($m['email']) && is_email($m['email'])) $links[] = '<a href="mailto:' . antispambot(esc_attr($m['email'])) . '" aria-label="Email">' . $this->icon_html($s['email_icon']) . '</a>';

                if (!empty($links)) echo '<div class="sb-team__links">' . implode('', $links) . '</div>';
                echo '</article>';
            }
        }

        echo '</div></div></section>';
    }
}








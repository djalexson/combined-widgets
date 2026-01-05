<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use CW\Traits\Common_Controls;

class Process_Steps extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_process_steps'; }
    public function get_title() { return __( 'AS: Process Steps', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-flow'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        $this->start_controls_section('content', [
            'label' => __( 'Контент', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('heading_icon', [
            'label' => __( 'Иконка заголовка (CSS)', 'combined-widgets' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'fas fa-route',
            'placeholder' => 'fas fa-icon',
        ]);

        $this->add_control('title', [ 'label' => __( 'Заголовок', 'combined-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Как проходит работа' ]);
        $this->add_control('text', [ 'label' => __( 'Подзаголовок', 'combined-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Прозрачный процесс: вы понимаете, что происходит на каждом шаге.' ]);

        $steps = [
            [ 'Заявка', 'Коротко описываете задачу и текущую ситуацию в QuickBooks.' ],
            [ 'Аудит', 'Смотрю структуру, банки, категории, отчёты. Определяем план.' ],
            [ 'Настройка / Cleanup', 'Навожу порядок и фиксирую правила, чтобы дальше было стабильно.' ],
            [ 'Результат', 'Получаете корректные отчёты и понятную систему учёта.' ],
        ];

        for ($i=1; $i<=4; $i++){
            $this->add_control('step_' . $i . '_icon', [ 'label' => sprintf(__('Шаг %d — Иконка (CSS)', 'combined-widgets'), $i), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-circle-check', 'placeholder' => 'fas fa-icon', 'separator' => 'before' ]);
            $this->add_control('step_' . $i . '_title', [ 'label' => sprintf(__('Шаг %d — Заголовок', 'combined-widgets'), $i), 'type' => Controls_Manager::TEXT, 'default' => $steps[$i-1][0] ]);
            $this->add_control('step_' . $i . '_text', [ 'label' => sprintf(__('Шаг %d — Текст', 'combined-widgets'), $i), 'type' => Controls_Manager::TEXTAREA, 'default' => $steps[$i-1][1] ]);
        }

        $this->add_control('button_icon', [ 'label' => __('Иконка кнопки (CSS)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-paper-plane', 'placeholder' => 'fas fa-icon', 'separator' => 'before' ]);
        $this->add_control('button_text', [ 'label' => __('Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Оставить заявку' ]);
        $this->add_control('button_link', [ 'label' => __('Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false ]);

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

    protected function render() {
        $s = $this->get_settings_for_display();
        $anim_class = $this->get_anim_class();
        $link = $s['button_link'];
        $href = !empty($link['url']) ? esc_url($link['url']) : '#';
        $target = !empty($link['is_external']) ? ' target="_blank" rel="noopener"' : '';

        echo '<section class="sb-section sb-process' . $anim_class . '"' . $this->get_animation_attrs() . '>';
        echo '<div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2>' . $this->icon_html($s['heading_icon']) . esc_html($s['title']) . '</h2><p>' . esc_html($s['text']) . '</p></div>';
        echo '<div class="sb-steps">';

        for ($i=1; $i<=4; $i++){
            echo '<div class="sb-step sb-anim__item">';
            echo '<div class="sb-step__num">' . $i . '</div>';
            echo '<div class="sb-step__body"><h3>' . $this->icon_html($s['step_' . $i . '_icon']) . esc_html($s['step_' . $i . '_title']) . '</h3>';
            echo '<p>' . esc_html($s['step_' . $i . '_text']) . '</p></div>';
            echo '</div>';
        }

        echo '</div>';
        echo '<div class="sb-center sb-anim__item"><a class="sb-btn sb-btn--accent" href="' . $href . '"' . $target . '>' . $this->icon_html($s['button_icon']) . esc_html($s['button_text']) . '</a></div>';
        echo '</div></section>';
    }
}








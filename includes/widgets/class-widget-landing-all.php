<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use CW\Traits\Common_Controls;

class Landing_All extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_landing_all'; }
    public function get_title() { return __( 'AS: Landing (All-in-one)', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-site-identity'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    private function get_cf7_forms() {
        $forms = [];
        if (function_exists('wpcf7')) {
            $args = array(
                'post_type' => 'wpcf7_contact_form',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            );
            $cf7_forms = get_posts($args);
            if ($cf7_forms) {
                foreach ($cf7_forms as $form) {
                    $forms[$form->ID] = $form->post_title;
                }
            }
        }
        return $forms;
    }

    protected function register_controls() {

        // HERO
        $this->start_controls_section('hero', [
            'label' => __( 'Hero', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        // === HERO: Заголовок и текст ===
        $this->add_control('hero_content_heading', [
            'label' => __('📝 Заголовок и текст', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_control('hero_title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => "Управляйте бизнесом,<br>а учёт оставьте мне" ]);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hero_title_typography',
                'label' => __('Шрифт заголовка', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .sb-hero-split__content h1',
            ]
        );
        
        $this->add_control('hero_title_color', [
            'label' => __('Цвет заголовка', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__content h1' => 'color: {{VALUE}};',
            ],
        ]);
        
        $this->add_control('hero_text', [ 'label' => __('Текст', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => "Ваш QuickBooks ежемесячно настроен, обновлён и подготовлен к отчётам.\nЯ веду учёт, а вы — свой бизнес." ]);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hero_text_typography',
                'label' => __('Шрифт текста', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .sb-hero-split__content p',
            ]
        );
        
        $this->add_control('hero_text_color', [
            'label' => __('Цвет текста', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__content p' => 'color: {{VALUE}};',
            ],
        ]);
        
        // === HERO: Кнопка ===
        $this->add_control('hero_btn_heading', [
            'label' => __('🔘 Настройки кнопки', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_control('hero_btn_icon', [ 'label' => __('Иконка кнопки (CSS-класс)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-paper-plane', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('hero_btn_text', [ 'label' => __('Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Заявка на QuickBooks Setup' ]);
        $this->add_control('hero_btn_action', [ 'label' => __('Действие', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'link', 'options' => [ 'link' => 'Ссылка', 'popup' => 'Попап с формой' ] ]);
        $this->add_control('hero_btn_link', [ 'label' => __('Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false, 'condition' => [ 'hero_btn_action' => 'link' ] ]);
        $this->add_control('hero_btn_popup_form', [ 'label' => __('Форма в попапе', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'options' => $this->get_cf7_forms(), 'condition' => [ 'hero_btn_action' => 'popup' ] ]);
        
        // === HERO: Надпись под кнопкой ===
        $this->add_control('hero_note_heading', [
            'label' => __('💬 Надпись под кнопкой', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_control('hero_btn_note', [ 
            'label' => __('Текст надписи', 'combined-widgets'), 
            'type' => Controls_Manager::TEXT, 
            'default' => '', 
            'placeholder' => 'Ответ в течение 1 рабочего дня' 
        ]);
        
        $this->add_control('hero_note_icon', [
            'label' => __('Иконка', 'combined-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-clock',
                'library' => 'fa-solid',
            ],
        ]);
        
        $this->add_control('hero_note_icon_color', [
            'label' => __('Цвет иконки', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__note i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sb-hero-split__note svg' => 'fill: {{VALUE}};',
            ],
        ]);
        
        $this->add_control('hero_note_icon_size', [
            'label' => __('Размер иконки', 'combined-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 40,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__note i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .sb-hero-split__note svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hero_note_typography',
                'label' => __('Шрифт надписи', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .sb-hero-split__note',
            ]
        );
        
        $this->add_control('hero_note_color', [
            'label' => __('Цвет текста', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__note' => 'color: {{VALUE}};',
            ],
        ]);
        
        $this->add_responsive_control('hero_note_spacing', [
            'label' => __('Отступ сверху', 'combined-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__note' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);
        
        $this->add_responsive_control('hero_note_gap', [
            'label' => __('Отступ между иконкой и текстом', 'combined-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 30,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sb-hero-split__note' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);
        
        // === HERO: Изображение ===
        $this->add_control('hero_image_heading', [
            'label' => __('🖼️ Изображение', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_control('hero_image', [ 'label' => __('Изображение (Десктоп)', 'combined-widgets'), 'type' => Controls_Manager::MEDIA ]);
        $this->add_control('hero_image_tablet', [ 'label' => __('Изображение (Планшет)', 'combined-widgets'), 'type' => Controls_Manager::MEDIA, 'description' => __('Опционально. Если не указано, используется десктоп версия', 'combined-widgets') ]);
        $this->add_control('hero_image_mobile', [ 'label' => __('Изображение (Мобильный)', 'combined-widgets'), 'type' => Controls_Manager::MEDIA, 'description' => __('Опционально. Если не указано, используется планшет или десктоп версия', 'combined-widgets') ]);
        $this->add_control('hero_image_alt', [ 'label' => __('Alt текст изображения', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'QuickBooks Setup', 'description' => __('Для SEO и доступности', 'combined-widgets') ]);

        // === HERO: Анимация ===
        $this->add_control('hero_anim_heading', [
            'label' => __('✨ Анимация', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_control('hero_anim_enable', [ 'label' => __('Включить анимацию', 'combined-widgets'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ]);
        $this->add_control('hero_anim_type', [ 'label' => __('Тип анимации', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'fade-up', 'options' => [ 'fade' => 'Fade', 'fade-up' => 'Fade Up', 'fade-down' => 'Fade Down', 'fade-left' => 'Fade Left', 'fade-right' => 'Fade Right', 'zoom-in' => 'Zoom In', 'zoom-out' => 'Zoom Out', 'flip' => 'Flip', 'slide-up' => 'Slide Up' ], 'condition' => [ 'hero_anim_enable' => 'yes' ] ]);

        $this->end_controls_section();

        // PACKAGES
        $this->start_controls_section('packages', [
            'label' => __( 'Packages', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('packages_id', [ 'label' => __('ID секции', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'quickbooks' ]);
        $this->add_control('packages_icon', [ 'label' => __('Иконка заголовка (CSS-класс)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-bolt', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('packages_title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'QuickBooks Online: Setup / Cleanup / Monthly Support' ]);
        $this->add_control('packages_text', [ 'label' => __('Подзаголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Выберите формат — я настрою QBO так, чтобы учёт был чистым, а отчёты — точными.' ]);

        for ($n=1; $n<=3; $n++){
            $defaults = [
                1 => [ 'Setup', 'Основной', 'yes', "Правильный Chart of Accounts\nБанки, правила и автоматизация\nКатегории, налоги, отчёты\nШаблоны инвойсов", 'Заявка на QuickBooks Setup', 'accent' ],
                2 => [ 'Cleanup', '', '', "Исправлю категории и дубли\nСверю банковские операции\nПриведу отчёты в порядок\nПодготовлю к CPA/сдаче", 'Нужен Cleanup', 'ghost' ],
                3 => [ 'Monthly Support', '', '', "Ежемесячный контроль учёта\nСверки и отчётность\nРекомендации по улучшению\nПоддержка", 'Хочу сопровождение', 'ghost' ],
            ];
            $d = $defaults[$n];
            $this->add_control('p_card_' . $n . '_icon', [ 'label' => sprintf(__('Карточка %d — Иконка (CSS-класс)', 'combined-widgets'), $n), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-gear', 'placeholder' => 'fas fa-icon', 'separator' => 'before' ]);
            $this->add_control('p_card_' . $n . '_title', [ 'label' => sprintf(__('Карточка %d — Заголовок', 'combined-widgets'), $n), 'type' => Controls_Manager::TEXT, 'default' => $d[0] ]);
            $this->add_control('p_card_' . $n . '_featured', [ 'label' => sprintf(__('Карточка %d — Выделенная', 'combined-widgets'), $n), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => $d[2] ]);
            $this->add_control('p_card_' . $n . '_badge', [ 'label' => sprintf(__('Карточка %d — Бейдж', 'combined-widgets'), $n), 'type' => Controls_Manager::TEXT, 'default' => $d[1] ]);
            $this->add_control('p_card_' . $n . '_items', [ 'label' => sprintf(__('Карточка %d — Пункты', 'combined-widgets'), $n), 'type' => Controls_Manager::TEXTAREA, 'default' => $d[3] ]);
            $this->add_control('p_card_' . $n . '_btn_text', [ 'label' => sprintf(__('Карточка %d — Кнопка', 'combined-widgets'), $n), 'type' => Controls_Manager::TEXT, 'default' => $d[4] ]);
            $this->add_control('p_card_' . $n . '_btn_style', [ 'label' => sprintf(__('Карточка %d — Стиль', 'combined-widgets'), $n), 'type' => Controls_Manager::SELECT, 'default' => $d[5], 'options' => [ 'accent' => 'Accent', 'ghost' => 'Ghost' ] ]);
            $this->add_control('p_card_' . $n . '_btn_link', [ 'label' => sprintf(__('Карточка %d — Ссылка', 'combined-widgets'), $n), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false ]);
        }
        $this->add_control('p_card_1_note', [ 'label' => __('Карточка 1 — Примечание', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Ответ в течение 1 рабочего дня', 'separator' => 'before' ]);

        $this->add_control('packages_anim_enable', [ 'label' => __('Анимация', 'combined-widgets'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before' ]);
        $this->add_control('packages_anim_type', [ 'label' => __('Тип анимации', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'fade-up', 'options' => [ 'fade' => 'Fade', 'fade-up' => 'Fade Up', 'fade-down' => 'Fade Down', 'fade-left' => 'Fade Left', 'fade-right' => 'Fade Right', 'zoom-in' => 'Zoom In', 'zoom-out' => 'Zoom Out', 'flip' => 'Flip', 'slide-up' => 'Slide Up' ], 'condition' => [ 'packages_anim_enable' => 'yes' ] ]);

        $this->end_controls_section();

        // TEAM
        $this->start_controls_section('team', [
            'label' => __( 'Team', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('team_id', [ 'label' => __('ID секции', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'team' ]);
        $this->add_control('team_title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Ваши эксперты SBalance' ]);
        $this->add_control('team_subtitle', [ 'label' => __('Подзаголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Команда, которая ведёт учёт в QuickBooks и помогает с налогами.' ]);
        $this->add_control('team_columns', [ 'label' => __('Колонок', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => '3', 'options' => [ '2' => '2', '3' => '3', '4' => '4' ] ]);

        $rep = new Repeater();
        $rep->add_control('photo', [ 'label' => __('Фото', 'combined-widgets'), 'type' => Controls_Manager::MEDIA ]);
        $rep->add_control('name', [ 'label' => __('Имя', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Имя Фамилия' ]);
        $rep->add_control('role', [ 'label' => __('Должность', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Должность' ]);
        $rep->add_control('meta', [ 'label' => __('Описание', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Коротко про опыт' ]);
        $rep->add_control('telegram', [ 'label' => 'Telegram', 'type' => Controls_Manager::URL, 'show_external' => true ]);
        $rep->add_control('linkedin', [ 'label' => 'LinkedIn', 'type' => Controls_Manager::URL, 'show_external' => true ]);
        $rep->add_control('website', [ 'label' => 'Website', 'type' => Controls_Manager::URL, 'show_external' => true ]);
        $rep->add_control('email', [ 'label' => 'Email', 'type' => Controls_Manager::TEXT ]);

        $this->add_control('team_members', [
            'label' => __('Участники', 'combined-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $rep->get_controls(),
            'default' => [
                [ 'name' => 'Синкевич Ирина', 'role' => 'Основатель', 'meta' => 'Лицензированный бухгалтер', 'email' => 'hello@sbalance.us' ],
            ],
            'title_field' => '{{{ name }}}',
        ]);

        $this->add_control('team_anim_enable', [ 'label' => __('Анимация', 'combined-widgets'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before' ]);
        $this->add_control('team_anim_type', [ 'label' => __('Тип анимации', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'fade-up', 'options' => [ 'fade' => 'Fade', 'fade-up' => 'Fade Up', 'fade-down' => 'Fade Down', 'fade-left' => 'Fade Left', 'fade-right' => 'Fade Right', 'zoom-in' => 'Zoom In', 'zoom-out' => 'Zoom Out', 'flip' => 'Flip', 'slide-up' => 'Slide Up' ], 'condition' => [ 'team_anim_enable' => 'yes' ] ]);

        $this->end_controls_section();

        // BUTTONS & LINKS
        $this->start_controls_section('buttons_links', [
            'label' => __( 'Кнопки и ссылки', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('process_btn_text', [ 'label' => __('Process — Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Оставить заявку' ]);
        $this->add_control('process_btn_icon', [ 'label' => __('Process — Иконка кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-paper-plane' ]);
        $this->add_control('process_btn_action', [ 'label' => __('Process — Действие', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'link', 'options' => [ 'link' => 'Ссылка', 'popup' => 'Попап с формой' ] ]);
        $this->add_control('process_btn_link', [ 'label' => __('Process — Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false, 'condition' => [ 'process_btn_action' => 'link' ] ]);
        $this->add_control('process_btn_popup_form', [ 'label' => __('Process — Форма в попапе', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'options' => $this->get_cf7_forms(), 'condition' => [ 'process_btn_action' => 'popup' ] ]);

        $this->add_control('form1040_btn_text', [ 'label' => __('Form 1040 — Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Нужна консультация', 'separator' => 'before' ]);
        $this->add_control('form1040_btn_icon', [ 'label' => __('Form 1040 — Иконка кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-arrow-right' ]);
        $this->add_control('form1040_btn_action', [ 'label' => __('Form 1040 — Действие', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'link', 'options' => [ 'link' => 'Ссылка', 'popup' => 'Попап с формой' ] ]);
        $this->add_control('form1040_btn_link', [ 'label' => __('Form 1040 — Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false, 'condition' => [ 'form1040_btn_action' => 'link' ] ]);
        $this->add_control('form1040_btn_popup_form', [ 'label' => __('Form 1040 — Форма в попапе', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'options' => $this->get_cf7_forms(), 'condition' => [ 'form1040_btn_action' => 'popup' ] ]);

        $this->add_control('guides_btn_text', [ 'label' => __('Guides — Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Перейти в магазин', 'separator' => 'before' ]);
        $this->add_control('guides_btn_icon', [ 'label' => __('Guides — Иконка кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-arrow-right' ]);
        $this->add_control('guides_btn_link', [ 'label' => __('Guides — Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '/shop/' ], 'show_external' => false ]);

        $this->end_controls_section();

        // GUIDES + FAQ + FORM
        $this->start_controls_section('shortcodes', [
            'label' => __( 'Guides / FAQ / Form', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('guides_id', [ 'label' => __('Guides ID', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'guides' ]);
        $this->add_control('guides_shortcode', [ 'label' => __('Guides шорткод', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => '[products limit="6" columns="3" category="guides"]' ]);
        
        $this->add_control('products_type', [ 
            'label' => __('Тип вывода товаров', 'combined-widgets'), 
            'type' => Controls_Manager::SELECT, 
            'default' => 'shortcode', 
            'options' => [ 
                'shortcode' => __('Шорткод', 'combined-widgets'),
                'custom' => __('Кастомный (Repeater)', 'combined-widgets'),
                'ids' => __('По ID товаров', 'combined-widgets')
            ],
            'separator' => 'before'
        ]);
        
        // Настройки для вывода по ID
        $this->add_control('products_ids', [ 
            'label' => __('ID товаров', 'combined-widgets'), 
            'type' => Controls_Manager::TEXT, 
            'default' => '', 
            'placeholder' => '12,45,67',
            'description' => __('Укажите ID товаров через запятую', 'combined-widgets'),
            'condition' => [ 'products_type' => 'ids' ]
        ]);
        
        $this->add_control('products_columns', [ 
            'label' => __('Количество колонок', 'combined-widgets'), 
            'type' => Controls_Manager::SELECT, 
            'default' => '3', 
            'options' => [ '2' => '2', '3' => '3', '4' => '4', '6' => '6' ],
            'condition' => [ 'products_type' => 'ids' ]
        ]);
        
        $this->add_control('products_limit', [ 
            'label' => __('Количество товаров', 'combined-widgets'), 
            'type' => Controls_Manager::NUMBER, 
            'default' => 6,
            'min' => 1,
            'max' => 50,
            'condition' => [ 'products_type' => 'ids' ]
        ]);
        
        // Repeater для кастомных товаров
        $rep_products = new Repeater();
        $rep_products->add_control('product_type', [ 
            'label' => __('Источник', 'combined-widgets'), 
            'type' => Controls_Manager::SELECT, 
            'default' => 'custom', 
            'options' => [ 
                'custom' => __('Кастомный', 'combined-widgets'),
                'woo_id' => __('WooCommerce товар по ID', 'combined-widgets')
            ]
        ]);
        
        $rep_products->add_control('woo_product_id', [ 
            'label' => __('ID товара WooCommerce', 'combined-widgets'), 
            'type' => Controls_Manager::NUMBER,
            'condition' => [ 'product_type' => 'woo_id' ]
        ]);
        
        $rep_products->add_control('custom_image', [ 
            'label' => __('Изображение', 'combined-widgets'), 
            'type' => Controls_Manager::MEDIA,
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $rep_products->add_control('custom_title', [ 
            'label' => __('Название', 'combined-widgets'), 
            'type' => Controls_Manager::TEXT, 
            'default' => 'Название товара',
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $rep_products->add_control('custom_price', [ 
            'label' => __('Цена', 'combined-widgets'), 
            'type' => Controls_Manager::TEXT, 
            'default' => '$99',
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $rep_products->add_control('custom_description', [ 
            'label' => __('Описание', 'combined-widgets'), 
            'type' => Controls_Manager::TEXTAREA, 
            'default' => 'Краткое описание товара',
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $rep_products->add_control('custom_btn_text', [ 
            'label' => __('Текст кнопки', 'combined-widgets'), 
            'type' => Controls_Manager::TEXT, 
            'default' => 'Купить',
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $rep_products->add_control('custom_btn_icon', [ 
            'label' => __('Иконка кнопки', 'combined-widgets'), 
            'type' => Controls_Manager::TEXT, 
            'default' => 'fas fa-cart-shopping',
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $rep_products->add_control('custom_link', [ 
            'label' => __('Ссылка', 'combined-widgets'), 
            'type' => Controls_Manager::URL,
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $rep_products->add_control('custom_badge', [ 
            'label' => __('Бейдж', 'combined-widgets'), 
            'type' => Controls_Manager::TEXT, 
            'default' => '',
            'placeholder' => 'Новинка',
            'condition' => [ 'product_type' => 'custom' ]
        ]);
        
        $this->add_control('custom_products', [
            'label' => __('Кастомные товары', 'combined-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $rep_products->get_controls(),
            'default' => [],
            'title_field' => '{{{ product_type === "woo_id" ? "WooCommerce #" + woo_product_id : custom_title }}}',
            'condition' => [ 'products_type' => 'custom' ],
            'separator' => 'before'
        ]);
        
        $this->add_control('custom_products_columns', [ 
            'label' => __('Количество колонок', 'combined-widgets'), 
            'type' => Controls_Manager::SELECT, 
            'default' => '3', 
            'options' => [ '2' => '2', '3' => '3', '4' => '4', '6' => '6' ],
            'condition' => [ 'products_type' => 'custom' ]
        ]);
        
        $this->add_control('form_id', [ 'label' => __('Form ID', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'quickbooks-form', 'separator' => 'before' ]);
        
        // === FINAL FORM: Настройки иконки ===
        $this->add_control('final_icon_heading', [
            'label' => __('⚙️ Настройки иконки', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_control('final_icon', [
            'label' => __('Иконка', 'combined-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-paper-plane',
                'library' => 'fa-solid',
            ],
        ]);
        
        $this->add_control('final_icon_color', [
            'label' => __('Цвет иконки', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sb-final__text h2 i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sb-final__text h2 svg' => 'fill: {{VALUE}};',
            ],
        ]);
        
        $this->add_control('final_icon_size', [
            'label' => __('Размер иконки', 'combined-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 16,
                    'max' => 80,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sb-final__text h2 i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .sb-final__text h2 svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);
        
        $this->add_control('final_icon_spacing', [
            'label' => __('Отступ от иконки', 'combined-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sb-final__text h2' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);
        
        // === FINAL FORM: Настройки заголовка ===
        $this->add_control('final_title_heading', [
            'label' => __('📝 Настройки заголовка', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'final_title_typography',
                'label' => __('Шрифт заголовка', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .sb-final__text h2',
            ]
        );
        
        $this->add_control('final_title_color', [
            'label' => __('Цвет заголовка', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-final__text h2' => 'color: {{VALUE}};',
            ],
        ]);
        
        // === FINAL FORM: Настройки описания ===
        $this->add_control('final_desc_heading', [
            'label' => __('📄 Настройки описания', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'final_desc_typography',
                'label' => __('Шрифт описания', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .sb-final__text p',
            ]
        );
        
        $this->add_control('final_desc_color', [
            'label' => __('Цвет описания', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-final__text p' => 'color: {{VALUE}};',
            ],
        ]);
        
        // === FINAL FORM: Настройки секции и формы ===
        $this->add_control('final_section_heading', [
            'label' => __('🎨 Фон и отступы', 'combined-widgets'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        
        $this->add_control('final_bg_color', [
            'label' => __('Цвет фона секции', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-final' => 'background-color: {{VALUE}};',
            ],
        ]);
        
        $this->add_responsive_control('final_padding', [
            'label' => __('Отступы секции', 'combined-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sb-final' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        
        $this->add_control('final_form_bg', [
            'label' => __('Цвет фона формы', 'combined-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sb-final__form' => 'background-color: {{VALUE}};',
            ],
        ]);
        
        $this->add_responsive_control('final_form_padding', [
            'label' => __('Отступы формы', 'combined-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors' => [
                '{{WRAPPER}} .sb-final__form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        
        $cf7_forms = $this->get_cf7_forms();
        if (!empty($cf7_forms)) {
            $this->add_control('form_type', [ 
                'label' => __('Источник формы', 'combined-widgets'), 
                'type' => Controls_Manager::SELECT, 
                'default' => 'cf7', 
                'options' => [ 
                    'cf7' => __('Contact Form 7', 'combined-widgets'),
                    'shortcode' => __('Шорткод вручную', 'combined-widgets')
                ]
            ]);
            
            $this->add_control('form_cf7_id', [ 
                'label' => __('Выберите форму', 'combined-widgets'), 
                'type' => Controls_Manager::SELECT, 
                'options' => $cf7_forms,
                'condition' => [ 'form_type' => 'cf7' ]
            ]);
            
            $this->add_control('form_shortcode', [ 
                'label' => __('Form шорткод', 'combined-widgets'), 
                'type' => Controls_Manager::TEXT, 
                'default' => '', 
                'placeholder' => '[contact-form-7 id="123"]',
                'condition' => [ 'form_type' => 'shortcode' ]
            ]);
        } else {
            $this->add_control('form_shortcode', [ 
                'label' => __('Form шорткод', 'combined-widgets'), 
                'type' => Controls_Manager::TEXT, 
                'default' => '', 
                'placeholder' => '[contact-form-7 id="123"]'
            ]);
            
            $this->add_control('form_cf7_notice', [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => '<div style="padding:10px;background:#f0f0f1;border-radius:4px;margin-top:10px;">Contact Form 7 не установлен. Используйте шорткод вручную.</div>',
            ]);
        }

        $repf = new Repeater();
        $repf->add_control('q', [ 'label' => __('Вопрос', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Вопрос' ]);
        $repf->add_control('a', [ 'label' => __('Ответ', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Ответ...' ]);

        $this->add_control('faq_items', [
            'label' => __('FAQ', 'combined-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repf->get_controls(),
            'default' => [
                [ 'q' => 'Сколько времени занимает Setup?', 'a' => 'Зависит от объёма и состояния учёта.' ],
                [ 'q' => 'Можно ли начать с Cleanup?', 'a' => 'Да. Часто логичнее сначала Cleanup.' ],
                [ 'q' => 'Вы работаете на русском?', 'a' => 'Да — коммуникация на русском.' ],
            ],
            'title_field' => '{{{ q }}}',
            'separator' => 'before',
        ]);

        $this->add_control('guides_anim_enable', [ 'label' => __('Guides — Анимация', 'combined-widgets'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before' ]);
        $this->add_control('guides_anim_type', [ 'label' => __('Guides — Тип анимации', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'fade-up', 'options' => [ 'fade' => 'Fade', 'fade-up' => 'Fade Up', 'fade-down' => 'Fade Down', 'fade-left' => 'Fade Left', 'fade-right' => 'Fade Right', 'zoom-in' => 'Zoom In', 'zoom-out' => 'Zoom Out', 'flip' => 'Flip', 'slide-up' => 'Slide Up' ], 'condition' => [ 'guides_anim_enable' => 'yes' ] ]);

        $this->add_control('faq_anim_enable', [ 'label' => __('FAQ — Анимация', 'combined-widgets'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before' ]);
        $this->add_control('faq_anim_type', [ 'label' => __('FAQ — Тип анимации', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'fade-up', 'options' => [ 'fade' => 'Fade', 'fade-up' => 'Fade Up', 'fade-down' => 'Fade Down', 'fade-left' => 'Fade Left', 'fade-right' => 'Fade Right', 'zoom-in' => 'Zoom In', 'zoom-out' => 'Zoom Out', 'flip' => 'Flip', 'slide-up' => 'Slide Up' ], 'condition' => [ 'faq_anim_enable' => 'yes' ] ]);

        $this->add_control('form_anim_enable', [ 'label' => __('Form — Анимация', 'combined-widgets'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before' ]);
        $this->add_control('form_anim_type', [ 'label' => __('Form — Тип анимации', 'combined-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'fade-up', 'options' => [ 'fade' => 'Fade', 'fade-up' => 'Fade Up', 'fade-down' => 'Fade Down', 'fade-left' => 'Fade Left', 'fade-right' => 'Fade Right', 'zoom-in' => 'Zoom In', 'zoom-out' => 'Zoom Out', 'flip' => 'Flip', 'slide-up' => 'Slide Up' ], 'condition' => [ 'form_anim_enable' => 'yes' ] ]);

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
        // Support both old array format and new string format
        $icon_class = is_array( $icon ) ? ( $icon['value'] ?? '' ) : $icon;
        if ( empty( $icon_class ) ) return '';
        return '<i class="' . esc_attr( trim( $icon_class ) ) . '" aria-hidden="true" style="margin-right: 0.4em;"></i>';
    }

    private function render_list($raw) {
        $lines = preg_split('/\r\n|\r|\n/', (string)$raw);
        $out = '';
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line !== '') $out .= '<li><i class="fas fa-check"></i> ' . esc_html($line) . '</li>';
        }
        return $out;
    }

    private function link_attrs($url){
        if (empty($url) || empty($url['url'])) return '';
        $href = esc_url($url['url']);
        $target = !empty($url['is_external']) ? ' target="_blank" rel="noopener"' : '';
        return ' href="' . $href . '"' . $target;
    }

    private function section_anim($section_name) {
        $s = $this->get_settings_for_display();
        $key_enable = $section_name . '_anim_enable';
        $key_type = $section_name . '_anim_type';
        
        if (empty($s[$key_enable]) || $s[$key_enable] !== 'yes') {
            return '';
        }
        
        $type = !empty($s[$key_type]) ? $s[$key_type] : 'fade-up';
        return ' sb-anim sb-anim--' . esc_attr($type);
    }

    private function render_responsive_image($desktop, $tablet, $mobile, $alt = '', $class = '') {
        // Если нет десктоп изображения - возврат пустой строки
        if (empty($desktop['url'])) {
            return '';
        }

        // Получаем URL изображений
        $desktop_url = esc_url($desktop['url']);
        $tablet_url = !empty($tablet['url']) ? esc_url($tablet['url']) : $desktop_url;
        $mobile_url = !empty($mobile['url']) ? esc_url($mobile['url']) : $tablet_url;
        
        // Получаем размеры изображения для width/height атрибутов
        $desktop_id = !empty($desktop['id']) ? $desktop['id'] : 0;
        $image_meta = $desktop_id ? wp_get_attachment_metadata($desktop_id) : false;
        $width = $image_meta ? $image_meta['width'] : 1200;
        $height = $image_meta ? $image_meta['height'] : 800;
        
        $alt = esc_attr($alt);
        $class_attr = $class ? ' class="' . esc_attr($class) . '"' : '';
        
        $html = '<figure' . $class_attr . '>';
        $html .= '<picture>';
        
        // Mobile version (max-width: 767px)
        if ($mobile_url !== $desktop_url) {
            $html .= '<source media="(max-width: 767px)" srcset="' . $mobile_url . '" type="image/webp">';
        }
        
        // Tablet version (max-width: 1024px)
        if ($tablet_url !== $desktop_url) {
            $html .= '<source media="(max-width: 1024px)" srcset="' . $tablet_url . '" type="image/webp">';
        }
        
        // Desktop version (fallback)
        $html .= '<img src="' . $desktop_url . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" loading="lazy" decoding="async">';
        
        $html .= '</picture>';
        $html .= '</figure>';
        
        return $html;
    }

    private function render_button($prefix) {
        $s = $this->get_settings_for_display();
        $text = $s[$prefix . '_btn_text'];
        $icon = $s[$prefix . '_btn_icon'];
        $action = !empty($s[$prefix . '_btn_action']) ? $s[$prefix . '_btn_action'] : 'link';
        
        if ($action === 'popup') {
            $form_id = !empty($s[$prefix . '_btn_popup_form']) ? intval($s[$prefix . '_btn_popup_form']) : 0;
            if ($form_id && function_exists('wpcf7')) {
                return '<a class="sb-btn sb-btn--accent" href="#" data-popup-form="' . $form_id . '">' . 
                       $this->icon_html($icon) . esc_html($text) . '</a>';
            }
        }
        
        // Default link action
        $link = $s[$prefix . '_btn_link'];
        return '<a class="sb-btn sb-btn--accent"' . $this->link_attrs($link) . '>' . 
               $this->icon_html($icon) . esc_html($text) . '</a>';
    }

    private function get_form_shortcode() {
        $s = $this->get_settings_for_display();
        
        if (!empty($s['form_type']) && $s['form_type'] === 'cf7' && !empty($s['form_cf7_id'])) {
            return '[contact-form-7 id="' . intval($s['form_cf7_id']) . '"]';
        }
        
        return trim((string)$s['form_shortcode']);
    }

    private function render_woo_product_by_id($product_id) {
        if (!function_exists('wc_get_product')) return '';
        $product = wc_get_product($product_id);
        if (!$product) return '';
        
        $title = $product->get_name();
        $price = $product->get_price_html();
        $link = get_permalink($product_id);
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'medium');
        $img_url = $image ? $image[0] : wc_placeholder_img_src();
        $desc = wp_trim_words($product->get_short_description(), 15);
        
        $html = '<article class="sb-product-card">';
        $html .= '<a href="' . esc_url($link) . '" class="sb-product-card__image"><img src="' . esc_url($img_url) . '" alt="' . esc_attr($title) . '"></a>';
        $html .= '<div class="sb-product-card__content">';
        $html .= '<h3 class="sb-product-card__title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h3>';
        if ($desc) $html .= '<p class="sb-product-card__desc">' . esc_html($desc) . '</p>';
        $html .= '<div class="sb-product-card__footer">';
        $html .= '<div class="sb-product-card__price">' . $price . '</div>';
        $html .= '<a href="' . esc_url($link) . '" class="sb-btn sb-btn--accent"><i class="fas fa-cart-shopping"></i> ' . __('Купить', 'combined-widgets') . '</a>';
        $html .= '</div></div></article>';
        
        return $html;
    }
    
    private function render_custom_product($item) {
        $title = $item['custom_title'];
        $price = $item['custom_price'];
        $desc = $item['custom_description'];
        $btn_text = $item['custom_btn_text'];
        $btn_icon = $item['custom_btn_icon'];
        $link = $item['custom_link'];
        $badge = $item['custom_badge'];
        $image = !empty($item['custom_image']['url']) ? $item['custom_image']['url'] : '';
        
        $html = '<article class="sb-product-card">';
        if ($badge) $html .= '<div class="sb-badge sb-badge--product"><i class="fas fa-star"></i> ' . esc_html($badge) . '</div>';
        if ($image) {
            $html .= '<div class="sb-product-card__image">';
            if (!empty($link['url'])) $html .= '<a' . $this->link_attrs($link) . '>';
            $html .= '<img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '">';
            if (!empty($link['url'])) $html .= '</a>';
            $html .= '</div>';
        }
        $html .= '<div class="sb-product-card__content">';
        $html .= '<h3 class="sb-product-card__title">';
        if (!empty($link['url'])) $html .= '<a' . $this->link_attrs($link) . '>';
        $html .= esc_html($title);
        if (!empty($link['url'])) $html .= '</a>';
        $html .= '</h3>';
        if ($desc) $html .= '<p class="sb-product-card__desc">' . esc_html($desc) . '</p>';
        $html .= '<div class="sb-product-card__footer">';
        if ($price) $html .= '<div class="sb-product-card__price">' . esc_html($price) . '</div>';
        if (!empty($link['url'])) {
            $html .= '<a class="sb-btn sb-btn--accent"' . $this->link_attrs($link) . '>';
            $html .= $this->icon_html($btn_icon) . esc_html($btn_text);
            $html .= '</a>';
        }
        $html .= '</div></div></article>';
        
        return $html;
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        // HERO
        $hero_title = wp_kses_post($s['hero_title']);
        $hero_text = wp_kses_post(nl2br(esc_html($s['hero_text'])));
        
        // Hero button
        $hero_btn_action = !empty($s['hero_btn_action']) ? $s['hero_btn_action'] : 'link';
        if ($hero_btn_action === 'popup' && !empty($s['hero_btn_popup_form'])) {
            $hero_btn = '<a class="sb-hero-split__btn" href="#" data-popup-form="' . intval($s['hero_btn_popup_form']) . '">' . $this->icon_html($s['hero_btn_icon']) . esc_html($s['hero_btn_text']) . '</a>';
        } else {
            $hlink = $s['hero_btn_link'];
            $hhref = !empty($hlink['url']) ? esc_url($hlink['url']) : '#';
            $htarget = !empty($hlink['is_external']) ? ' target="_blank" rel="noopener"' : '';
            $hero_btn = '<a class="sb-hero-split__btn" href="' . $hhref . '"' . $htarget . '>' . $this->icon_html($s['hero_btn_icon']) . esc_html($s['hero_btn_text']) . '</a>';
        }
        
        // Hero note with custom icon
        $hero_note = '';
        if (!empty($s['hero_btn_note'])) {
            $note_icon_html = '';
            if (!empty($s['hero_note_icon']['value'])) {
                ob_start();
                Icons_Manager::render_icon($s['hero_note_icon'], ['aria-hidden' => 'true']);
                $note_icon_html = ob_get_clean();
            }
            $hero_note = '<div class="sb-hero-split__note">' . $note_icon_html . ' ' . esc_html($s['hero_btn_note']) . '</div>';
        }

        // Hero responsive image
        $hero_image = $this->render_responsive_image(
            $s['hero_image'],
            !empty($s['hero_image_tablet']) ? $s['hero_image_tablet'] : [],
            !empty($s['hero_image_mobile']) ? $s['hero_image_mobile'] : [],
            !empty($s['hero_image_alt']) ? $s['hero_image_alt'] : 'Hero image',
            'sb-hero-split__figure'
        );

        echo '<section class="sb-hero-split' . $this->section_anim('hero') . '">';
        echo '<div class="sb-hero-split__inner">';
        echo '<div class="sb-hero-split__content sb-anim__item"><h1>' . $hero_title . '</h1><p>' . $hero_text . '</p>';
        echo $hero_btn . $hero_note . '</div>';
        echo '<div class="sb-hero-split__media sb-anim__item">' . $hero_image . '</div>';
        echo '</div></section>';

        // PACKAGES
        echo '<section class="sb-section sb-packages' . $this->section_anim('packages') . '" id="' . esc_attr(sanitize_title($s['packages_id'])) . '">';
        echo '<div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2>' . $this->icon_html($s['packages_icon']) . esc_html($s['packages_title']) . '</h2><p>' . esc_html($s['packages_text']) . '</p></div>';
        echo '<div class="sb-grid sb-grid--3">';
        for($n=1; $n<=3; $n++){
            $featured = !empty($s['p_card_' . $n . '_featured']) && $s['p_card_' . $n . '_featured']==='yes';
            $badge = trim((string)$s['p_card_' . $n . '_badge']);
            $link = $s['p_card_' . $n . '_btn_link'];
            $href = !empty($link['url']) ? esc_url($link['url']) : '#';
            $target = !empty($link['is_external']) ? ' target="_blank" rel="noopener"' : '';
            $btn_style = $s['p_card_' . $n . '_btn_style'] === 'accent' ? 'sb-btn--accent' : 'sb-btn--ghost';

            echo '<article class="sb-card sb-anim__item' . ($featured ? ' sb-card--featured' : '') . '">';
            if ($badge) echo '<div class="sb-badge"><i class="fas fa-star"></i> ' . esc_html($badge) . '</div>';
            echo '<h3>' . $this->icon_html($s['p_card_' . $n . '_icon']) . esc_html($s['p_card_' . $n . '_title']) . '</h3>';
            echo '<ul class="sb-list">' . $this->render_list($s['p_card_' . $n . '_items']) . '</ul>';
            echo '<a class="sb-btn ' . $btn_style . '" href="' . $href . '"' . $target . '><i class="fas fa-paper-plane"></i> ' . esc_html($s['p_card_' . $n . '_btn_text']) . '</a>';
            if ($n === 1 && !empty($s['p_card_1_note'])) echo '<div class="sb-note"><i class="far fa-clock"></i> ' . esc_html($s['p_card_1_note']) . '</div>';
            echo '</article>';
        }
        echo '</div></div></section>';

        // TRUST STRIP
        echo '<section class="sb-section sb-trust' . $this->section_anim('packages') . '"><div class="sb-container"><div class="sb-strip">';
        $trust = [ ['fas fa-language', 'На русском', 'Понятно и без стресса'], ['fas fa-shield-halved', 'Аккуратно', 'Чистая структура учёта'], ['fas fa-rocket', 'Быстрый старт', 'Двигаемся по шагам'] ];
        foreach($trust as $t){
            echo '<div class="sb-strip__item sb-anim__item"><div class="sb-ico"><i class="' . $t[0] . '"></i></div><div><div class="sb-strip__title">' . $t[1] . '</div><div class="sb-strip__text">' . $t[2] . '</div></div></div>';
        }
        echo '</div></div></section>';

        // PROCESS
        echo '<section class="sb-section sb-process' . $this->section_anim('packages') . '"><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-route"></i> Как проходит работа</h2><p>Прозрачный процесс: вы понимаете, что происходит на каждом шаге.</p></div>';
        echo '<div class="sb-steps">';
        $steps = [['Заявка', 'Коротко описываете задачу'], ['Аудит', 'Смотрю структуру, банки, категории'], ['Настройка / Cleanup', 'Навожу порядок и фиксирую правила'], ['Результат', 'Корректные отчёты и понятная система']];
        foreach($steps as $i => $st){ echo '<div class="sb-step sb-anim__item"><div class="sb-step__num">' . ($i+1) . '</div><div class="sb-step__body"><h3><i class="fas fa-circle-check"></i> ' . $st[0] . '</h3><p>' . $st[1] . '</p></div></div>'; }
        echo '</div><div class="sb-center sb-anim__item">' . $this->render_button('process') . '</div>';
        echo '</div></section>';

        // REVIEWS
        echo '<section class="sb-section sb-reviews' . $this->section_anim('packages') . '" id="reviews"><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-comment-dots"></i> Отзывы клиентов</h2><p>Несколько коротких отзывов</p></div>';
        echo '<div class="sb-grid sb-grid--3">';
        $reviews = [ ['Setup', '«Всё настроили аккуратно и быстро.»', 'Клиент, бизнес в США'], ['Cleanup', '«После cleanup отчёты стали нормальными.»', 'Клиент, сервисный бизнес'], ['Support', '«Ежемесячно всё под контролем.»', 'Клиент, e-commerce'] ];
        foreach($reviews as $r){ echo '<article class="sb-quote sb-anim__item"><div class="sb-quote__top"><div class="sb-quote__stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div><div class="sb-quote__badge"><i class="fas fa-check"></i> ' . $r[0] . '</div></div><p>' . $r[1] . '</p><div class="sb-quote__who"><i class="fas fa-user"></i> ' . $r[2] . '</div></article>'; }
        echo '</div></div></section>';

        // FORM 1040
        echo '<section class="sb-section sb-secondary' . $this->section_anim('packages') . '" id="form-1040"><div class="sb-container"><div class="sb-two">';
        echo '<div class="sb-anim__item"><h2><i class="fas fa-file-invoice"></i> Помощь по Form 1040</h2><p>Консультации по налоговым декларациям.</p><ul class="sb-list"><li><i class="fas fa-check"></i> Разбор ситуации</li><li><i class="fas fa-check"></i> Ответы простым языком</li><li><i class="fas fa-check"></i> Проверка документов</li></ul>' . $this->render_button('form1040') . '</div>';
        echo '<div class="sb-card sb-card--soft sb-anim__item"><h3><i class="fas fa-circle-info"></i> Если вы пришли "только по налогам"</h3><p>Оставьте заявку — уточню детали.</p></div>';
        echo '</div></div></section>';

        // TEAM
        $cols = max(1, min(4, intval($s['team_columns'])));
        echo '<section class="sb-team' . $this->section_anim('team') . '" id="' . esc_attr(sanitize_title($s['team_id'])) . '"><div class="sb-container">';
        echo '<header class="sb-team__head sb-anim__item"><h2>' . esc_html($s['team_title']) . '</h2><p class="sb-team__sub">' . esc_html($s['team_subtitle']) . '</p></header>';
        echo '<div class="sb-team__grid" style="grid-template-columns: repeat(' . $cols . ', 1fr);">';
        if (!empty($s['team_members']) && is_array($s['team_members'])) {
            foreach ($s['team_members'] as $m) {
                $img = !empty($m['photo']['url']) ? '<img src="' . esc_url($m['photo']['url']) . '" alt="' . esc_attr($m['name']) . '">' : '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" alt="' . esc_attr($m['name']) . '" style="background:rgba(11,43,75,.06);">';
                echo '<article class="sb-team__card sb-anim__item"><div class="sb-team__photo">' . $img . '</div>';
                echo '<div class="sb-team__name">' . esc_html($m['name']) . '</div><div class="sb-team__role">' . esc_html($m['role']) . '</div><div class="sb-team__meta">' . esc_html($m['meta']) . '</div>';
                $links = [];
                if (!empty($m['telegram']['url'])) $links[] = '<a' . $this->link_attrs($m['telegram']) . '><i class="fab fa-telegram"></i></a>';
                if (!empty($m['linkedin']['url'])) $links[] = '<a' . $this->link_attrs($m['linkedin']) . '><i class="fab fa-linkedin"></i></a>';
                if (!empty($m['website']['url'])) $links[] = '<a' . $this->link_attrs($m['website']) . '><i class="fas fa-link"></i></a>';
                if (!empty($m['email']) && is_email($m['email'])) $links[] = '<a href="mailto:' . antispambot(esc_attr($m['email'])) . '"><i class="fas fa-envelope"></i></a>';
                if (!empty($links)) echo '<div class="sb-team__links">' . implode('', $links) . '</div>';
                echo '</article>';
            }
        }
        echo '</div></div></section>';

        // GUIDES
        $products_type = $s['products_type'];
        echo '<section class="sb-section sb-guides' . $this->section_anim('guides') . '" id="' . esc_attr(sanitize_title($s['guides_id'])) . '"><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-book-open"></i> PDF-гайды</h2><p>Гайды по QuickBooks и формам IRS.</p></div>';
        
        if ($products_type === 'shortcode') {
            // Стандартный шорткод
            $gscode = trim((string)$s['guides_shortcode']);
            echo '<div class="sb-products sb-anim__item">' . ($gscode ? do_shortcode($gscode) : '<div class="sb-products__placeholder"><i class="fas fa-cart-shopping"></i> Здесь товары WooCommerce</div>') . '</div>';
            
        } elseif ($products_type === 'ids' && function_exists('wc_get_product')) {
            // Вывод по ID товаров
            $ids = array_filter(array_map('trim', explode(',', $s['products_ids'])));
            $columns = max(1, min(6, intval($s['products_columns'])));
            $limit = max(1, min(50, intval($s['products_limit'])));
            
            if (!empty($ids)) {
                echo '<div class="sb-products-grid sb-anim__item" style="grid-template-columns: repeat(' . $columns . ', 1fr);">';
                $count = 0;
                foreach ($ids as $product_id) {
                    if ($count >= $limit) break;
                    echo $this->render_woo_product_by_id(intval($product_id));
                    $count++;
                }
                echo '</div>';
            } else {
                echo '<div class="sb-products__placeholder sb-anim__item"><i class="fas fa-cart-shopping"></i> Укажите ID товаров</div>';
            }
            
        } elseif ($products_type === 'custom') {
            // Кастомные товары из repeater
            $custom_products = $s['custom_products'];
            $columns = max(1, min(6, intval($s['custom_products_columns'])));
            
            if (!empty($custom_products) && is_array($custom_products)) {
                echo '<div class="sb-products-grid sb-anim__item" style="grid-template-columns: repeat(' . $columns . ', 1fr);">';
                foreach ($custom_products as $item) {
                    if ($item['product_type'] === 'woo_id' && !empty($item['woo_product_id'])) {
                        echo $this->render_woo_product_by_id(intval($item['woo_product_id']));
                    } else {
                        echo $this->render_custom_product($item);
                    }
                }
                echo '</div>';
            } else {
                echo '<div class="sb-products__placeholder sb-anim__item"><i class="fas fa-cart-shopping"></i> Добавьте товары в repeater</div>';
            }
        }
        
        echo '<div class="sb-center sb-anim__item"><a class="sb-btn sb-btn--ghost"' . $this->link_attrs($s['guides_btn_link']) . '>' . $this->icon_html($s['guides_btn_icon']) . esc_html($s['guides_btn_text']) . '</a></div>';
        echo '</div></section>';

        // FAQ
        echo '<section class="sb-section sb-faq' . $this->section_anim('faq') . '"><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-circle-question"></i> Частые вопросы</h2><p>Коротко — по делу.</p></div>';
        echo '<div class="sb-faq__items">';
        if (!empty($s['faq_items']) && is_array($s['faq_items'])) {
            foreach ($s['faq_items'] as $it) {
                echo '<details class="sb-faq__item sb-anim__item"><summary><i class="fas fa-angle-down"></i> ' . esc_html($it['q']) . '</summary><div class="sb-faq__content">' . esc_html($it['a']) . '</div></details>';
            }
        }
        echo '</div></div></section>';

        // FINAL FORM
        $fscode = $this->get_form_shortcode();
        $final_icon = $s['final_icon'];
        $icon_html = '';
        if (!empty($final_icon['value'])) {
            ob_start();
            Icons_Manager::render_icon($final_icon, ['aria-hidden' => 'true']);
            $icon_html = ob_get_clean();
        }
        
        echo '<section class="sb-section sb-final' . $this->section_anim('form') . '" id="' . esc_attr(sanitize_title($s['form_id'])) . '"><div class="sb-container"><div class="sb-final__box">';
        echo '<div class="sb-final__text sb-anim__item"><h2>' . $icon_html . ' Оставьте заявку на QuickBooks Setup</h2><p>Опишите задачу — я отвечу.</p></div>';
        echo '<div class="sb-final__form sb-anim__item">' . ($fscode ? do_shortcode($fscode) : '<div class="sb-form-placeholder"><i class="fas fa-envelope"></i> Здесь будет форма</div>') . '</div>';
        echo '</div></div></section>';
    }
}








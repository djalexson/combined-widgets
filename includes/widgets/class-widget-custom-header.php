<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Custom_Header extends Widget_Base {
    
    private static $controls_registered = false;
    
    public function get_name() {
        return 'as_custom_header_widget';
    }

    public function get_title() {
        return __( 'AS Custom Header Widget', 'combined-widgets' );
    }

    public function get_icon()
    {
        return 'eicon-site-title';
    }

    public function get_categories() {
        return [ 'as-widgets' ];
    }
    
    // Отключаем автоматическую регистрацию при инициализации редактора
    public function is_reload_preview_required() {
        return false;
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Контент', 'combined-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'menu',
            [
                'label' => __('Выбор меню', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_menus(),
            ]
        );
        $this->add_control(
            'logo',
            [
                'label' => __('Выберите иконку логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'logo_text',
            [
                'label' => __('Любой текст', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Введите текст ,который будет отображаться сверху ,если нужно', 'combined-widgets'),
                'placeholder' => __('Введите текст', 'combined-widgets'),
            ]
        );

        $this->add_control(
            'enable_top_block',
            [
                'label' => __('Показывать верхний блок', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Да', 'combined-widgets'),
                'label_off' => __('Нет', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить/отключить верхнюю панель с описанием и email', 'combined-widgets'),
                'separator' => 'before',
            ]
        );


       $this->add_control(
            'email_adress',
            [
                'label' => __('Email адрес', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('info@ohrana-rubezh.ru', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'enable_email_adress-mob',
            [
                'label' => __('Показывать email адрес в бургере?', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить и отключить email адрес в бургере', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'phone_number',
            [
                'label' => __('Номер телефона основной', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('+8 (920) 229-99-74', 'combined-widgets'),
            ]
        );
        // Второй номер телефона
        $this->add_control(
            'phone_number_2',
            [
                'label' => __('Номер телефона дополнительный', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '+8 (920) 229-99-74',
            ]
        );

        $this->add_control(
            'use_custom_phone_icon',
            [
                'label' => __('Использовать свою иконку телефона', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Да', 'combined-widgets'),
                'label_off' => __('Нет', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => '',
                'description' => __('Включите, чтобы выбрать свою иконку вместо стандартной', 'combined-widgets'),
            ]
        );

        $this->add_control(
            'phone_icon',
            [
                'label' => __('Иконка телефона', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-phone-alt',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'phone',
                        'phone-alt',
                        'phone-volume',
                        'mobile-alt',
                        'headset',
                    ],
                ],
                'condition' => [
                    'use_custom_phone_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_phone_number-mob',
            [
                'label' => __('Показывать основной номер в бургере?', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить и отключить основной номер в бургере', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'enable_phone_number_2-mob',
            [
                'label' => __('Показывать доп. номер в бургере?', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить и отключить дополнительный номер в бургере', 'combined-widgets'),
            ]
        );

        // Репитер социальных иконок
        $repeater_social = new \Elementor\Repeater();

        $repeater_social->add_control(
            'social_icon',
            [
                'label' => __('Иконка', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-telegram-plane',
                    'library' => 'fa-brands',
                ],
            ]
        );

        $repeater_social->add_control(
            'social_link',
            [
                'label' => __('Ссылка', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://example.com', 'combined-widgets'),
            ]
        );

        $repeater_social->add_control(
            'social_icon_color',
            [
                'label' => __('Цвет иконки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} a svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater_social->add_control(
            'social_icon_hover_color',
            [
                'label' => __('Цвет при наведении', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} a:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_icons_list',
            [
                'label' => __('Социальные иконки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_social->get_controls(),
                'default' => [],
                'title_field' => '<i class="{{{ social_icon.value }}}"></i>',
            ]
        );

        $this->add_control(
            'enable_icon-mob',
            [
                'label' => __('Показывать иконки в бургере?', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить и отключить иконки в бургере', 'combined-widgets'),
            ]
        );

        // Polylang Language Switcher
        $this->add_control(
            'polylang_heading',
            [
                'label' => __('Переключатель языков (Polylang)', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'enable_polylang',
            [
                'label' => __('Включить переключатель языков', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => '',
                'description' => __('Показать переключатель языков Polylang', 'combined-widgets'),
            ]
        );

        $this->add_control(
            'polylang_show_flags',
            [
                'label' => __('Показывать флаги', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_polylang' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'polylang_show_names',
            [
                'label' => __('Показывать названия языков', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_polylang' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'polylang_dropdown',
            [
                'label' => __('Выпадающий список', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Показывать языки в выпадающем списке', 'combined-widgets'),
                'condition' => [
                    'enable_polylang' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'polylang_hide_current',
            [
                'label' => __('Скрыть текущий язык', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'enable_polylang' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_polylang_mob',
            [
                'label' => __('Показывать в бургер-меню', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Показать переключатель языков в мобильном меню', 'combined-widgets'),
                'condition' => [
                    'enable_polylang' => 'yes',
                ],
            ]
        );



        $this->end_controls_section();

        // Порядок блоков (не меняем разметку — управляем через CSS order)
        $this->start_controls_section(
            'layout_order_section',
            [
                'label' => __('Порядок блоков', 'combined-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'order_logo_block',
            [
                'label' => __('Лого/описание', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__nav .header-widget__logo-description' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_menu_block',
            [
                'label' => __('Меню', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__nav .header-widget__menu' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_buttons_block',
            [
                'label' => __('Кнопки/телефоны', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__nav .header-widget__buttons' => 'order: {{VALUE}};',
                ],
            ]
        );

        // Внутренний порядок в блоке кнопок
        $this->add_responsive_control(
            'order_phone_main',
            [
                'label' => __('Порядок: основной телефон', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__buttons > .header-widget__phone-number:not(.header-widget__phone-number--second)' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_phone_second',
            [
                'label' => __('Порядок: доп. телефон', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__buttons > .header-widget__phone-number--second' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_button_main',
            [
                'label' => __('Порядок: кнопка', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__buttons > .header-widget__callback-button, {{WRAPPER}} .header-widget__buttons > .header-widget__button' => 'order: {{VALUE}};',
                ],
            ]
        );

        // Моб. порядок
        $this->add_responsive_control(
            'order_phone_main_mob',
            [
                'label' => __('Моб: основной телефон', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget-mob__wrap > .header-widget__phone-number--mob:not(.header-widget__phone-number--mob-second)' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_phone_second_mob',
            [
                'label' => __('Моб: доп. телефон', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget-mob__wrap > .header-widget__phone-number--mob-second' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_button_main_mob',
            [
                'label' => __('Моб: кнопка', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget-mob__wrap > .header-widget__callback-button--mob' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_top_location',
            [
                'label' => __('Top: Адрес/РІСЂРµРјСЏ', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__top .header-widget__location' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'order_top_contacts',
            [
                'label' => __('Top: Контакты/ссылки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 0,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__top .header-widget__contacts' => 'order: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_gap',
            [
                'label' => __('Отступ между колонками (gap)', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','rem','em','%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__nav' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Стили: типографика, цвета, размеры
        $this->start_controls_section(
            'style_section_typo',
            [
                'label' => __('Типографика', 'combined-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'base_typography',
                'label' => __('Базовая типографика', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .header-widget',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'label' => __('Меню', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .menu__item .menu__link',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'phone_typography',
                'label' => __('Телефоны', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .header-widget__phone-number-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Кнопка', 'combined-widgets'),
                'selector' => '{{WRAPPER}} .header-widget__button, {{WRAPPER}} .header-widget__callback-button',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section_colors',
            [
                'label' => __('Цвета', 'combined-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_bg_color',
            [
                'label' => __('Фон шапки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_text_color',
            [
                'label' => __('Цвет текста', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => __('Линия-разделитель', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__separator' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'nav_link_color',
            [
                'label' => __('Меню: цвет', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu__item .menu__link' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'nav_link_hover_color',
            [
                'label' => __('Меню: hover', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu__item:hover .menu__link' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'phone_color',
            [
                'label' => __('Цвет телефона', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__phone-number, {{WRAPPER}} .header-widget__phone-number-text' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'email_color',
            [
                'label' => __('Цвет e-mail', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__email, {{WRAPPER}} .header-widget__email-address' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Кнопка: текст', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__button, {{WRAPPER}} .header-widget__callback-button' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Кнопка: фон', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__button, {{WRAPPER}} .header-widget__callback-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_hover_color',
            [
                'label' => __('Кнопка: фон при наведении', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-widget__button:hover, {{WRAPPER}} .header-widget__callback-button:hover' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section_sizes',
            [
                'label' => __('Размеры', 'combined-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'logo_width',
            [
                'label' => __('Ширина логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','rem','%','vw'],
                'range' => [
                    'px' => ['min' => 20, 'max' => 800, 'step' => 1],
                    'rem' => ['min' => 1, 'max' => 50, 'step' => 0.1],
                    '%' => ['min' => 5, 'max' => 100, 'step' => 1],
                    'vw' => ['min' => 1, 'max' => 50, 'step' => 0.1],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo-img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .header-widget__logo-link' => 'width: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_height',
            [
                'label' => __('Высота логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','rem','vh'],
                'range' => [
                    'px' => ['min' => 20, 'max' => 400, 'step' => 1],
                    'rem' => ['min' => 1, 'max' => 25, 'step' => 0.1],
                    'vh' => ['min' => 1, 'max' => 30, 'step' => 0.1],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_max_width',
            [
                'label' => __('Макс. ширина логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','rem','%'],
                'range' => [
                    'px' => ['min' => 50, 'max' => 1000, 'step' => 5],
                    'rem' => ['min' => 3, 'max' => 60, 'step' => 0.5],
                    '%' => ['min' => 10, 'max' => 100, 'step' => 1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo-img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_max_height',
            [
                'label' => __('Макс. высота логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','rem'],
                'range' => [
                    'px' => ['min' => 20, 'max' => 500, 'step' => 5],
                    'rem' => ['min' => 1, 'max' => 30, 'step' => 0.5],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo-img' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_object_fit',
            [
                'label' => __('Подгонка изображения', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'contain',
                'options' => [
                    'contain' => __('Вместить', 'combined-widgets'),
                    'cover' => __('Заполнить', 'combined-widgets'),
                    'fill' => __('Растянуть', 'combined-widgets'),
                    'scale-down' => __('Уменьшить', 'combined-widgets'),
                    'none' => __('Без изменений', 'combined-widgets'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo-img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_margin',
            [
                'label' => __('Отступы логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'logo_padding',
            [
                'label' => __('Внутренние отступы логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Кнопка: внутренние отступы', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px','em','rem'],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__button, {{WRAPPER}} .header-widget__callback-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Button', 'combined-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Текст кнопки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Обратный звонок', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'enable_button_text-mob',
            [
                'label' => __('Показывать кнопку в бургере?', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить и отключить кнопку в бургере', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'button_type',
            [
                'label' => __('Тип кнопки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'link' => __('Link', 'combined-widgets'),
                    'submit' => __('Submit', 'combined-widgets'),
                ],
                'default' => 'link',
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => __('Ссылка кнопки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'combined-widgets'),
                'condition' => [
                    'button_type' => 'link',
                ],
            ]
        );
        $this->add_control(
            'button_id',
            [
                'label' => __('ID', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'description' => __('Добавить id кнопки ', 'combined-widgets'),
            ]
        );

        $this->add_control(
            'button_class',
            [
                'label' => __('Класс кнопки', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'description' => __('Добавить кастомный класс кнопки', 'combined-widgets'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'contact_form_7_section',
            [
                'label' => __('Popup Contact Form 7', 'combined-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'enable_popup',
            [
                'label' => __('Включить попап', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => '',
                'description' => __('Включить и отключить попап', 'combined-widgets'),
            ]
        );

        $this->add_control(
            'contact_form',
            [
                'label' => __('Выберите контактную форму', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_contact_forms(),
                'default' => 'default_form',
                'condition' => [
                    'enable_popup' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'popup_text',
            [
                'label' => __('Описание попапа,текст будет внизу заголовка', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Оставьте свой номер - наш специалист перезвонит в ближайшее время', 'combined-widgets'),
                'placeholder' => __('Введите текст', 'combined-widgets'),
                'condition' => [
                    'enable_popup' => 'yes', // Исправлено на 'Yes'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_menus()
    {
        static $cached_menus = null;
        
        if ($cached_menus !== null) {
            return $cached_menus;
        }
        
        $menus = wp_get_nav_menus();
        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        $cached_menus = $options;
        return $options;
    }
    private function get_contact_forms()
    {
        static $cached_forms = null;
        
        if ($cached_forms !== null) {
            return $cached_forms;
        }
        
        $forms = ['0' => __('-- Select Form --', 'combined-widgets')];
        
        if (class_exists('WPCF7')) {
            // Используем transient для кеширования на 1 час
            $cache_key = 'cw_contact_forms_list';
            $cached = get_transient($cache_key);
            
            if ($cached !== false) {
                $cached_forms = $cached;
                return $cached_forms;
            }
            
            $contact_forms = get_posts([
                'post_type' => 'wpcf7_contact_form',
                'numberposts' => 50, // Ограничиваем выборку
                'orderby' => 'title',
                'order' => 'ASC',
                'post_status' => 'publish'
            ]);
            
            foreach ($contact_forms as $form) {
                $forms[$form->ID] = $form->post_title;
            }
            
            set_transient($cache_key, $forms, HOUR_IN_SECONDS);
        }
        
        $cached_forms = $forms;
        return $forms;
    }
    private function sanitize_phone_number($phone)
    {
        // Убираем пробелы, тире, скобки (круглые, фигурные и квадратные)
        $cleaned_phone = preg_replace('/[ \-\(\)\{\}\[\]]/', '', $phone);

        // Проверяем, начинается ли строка с плюса
        if (strpos($cleaned_phone, '+') !== 0) {
            $cleaned_phone = '+' . $cleaned_phone;
        }

        return $cleaned_phone;
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $menu = $settings['menu'];
        $logo = $settings['logo']['url'];
        $logo_text = $settings['logo_text'];
        $phone_number = $settings['phone_number'];
       $sanitize_phone_number = !empty($phone_number) ?  $this->sanitize_phone_number($phone_number) : 0;
        $phone_number_2 = !empty($settings['phone_number_2']) ? $settings['phone_number_2'] : '';
        $sanitize_phone_number_2 = !empty($phone_number_2) ?  $this->sanitize_phone_number($phone_number_2) : 0;
        $use_custom_phone_icon = isset($settings['use_custom_phone_icon']) ? $settings['use_custom_phone_icon'] : '';
        $phone_icon = isset($settings['phone_icon']) ? $settings['phone_icon'] : [];
        $email_adress = $settings['email_adress'];
        $enable_email_adress_mob = $settings['enable_email_adress-mob'];
        $enable_phone_number_mob = $settings['enable_phone_number-mob'];
        $enable_phone_number_2_mob = isset($settings['enable_phone_number_2-mob']) ? $settings['enable_phone_number_2-mob'] : '';
        $social_icons_list = isset($settings['social_icons_list']) ? $settings['social_icons_list'] : [];
        $enable_icon_mob = $settings['enable_icon-mob'];
        $enable_top_block = isset($settings['enable_top_block']) ? $settings['enable_top_block'] : 'yes';
        $button_text = isset($settings['button_text']) ? $settings['button_text'] : '';
        $popup_text = isset($settings['popup_text']) ? $settings['popup_text'] : '';
        $enable_button_text_mob = isset($settings['enable_button_text-mob']) ? $settings['enable_button_text-mob'] : 'yes';
        $button_type = isset($settings['button_type']) ? $settings['button_type'] : 'link';
        $button_url = !empty($settings['button_url']['url']) ? $settings['button_url']['url'] : '#';
        $button_id = !empty($settings['button_id']) ? $settings['button_id'] : '';
        $button_class = !empty($settings['button_class']) ? $settings['button_class'] : '';
        $popup_id = 'opal-contactform-popup-' . $this->get_id();
        $popup_html = '';
        $popup_data = '';

        // Polylang settings
        $enable_polylang = isset($settings['enable_polylang']) ? $settings['enable_polylang'] : '';
        $polylang_show_flags = isset($settings['polylang_show_flags']) ? $settings['polylang_show_flags'] : 'yes';
        $polylang_show_names = isset($settings['polylang_show_names']) ? $settings['polylang_show_names'] : 'yes';
        $polylang_dropdown = isset($settings['polylang_dropdown']) ? $settings['polylang_dropdown'] : 'yes';
        $polylang_hide_current = isset($settings['polylang_hide_current']) ? $settings['polylang_hide_current'] : '';
        $enable_polylang_mob = isset($settings['enable_polylang_mob']) ? $settings['enable_polylang_mob'] : 'yes';
       
				if (isset($settings['enable_popup']) && $settings['enable_popup'] === 'yes') {
            $popup_data = 'data-effect="mfp-zoom-in"';
            $popup_html = '<div class="mfp-hide contactform-content my-popup" id="' . esc_attr($popup_id) . '">';
            $popup_html .= '<div class="heading-form">';
            if (!empty($settings['contact_form'])) {
                $form_id = intval($settings['contact_form']);
                // Кешируем заголовок формы
                $cache_key = 'cw_form_title_' . $form_id;
                $form_title = get_transient($cache_key);
                if ($form_title === false) {
                    $form_post = get_post($form_id);
                    if ($form_post) {
                        $form_title = esc_html($form_post->post_title);
                        set_transient($cache_key, $form_title, DAY_IN_SECONDS);
                    } else {
                        $form_title = __('Untitled Form', 'combined-widgets');
                    }
                }
                $popup_html .= '<div class="form-title">' . $form_title . '</div>';
            }
            $popup_html .= !empty($popup_text) ? '<div class="form-desc">' . $popup_text . '</div>' : "";
            $popup_html .= '</div>';
            if (!empty($settings['contact_form'])) {
                $popup_html .= do_shortcode('[contact-form-7 id="' . esc_attr($settings['contact_form']) . '"]');
            }
            $popup_html .= '</div>';
        }


?>
        <div class="header-widget">
            <div class="header-widget__container">
                <?php if ($enable_top_block === 'yes' && (!empty($logo_text) || !empty($email_adress))): ?>
                    <div class="header-widget__top">
                    
                                     <?php if (!empty($logo_text)): ?>
                                        <div class="header-widget__description">
                                            <p class="header-widget__text"><?= $logo_text ?></p>
                                        </div>
                                    <?php endif; ?>       

                                <?php if (!empty($email_adress)): ?>
                                        <a class="header-widget__email" href="mailto:<?= $email_adress ?>">
                                            <span class="header-widget__icon header-widget__icon--mail">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-mail">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                            </span>
                                            <span class="header-widget__email-address"><?= $email_adress ?></span>
                                        </a>
                                <?php endif; ?>
                  

                     
                    </div>

                    <hr class="header-widget__separator">
                <?php endif; ?>

                <?php if (!empty($logo) || !empty($logo_text) || !empty($social_icons_list) || !empty($menu) || !empty($button_text) || !empty($phone_number)): ?>
                
                        <div class="header-widget__nav">
                            <?php if (!empty($logo) || !empty($logo_text)): ?>

                                <div class="header-widget__logo-description">
                                    <?php if (!empty($logo)): ?>
                                        <div class="header-widget__logo">
                                            <?php
                                            $logo_url = $settings['logo']['url'];
                                            $attachment_id = attachment_url_to_postid($logo_url);
                                            $alt_text = '';
                                            $image_sizes = [];
                                            if ($attachment_id) {
                                                $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                                                foreach (['thumbnail', 'medium', 'large', 'full'] as $size) {
                                                    $image_src = wp_get_attachment_image_src($attachment_id, $size);
                                                    if ($image_src) {
                                                        $image_sizes[$size] = $image_src[0];
                                                    }
                                                }
                                            }

                                            $default_src = $image_sizes['full'] ?? $logo_url;
                                            ?>
                                            <a href="/" class="header-widget__logo-link">
                                                <img class="header-widget__logo-img" width="130" height="100" src="<?php echo esc_url($default_src); ?>"
                                                    alt="<?php echo esc_attr($alt_text ?: 'Логотип'); ?>" <?php foreach ($image_sizes as $size => $src): ?>
                                                    data-<?php echo esc_attr($size); ?>="<?php echo esc_url($src); ?>" <?php endforeach; ?>>
                                  
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                            <?php if (!empty($menu)): ?>
                                <nav class="header-widget__menu">
                                    <ul class="rest-list menu__list">
                                        <?php
                                        // Кешируем меню
                                        $cache_key = 'cw_menu_items_' . $menu;
                                        $menu_items = get_transient($cache_key);
                                        if ($menu_items === false) {
                                            $menu_items = wp_get_nav_menu_items($menu);
                                            if ($menu_items) {
                                                set_transient($cache_key, $menu_items, HOUR_IN_SECONDS);
                                            }
                                        }

                                        foreach ($menu_items as $item):
                                            $checkbox_value = get_post_meta($item->ID, '_checkbox_value', true);
                                            $class_detect = $checkbox_value == 1 ? "menu__item--mega" : 'menu__item--has-children';
                                            $sub_menu = array_filter($menu_items, function ($sub_item) use ($item) {
                                                return $sub_item->menu_item_parent == $item->ID;
                                            });

                                            if (empty($sub_menu) && $item->menu_item_parent == 0) : ?>
                                                <li class="menu__item">
                                                    <a href="<?php echo esc_url($item->url); ?>" class="menu__link"><?php echo esc_html($item->title); ?></a>
                                                </li>
                                                <?php else :
                                                if ($item->menu_item_parent == 0 && $sub_menu) : ?>
                                                    <li class="menu__item <?php echo ($item->menu_item_parent != 0) ? '' : $class_detect; ?>">
                                                        <a href="<?php echo esc_url($item->url); ?>" class="menu__link"><?php echo esc_html($item->title); ?></a>

                                                        <?php if ($checkbox_value && $sub_menu): ?>
                                                            <div class="mega-menu">
                                                                <?php foreach ($sub_menu as $submenus): ?>
                                                                    <?php
                                                                    $sub_menu_l2 = array_filter($menu_items, function ($sub_item) use ($submenus) {
                                                                        return $sub_item->menu_item_parent == $submenus->ID;
                                                                    });
                                                                    $has_image = get_post_meta($submenus->ID, '_image_id', true);
                                                                    ?>
                                                                    <div class="mega-menu__column">
                                                                        <?php if ($checkbox_value && $has_image): ?>
                                                                            <div class="mega-menu__wrap">
                                                                                <img class="mega-menu__img" src="<?php echo wp_get_attachment_url($has_image); ?>" alt="Image for <?php echo esc_attr($submenus->title); ?>" />
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <h4 class="mega-menu__title">
                                                                            <a href="<?php echo esc_url($submenus->url); ?>" class="mega-menu__link"><?php echo esc_html($submenus->title); ?></a>
                                                                        </h4>
                                                                        <?php if ($sub_menu_l2): ?>
                                                                            <ul class="rest-list mega-menu__list">
                                                                                <?php foreach ($sub_menu_l2 as $subs): ?>
                                                                                    <li class="mega-menu__items">
                                                                                        <a class="mega-menu__link" href="<?php echo esc_url($subs->url); ?>">
                                                                                            <?php echo esc_html($subs->title); ?>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php endforeach; ?>
                                                                            </ul>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <?php if ($sub_menu): ?>
                                                                <ul class="rest-list submenu">
                                                                    <?php foreach ($sub_menu as $subs): ?>
                                                                        <li class="submenu__item">
                                                                            <a class="submenu__link" href="<?php echo esc_url($subs->url); ?>">
                                                                                <?php echo esc_html($subs->title); ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </li>
                                        <?php endif;
                                            endif;
                                        endforeach;
                                        ?>

                                    </ul>

                                </nav>
                            <?php endif; ?>
													 <?php if (!empty($social_icons_list) || !empty($button_text) || !empty($phone_number)): ?>
                                <div class="header-widget__buttons">
														<?php if ($enable_polylang === 'yes' && function_exists('pll_the_languages')): ?>
                            <div class="header-widget__lang-switcher">
                                <?php if ($polylang_dropdown === 'yes'): ?>
                                    <div class="header-widget__lang-dropdown">
                                        <?php
                                        $current_lang = function_exists('pll_current_language') ? pll_current_language('name') : '';
                                        $current_flag = function_exists('pll_current_language') ? pll_current_language('flag') : '';
                                        ?>
                                        <button type="button" class="header-widget__lang-current">
                                            <?php if ($polylang_show_flags === 'yes' && $current_flag): ?>
                                                <span class="header-widget__lang-flag"><?php echo $current_flag; ?></span>
                                            <?php endif; ?>
                                            <?php if ($polylang_show_names === 'yes'): ?>
                                                <span class="header-widget__lang-name"><?php echo esc_html($current_lang); ?></span>
                                            <?php endif; ?>
                                            <span class="header-widget__lang-arrow">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </button>
                                        <ul class="header-widget__lang-list">
                                            <?php
                                            pll_the_languages([
                                                'show_flags' => ($polylang_show_flags === 'yes') ? 1 : 0,
                                                'show_names' => ($polylang_show_names === 'yes') ? 1 : 0,
                                                'hide_current' => ($polylang_hide_current === 'yes') ? 1 : 0,
                                                'display_names_as' => 'name',
                                            ]);
                                            ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <ul class="header-widget__lang-inline">
                                        <?php
                                        pll_the_languages([
                                            'show_flags' => ($polylang_show_flags === 'yes') ? 1 : 0,
                                            'show_names' => ($polylang_show_names === 'yes') ? 1 : 0,
                                            'hide_current' => ($polylang_hide_current === 'yes') ? 1 : 0,
                                            'display_names_as' => 'name',
                                        ]);
                                        ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                           

                                    <?php if (!empty($social_icons_list)): ?>
                                        <div class="header-widget__social">
                                            <ul class="header-widget__social-icons">
                                                <?php foreach ($social_icons_list as $index => $item): 
                                                    $social_link = !empty($item['social_link']['url']) ? $item['social_link']['url'] : '';
                                                    $is_external = !empty($item['social_link']['is_external']) ? ' target="_blank"' : '';
                                                    $nofollow = !empty($item['social_link']['nofollow']) ? ' rel="nofollow"' : '';
                                                    if (!empty($social_link)):
                                                ?>
                                                    <li class="header-widget__social-item elementor-repeater-item-<?= esc_attr($item['_id']) ?>">
                                                        <a href="<?= esc_url($social_link) ?>"<?= $is_external ?><?= $nofollow ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                              <?php if (!empty($phone_number)||!empty($phone_number_2)): ?>
                                    <div class="header-widget__phone-wrapper">
                                        <!-- Общая иконка для вертикального режима -->
                                        <div class="header-widget__phone-number-wrap header-widget__phone-number-icon--mobile">
                                            <span class="header-widget__phone-number-icon">
                                                <?php if ($use_custom_phone_icon === 'yes' && !empty($phone_icon['value'])): ?>
                                                    <?php \Elementor\Icons_Manager::render_icon($phone_icon, ['aria-hidden' => 'true']); ?>
                                                <?php else: ?>
                                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_1_54)">
                                                            <path d="M15.6359 11.1586C14.5951 11.1586 13.5732 10.9958 12.6047 10.6757C12.1302 10.5139 11.5469 10.6624 11.2572 10.9598L9.34575 12.4028C7.12898 11.2195 5.76349 9.85442 4.59633 7.65429L5.99684 5.79262C6.3607 5.42924 6.49121 4.89844 6.33485 4.40039C6.01344 3.42687 5.85017 2.40541 5.85017 1.36416C5.85021 0.611956 5.23826 0 4.4861 0H1.36412C0.611956 0 0 0.611956 0 1.36412C0 9.98586 7.01418 17 15.6359 17C16.3881 17 17 16.388 17 15.6359V12.5226C17 11.7705 16.388 11.1586 15.6359 11.1586Z"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_1_54">
                                                                <rect width="17" height="17" fill="white"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <?php if (!empty($phone_number)): ?>
                                            <a href="tel:<?= $sanitize_phone_number ?>" class="header-widget__phone-number">
                                                <div class="header-widget__phone-number-wrap">
                                                    <span class="header-widget__phone-number-icon">
                                                        <?php if ($use_custom_phone_icon === 'yes' && !empty($phone_icon['value'])): ?>
                                                            <?php \Elementor\Icons_Manager::render_icon($phone_icon, ['aria-hidden' => 'true']); ?>
                                                        <?php else: ?>
                                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_1_54)">
                                                                    <path d="M15.6359 11.1586C14.5951 11.1586 13.5732 10.9958 12.6047 10.6757C12.1302 10.5139 11.5469 10.6624 11.2572 10.9598L9.34575 12.4028C7.12898 11.2195 5.76349 9.85442 4.59633 7.65429L5.99684 5.79262C6.3607 5.42924 6.49121 4.89844 6.33485 4.40039C6.01344 3.42687 5.85017 2.40541 5.85017 1.36416C5.85021 0.611956 5.23826 0 4.4861 0H1.36412C0.611956 0 0 0.611956 0 1.36412C0 9.98586 7.01418 17 15.6359 17C16.3881 17 17 16.388 17 15.6359V12.5226C17 11.7705 16.388 11.1586 15.6359 11.1586Z"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_1_54">
                                                                        <rect width="17" height="17" fill="white"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                                <span class="header-widget__phone-number-text"><?= $phone_number ?></span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($phone_number_2)): ?>
                                            <a href="tel:<?= $sanitize_phone_number_2 ?>" class="header-widget__phone-number header-widget__phone-number--second">
                                                <div class="header-widget__phone-number-wrap">
                                                    <span class="header-widget__phone-number-icon">
                                                        <?php if ($use_custom_phone_icon === 'yes' && !empty($phone_icon['value'])): ?>
                                                            <?php \Elementor\Icons_Manager::render_icon($phone_icon, ['aria-hidden' => 'true']); ?>
                                                        <?php else: ?>
                                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_1_54)">
                                                                    <path d="M15.6359 11.1586C14.5951 11.1586 13.5732 10.9958 12.6047 10.6757C12.1302 10.5139 11.5469 10.6624 11.2572 10.9598L9.34575 12.4028C7.12898 11.2195 5.76349 9.85442 4.59633 7.65429L5.99684 5.79262C6.3607 5.42924 6.49121 4.89844 6.33485 4.40039C6.01344 3.42687 5.85017 2.40541 5.85017 1.36416C5.85021 0.611956 5.23826 0 4.4861 0H1.36412C0.611956 0 0 0.611956 0 1.36412C0 9.98586 7.01418 17 15.6359 17C16.3881 17 17 16.388 17 15.6359V12.5226C17 11.7705 16.388 11.1586 15.6359 11.1586Z"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_1_54">
                                                                        <rect width="17" height="17" fill="white"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                                <span class="header-widget__phone-number-text"><?= $phone_number_2 ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php
                                    if (!empty($button_text)) {
                                        $button_id_attr = !empty($button_id) ? 'id="' . esc_attr($button_id) . '"' : "";
                                        if ($button_type === 'link') {
                                            if (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) {
                                                echo '<a href="#' . esc_attr($popup_id) . '" ' . $button_id_attr . ' animation="ripple" class="header-widget__callback-button header-widget__button ' . esc_attr($button_class) . '" ' . $popup_data . '>' . esc_html($button_text) . '</a>';
                                            } else {
                                                $url = !empty($button_url) ? esc_url($button_url) : '#';
                                                echo '<a href="' . $url . '" ' . $button_id_attr . ' animation="ripple" class="header-widget__callback-button header-widget__button ' . esc_attr($button_class) . '">' . esc_html($button_text) . '</a>';
                                            }
                                        } elseif ($button_type === 'submit') {
                                            $data_src = (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) ? ' data-mfp-src="#' . esc_attr($popup_id) . '"' : '';
                                            echo '<button type="button" ' . $button_id_attr . ' class="header-widget__callback-button header-widget__button ' . esc_attr($button_class) . '"' . $data_src . '>' . esc_html($button_text) . '</button>';
                                        }
                                        if (!empty($popup_html)) {
                                            echo $popup_html;
                                        }
                                    }
                                    ?>

                                </div>
                            <?php endif; ?>
                            <div class="header-widget__burger">
						      <div class="header-widget__burger-wrap">
							    <span class="header-widget__burger-line">&nbsp;</span>
						      </div>
					        </div>
                        </div>
                  
                <?php endif; ?>
          

            <div class="header-widget-mob">

                <div class="header-widget-mob__wrap">
                    <div class="header-widget__burger active">
                    <div class="header-widget__burger-wrap">
                	<span class="header-widget__burger-line">&nbsp;</span>
                
                </div>
                			
                </div>

                    <?php if (!empty($phone_number) && $enable_phone_number_mob === "yes" || !empty($phone_number_2) && $enable_phone_number_2_mob === "yes"): ?>
                        <div class="header-widget__phone-number--mob-wrapper">
                            <?php if (!empty($phone_number) && $enable_phone_number_mob === "yes"): ?>
                                <a href="tel:<?= $sanitize_phone_number ?>" class="header-widget__phone-number header-widget__phone-number--mob">
                                    <div class="header-widget__phone-number-wrap">
                                        <span class="header-widget__phone-number-icon">
                                            <?php if ($use_custom_phone_icon === 'yes' && !empty($phone_icon['value'])): ?>
                                                <?php \Elementor\Icons_Manager::render_icon($phone_icon, ['aria-hidden' => 'true']); ?>
                                            <?php else: ?>
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g>
                                                        <path d="M15.6359 11.1586C14.5951 11.1586 13.5732 10.9958 12.6047 10.6757C12.1302 10.5139 11.5469 10.6624 11.2572 10.9598L9.34575 12.4028C7.12898 11.2195 5.76349 9.85442 4.59633 7.65429L5.99684 5.79262C6.3607 5.42924 6.49121 4.89844 6.33485 4.40039C6.01344 3.42687 5.85017 2.40541 5.85017 1.36416C5.85021 0.611956 5.23826 0 4.4861 0H1.36412C0.611956 0 0 0.611956 0 1.36412C0 9.98586 7.01418 17 15.6359 17C16.3881 17 17 16.388 17 15.6359V12.5226C17 11.7705 16.388 11.1586 15.6359 11.1586Z"></path>
                                                    </g>
                                                </svg>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <span class="header-widget__phone-number-text"><?= $phone_number ?></span>
                                </a>
                    <?php endif; ?>

                    <?php if (!empty($phone_number_2) && $enable_phone_number_2_mob === "yes"): ?>
                        <a href="tel:<?= $sanitize_phone_number_2 ?>" class="header-widget__phone-number header-widget__phone-number--mob header-widget__phone-number--mob-second">
                            <div class="header-widget__phone-number-wrap">
                                <span class="header-widget__phone-number-icon">
                                    <?php if ($use_custom_phone_icon === 'yes' && !empty($phone_icon['value'])): ?>
                                        <?php \Elementor\Icons_Manager::render_icon($phone_icon, ['aria-hidden' => 'true']); ?>
                                    <?php else: ?>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="M15.6359 11.1586C14.5951 11.1586 13.5732 10.9958 12.6047 10.6757C12.1302 10.5139 11.5469 10.6624 11.2572 10.9598L9.34575 12.4028C7.12898 11.2195 5.76349 9.85442 4.59633 7.65429L5.99684 5.79262C6.3607 5.42924 6.49121 4.89844 6.33485 4.40039C6.01344 3.42687 5.85017 2.40541 5.85017 1.36416C5.85021 0.611956 5.23826 0 4.4861 0H1.36412C0.611956 0 0 0.611956 0 1.36412C0 9.98586 7.01418 17 15.6359 17C16.3881 17 17 16.388 17 15.6359V12.5226C17 11.7705 16.388 11.1586 15.6359 11.1586Z"></path>
                                            </g>
                                        </svg>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <span class="header-widget__phone-number-text"><?= $phone_number_2 ?></span>
                        </a>
                    <?php endif; ?>
										</div>
                    <?php endif; ?>

                    <?PHP
                    if (!empty($button_text) && $enable_button_text_mob === "yes") {
                        $button_id_attr = !empty($button_id) ? 'id="' . esc_attr($button_id) . '"' : "";
                        if ($button_type === 'link') {
                            if (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) {
                                echo '<a href="#' . esc_attr($popup_id) . '" ' . $button_id_attr . ' class="header-widget__callback-button header-widget__button header-widget__callback-button--mob ' . esc_attr($button_class) . '" ' . $popup_data . '>' . esc_html($button_text) . '</a>';
                            } else {
                                $url = !empty($button_url) ? esc_url($button_url) : '#';
                                echo '<a href="' . $url . '" ' . $button_id_attr . ' class="header-widget__callback-button header-widget__button header-widget__callback-button--mob ' . esc_attr($button_class) . '">' . esc_html($button_text) . '</a>';
                            }
                        } elseif ($button_type === 'submit') {
                            $data_src = (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) ? ' data-mfp-src="#' . esc_attr($popup_id) . '"' : '';
                            echo '<button type="button" ' . $button_id_attr . ' class="header-widget__callback-button header-widget__button  header-widget__callback-button--mob ' . esc_attr($button_class) . '"' . $data_src . '>' . esc_html($button_text) . '</button>';
                        }
                    }
                    ?>
                    <?php if (!empty($adress) &&  $enable_adress_mob === "yes" || !empty($time_work) && $enable_time_work_mob === "yes"): ?>
                        <div class="header-widget__location header-widget__location--mob">
                            <?php if (!empty($adress) && $enable_adress_mob === "yes"): ?>
                                <span class="header-widget__icon-addres-ofese">
                                    <span class="header-widget__icon header-widget__icon--map-pin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-map-pin">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                    </span>
                                    &nbsp;<?= $adress ?>&nbsp;&nbsp;&nbsp; </span>
                            <?php endif; ?>
                            <?php if (!empty($time_work) && $enable_time_work_mob === "yes"): ?>
                                <span class=" header-widget__icon-clock-work">
                                    <span class="header-widget__icon header-widget__icon--clock">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-clock">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                    </span>
                                    &nbsp;<?= $time_work ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($email_adress) && $enable_email_adress_mob === "yes"): ?>
                        <a class="header-widget__email header-widget__email--mob" href="mailto:<?= $email_adress ?>">
                            <span class="header-widget__icon header-widget__icon--mail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-mail">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <span class="header-widget__email-address"><?= $email_adress ?></span>
                        </a>
                    <?php endif; ?>


                    <hr class="header-widget__line--mob">

                    <?php
                    if (!empty($menu)) {
                        // Используем тот же кеш что и для десктоп меню
                        $cache_key = 'cw_menu_items_' . $menu;
                        $menu_items = get_transient($cache_key);
                        if ($menu_items === false) {
                            $menu_items = wp_get_nav_menu_items($menu);
                            if ($menu_items) {
                                set_transient($cache_key, $menu_items, HOUR_IN_SECONDS);
                            }
                        }
                        if (!empty($menu_items)) {
                            $menu_tree = $this->build_menu_tree($menu_items);
                            echo '<nav class="header-widget__menu--mob">';
                            echo '<ul class="rest-list menu__list--mob">';
                            $this->render_menu_tree($menu_tree);
                            echo '</ul>';
                            echo '</nav>';
                        }
                    }
                    ?>
                    <?php if (!empty($social_icons_list) && $enable_icon_mob === "yes"): ?>
                        <div class="header-widget__social header-widget__social--mob">
                            <ul class="header-widget__social-icons">
                                <?php foreach ($social_icons_list as $index => $item): 
                                    $social_link = !empty($item['social_link']['url']) ? $item['social_link']['url'] : '';
                                    $is_external = !empty($item['social_link']['is_external']) ? ' target="_blank"' : '';
                                    $nofollow = !empty($item['social_link']['nofollow']) ? ' rel="nofollow"' : '';
                                    if (!empty($social_link)):
                                ?>
                                    <li class="header-widget__social-item elementor-repeater-item-<?= esc_attr($item['_id']) ?>">
                                        <a href="<?= esc_url($social_link) ?>"<?= $is_external ?><?= $nofollow ?>>
                                            <?php \Elementor\Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>
                                        </a>
                                    </li>
                                <?php endif; endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>



                </div>
            </div>
            <?php
        }

        /**
         * Функция для построения дерева меню.
         */
        private function build_menu_tree($menu_items, $parent_id = 0)
        {
            $tree = [];
            foreach ($menu_items as $item) {
                if ((int)$item->menu_item_parent === $parent_id) {
                    $children = $this->build_menu_tree($menu_items, $item->ID);
                    if ($children) {
                        $item->children = $children;
                    }
                    $tree[] = $item;
                }
            }
            return $tree;
        }

        /**
         * Функция для вывода дерева меню.
         */
        private function render_menu_tree($menu_tree)
        {
            foreach ($menu_tree as $item) {
                $has_children = !empty($item->children);
            ?>
                <li class="menu__item--mob<?php echo $has_children ? ' menu__item--mob-has-children' : ''; ?>">
                    <div class="menu__item--mob-wrap">
                        <a href="<?php echo esc_url($item->url); ?>" class="menu__link--mob">
                            <?php echo esc_html($item->title); ?>
                        </a>
                        <?php if ($has_children): ?>
                            <span>&nbsp;</span>
                        <?php endif; ?>
                    </div>
                    <?php if ($has_children): ?>
                        <ul class="rest-list submenu--mob">
                            <?php $this->render_menu_tree($item->children); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php
            }
        }
    }
?>

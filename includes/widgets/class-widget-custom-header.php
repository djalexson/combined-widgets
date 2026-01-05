<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Custom_Header extends Widget_Base {
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
                'label' => __('Описание Логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Аренда илососа с размывкой по выгодной цене в Москве', 'combined-widgets'),
                'placeholder' => __('Введите текст', 'combined-widgets'),
            ]
        );

        $this->add_control(
            'adress',
            [
                'label' => __('Адрес', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('г. Москва, улица Марксистская улица, 20 стр.8', 'combined-widgets'),
            ]
        );

        $this->add_control(
            'enable_adress-mob',
            [
                'label' => __('Показывать адрес в бургере??', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить и отключить адрес в бургере', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'time_work',
            [
                'label' => __('Режим работы', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Режим работы: Пн-Пт 9:00-18:00', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'enable_time_work-mob',
            [
                'label' => __('Показывать режим работы в бургере?', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'combined-widgets'),
                'label_off' => __('No', 'combined-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Включить и отключить режим работы в бургере', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'emergency_call',
            [
                'label' => __('аварийный вызов', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('https://link', 'combined-widgets'),
            ]
        );
        $this->add_control(
            'emergency_button_text',
            [
                'label' => __('Текст кнопки срочного вызова', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Срочный вызов ГБР', 'combined-widgets'),
                'description' => __('Измените подпись ссылки в верхней плашке (справа от иконки телефона)', 'combined-widgets'),
            ]
        );
            $this->add_control(
                'enable_emergency_button',
                [
                    'label' => __('Показывать кнопку аварийного вызова?', 'combined-widgets'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'combined-widgets'),
                    'label_off' => __('No', 'combined-widgets'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'description' => __('Включить/выключить отображение кнопки срочного вызова в верхней панели', 'combined-widgets'),
                ]
            );
        // $this->add_control(
        //     'phone_number_1',
        //     [
        //         'label' => __('Ссылка на WhatsApp', 'combined-widgets'),
        //         'type' => \Elementor\Controls_Manager::TEXT,
        //         'default' => __('', 'combined-widgets'),
        //     ]
        // );
        $this->add_control(
            'telegram_link',
            [
                'label' => __('Ссылка на Telegram', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('https://t.me/serega194', 'combined-widgets'),
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

        $this->add_control(
            'tg_link',
            [
                'label' => __('Ссылка на TG', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://t.me/yourpage', 'combined-widgets'),
                'default' => [
                    'url' => 'https://t.me/serega194',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'av_link',
            [
                'label' => __('Ссылка на Avito', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://www.avito.ru/', 'combined-widgets'),
                'default' => [
                    'url' => 'https://www.avito.ru/',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'vk_link',
            [
                'label' => __('Ссылка на VK', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://vk.com/yourpage', 'combined-widgets'),
                'default' => [
                    'url' => 'https://vk.com/id701241652',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'whatsapp_link',
            [
                'label' => __('Ссылка на WhatsApp', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://wa.me/1234567890', 'combined-widgets'),
                'default' => [
                    'url' => 'whatsapp://send/?phone=79777134879',
                    'is_external' => true,
                    'nofollow' => true,
                ],
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
                'label' => __('Ширина блока логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','rem','%'],
                'range' => [
                    'px' => ['min' => 40, 'max' => 600],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo-link' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_img_height',
            [
                'label' => __('Макс. высота логотипа', 'combined-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','rem'],
                'range' => [
                    'px' => ['min' => 20, 'max' => 200],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-widget__logo-img' => 'max-height: {{SIZE}}{{UNIT}};',
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
        $menus = wp_get_nav_menus();
        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }
    private function get_contact_forms()
    {
        $forms = [];
        if (class_exists('WPCF7')) {
            $contact_forms = get_posts(['post_type' => 'wpcf7_contact_form', 'numberposts' => -1]);
            foreach ($contact_forms as $form) {
                $forms[$form->ID] = $form->post_title;
            }
        }
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
        $adress = $settings['adress'];
        $enable_adress_mob = $settings['enable_adress-mob'];
        $time_work = $settings['time_work'];
        $enable_time_work_mob = $settings['enable_time_work-mob'];
        // Безопасные значения для переменных, которые могли отсутствовать
        $phone_number_1 = isset($settings['phone_number_1']) ? $settings['phone_number_1'] : '';
        $emergency_call = isset($settings['emergency_call']) ? $settings['emergency_call'] : '';
        $telegram_link = $settings['telegram_link'];
        $phone_number = $settings['phone_number'];
        $sanitize_phone_number = !empty($phone_number) ?  $this->sanitize_phone_number($phone_number) : 0;
        $phone_number_2 = !empty($settings['phone_number_2']) ? $settings['phone_number_2'] : '';
        $sanitize_phone_number_2 = !empty($phone_number_2) ?  $this->sanitize_phone_number($phone_number_2) : 0;
        // $sanitize_phone_number_1= !empty($phone_number_1)?  $this->sanitize_phone_number($phone_number_1):0;
        // $sanitize_emergency_call = !empty($emergency_call) ?  $this->sanitize_phone_number($emergency_call) : 0;
        $sanitize_telegram_link = !empty($telegram_link) ?  $this->sanitize_phone_number($telegram_link) : 0;
        $email_adress = $settings['email_adress'];
        $enable_email_adress_mob = $settings['enable_email_adress-mob'];
        $enable_phone_number_mob = $settings['enable_phone_number-mob'];
        $enable_phone_number_2_mob = isset($settings['enable_phone_number_2-mob']) ? $settings['enable_phone_number_2-mob'] : '';
        $emergency_button_text = isset($settings['emergency_button_text']) && $settings['emergency_button_text'] !== ''
            ? $settings['emergency_button_text']
            : __('Срочный вызов ГБР', 'combined-widgets');
        $enable_emergency_button = isset($settings['enable_emergency_button']) ? $settings['enable_emergency_button'] : 'yes';
        $av_link = $settings['av_link']['url'];
        $vk_link = $settings['vk_link']['url'];
        $tg_link = $settings['tg_link']['url'];
        $whatsapp_link = $settings['whatsapp_link']['url'];
        $enable_icon_mob = $settings['enable_icon-mob'];
        $button_text = $settings['button_text'];
        $popup_text = $settings['popup_text'];
        $enable_button_text_mob = $settings['enable_button_text-mob'];
        $button_type = $settings['button_type'];
        $button_url = !empty($settings['button_url']['url']) ? $settings['button_url']['url'] : '#';
        $button_id = !empty($settings['button_id']) ? $settings['button_id'] : '';
        $button_class = !empty($settings['button_class']) ? $settings['button_class'] : '';
        $popup_id = 'opal-contactform-popup-' . $this->get_id();
        $popup_ilnk = '';
        $popup_html = '';
        $popup_data = '';
       
				if ($settings['enable_popup'] === 'yes') {
            $popup_ilnk = $popup_id;
            $popup_data = 'data-effect="mfp-zoom-in"';
            $popup_html = '<div class="mfp-hide contactform-content my-popup" id="' . esc_attr($popup_id) . '">';
            $popup_html .= '<div class="heading-form">';
            if (!empty($settings['contact_form'])) {
                $form_id = intval($settings['contact_form']);
                $form_post = get_post($form_id);
                if ($form_post) {
                    $form_title = esc_html($form_post->post_title);
                    $popup_html .= '<div class="form-title">' . $form_title . '</div>';
                } else {
                    $popup_html .= '<div class="form-title">' . __('Untitled Form', 'combined-widgets') . '</div>'; // Заглушка для отсутствующего поста
                }
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
                <?php if (!empty($adress) || !empty($time_work) || !empty($emergency_call) || !empty($phone_number_1) || !empty($telegram_link) || !empty($email_adress)): ?>
                    <div class="header-widget__top">
                        <?php if (!empty($adress) || !empty($time_work)): ?>
                            <div class="header-widget__location">
                                <?php if (!empty($adress)): ?>
                                    <span class="header-widget__icon-addres-ofese">
                                        <span class="header-widget__icon header-widget__icon--map-pin">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                        </span>
                                        &nbsp;<?= $adress ?>&nbsp;&nbsp;&nbsp; </span>
                                <?php endif; ?>
                                <?php if (!empty($time_work)): ?>
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
                        <?php if (!empty($emergency_call) || !empty($phone_number_1) || !empty($telegram_link) || !empty($email_adress)): ?>
                            <?php if ($enable_emergency_button === 'yes'): ?>
                                <div class="header-widget__contacts">
                                    <?php
                                    $emergency_href = (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id))
                                        ? '#' . esc_attr($popup_id)
                                        : (!empty($emergency_call) ? esc_url($emergency_call) : '#');
                                    ?>
                                    <a class="header-widget__emergency header-widget__callback-button" href="<?= $emergency_href ?>" <?= $popup_data ?>>
                                        <span class="header-widget__icon header-widget__icon--phone">
                                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 510 510" width="50" height="50" version="1.1"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><path d="m90.518 307.19c.682-.631.998-1.564.841-2.48-.157-.915-.766-1.69-1.619-2.058l-64.834-28 57.441-29.514c2.201-1.131 3.709-3.268 4.036-5.721.328-2.453-.566-4.911-2.394-6.58л-29.383-26.836 41.169-17.679c.825-.354 1.425-1.089 1.607-1.968.182-.878-.077-1.791-.693-2.443л-53.464-56.627 75.074 11.464c2.291.35 4.615-.371 6.306-1.954 1.691-1.584 2.562-3.856 2.364-6.165л-3.213-37.273c-.136-1.583.649-3.103 2.019-3.908s3.08-.751 4.396.139л37.944 25.642c.759.514 1.724.614 2.573.269.85-.345 1.47-1.091 1.656-1.989л19.464-94.126c.422-2.039 1.959-3.664 3.971-4.199 2.012-.534 4.154.114 5.531 1.675л58.929 66.759c2.553 2.893 6.877 3.397 10.028 1.169л34.282-24.242c1.805-1.276 4.078-1.698 6.221-1.154 2.143.543 3.94 1.998 4.918 3.98л20.961 42.467 85.824-47.92c2.197-1.227 4.917-1 6.88.573 1.963 1.572 2.778 4.178 2.06 6.588л-24.963 83.884c-.749 2.517-.138 5.242 1.614 7.197 1.752 1.956 4.394 2.862 6.977 2.394л47.435-8.604c1.437-.26 2.882.417 3.602 1.688s.556 2.859-.407 3.957л-39.403 44.915 58.826 51.918-67.383 24.167 55.037 44.043-51.525 8.031c-2.795.436-5.112 2.395-6.006 5.079-.894 2.683-.214 5.641 1.761 7.665л41.942 42.981c1.452 1.487 1.784 3.739.822 5.582-.961 1.843-2.997 2.859-5.047 2.521л-67.298-11.121 26.435 102.011c.47 1.814-.156 3.736-1.605 4.924-1.448 1.189-3.455 1.428-5.142.612л-79.45-38.396c-5.752-2.78-12.648-1.445-16.948 3.281л-36.044 39.619c-.988 1.087-2.419 1.662-3.885 1.562-1.465-.101-2.805-.865-3.636-2.076л-33.533-48.851c-1.295-1.886-3.374-3.084-5.655-3.258-2.281-.175-4.518.694-6.084 2.362л-39.243 41.798c-1.399 1.49-3.588 1.933-5.456 1.104s-3.009-2.748-2.843-4.785л2.843-34.946c.401-4.932-1.754-9.726-5.709-12.7s-9.158-3.713-13.785-1.959л-87.261 33.09c-3.068 1.163-6.537.213-8.585-2.352-2.047-2.565-2.205-6.158-.39-8.893л50.789-76.525c1.377-2.076 1.643-4.697.71-7.008-.932-2.31-2.944-4.012-5.377-4.549л-64.529-14.246zm176.48-169.634h-23.996c-4.838 0-9.459 2.007-12.762 5.543-3.302 3.536-4.989 8.284-4.658 13.111л11.67 170.369c.628 9.159 8.24 16.268 17.421 16.268h.654c9.181 0 16.793-7.109 17.421-16.268л11.67-170.369c.331-4.827-1.356-9.575-4.658-13.111-3.303-3.536-7.924-5.543-12.762-5.543zm-10.893 219.694c-12.471 0-22.597 10.126-22.597 22.597 0 12.472 10.126 22.597 22.597 22.597 12.472 0 22.597-10.125 22.597-22.597 0-12.471-10.125-22.597-22.597-22.597z" fill="#ffffff" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></svg>
                                        </span>
                                        <span class="header-widget__contacts-link"><?= esc_html($emergency_button_text) ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (!empty($whatsapp_link) || !empty($telegram_link) || !empty($email_adress)): ?>
                            <div class="header-widget__contacts">
                                <?php if (!empty($whatsapp_link)): ?>
                                    <a class="header-widget__phone" href="<?=$whatsapp_link?>">
                                            <span class="header-widget__icon header-widget__icon--phone">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.50002 12C3.50002 7.30558 7.3056 3.5 12 3.5C16.6944 3.5 20.5 7.30558 20.5 12C20.5 16.6944 16.6944 20.5 12 20.5C10.3278 20.5 8.77127 20.0182 7.45798 19.1861C7.21357 19.0313 6.91408 18.9899 6.63684 19.0726L3.75769 19.9319L4.84173 17.3953C4.96986 17.0955 4.94379 16.7521 4.77187 16.4751C3.9657 15.176 3.50002 13.6439 3.50002 12ZM12 1.5C6.20103 1.5 1.50002 6.20101 1.50002 12C1.50002 13.8381 1.97316 15.5683 2.80465 17.0727L1.08047 21.107C0.928048 21.4637 0.99561 21.8763 1.25382 22.1657C1.51203 22.4552 1.91432 22.5692 2.28599 22.4582L6.78541 21.1155C8.32245 21.9965 10.1037 22.5 12 22.5C17.799 22.5 22.5 17.799 22.5 12C22.5 6.20101 17.799 1.5 12 1.5ZM14.2925 14.1824L12.9783 15.1081C12.3628 14.7575 11.6823 14.2681 10.9997 13.5855C10.2901 12.8759 9.76402 12.1433 9.37612 11.4713L10.2113 10.7624C10.5697 10.4582 10.6678 9.94533 10.447 9.53028L9.38284 7.53028C9.23954 7.26097 8.98116 7.0718 8.68115 7.01654C8.38113 6.96129 8.07231 7.046 7.84247 7.24659L7.52696 7.52195C6.76823 8.18414 6.3195 9.2723 6.69141 10.3741C7.07698 11.5163 7.89983 13.314 9.58552 14.9997C11.3991 16.8133 13.2413 17.5275 14.3186 17.8049C15.1866 18.0283 16.008 17.7288 16.5868 17.2572L17.1783 16.7752C17.4313 16.5691 17.5678 16.2524 17.544 15.9269C17.5201 15.6014 17.3389 15.308 17.0585 15.1409L15.3802 14.1409C15.0412 13.939 14.6152 13.9552 14.2925 14.1824Z" fill="#fff" />
                                                </svg>
                                            </span>
                                            <span class="header-widget__contacts-link">WhatsApp</span>
                                        </a>
                                <?php endif; ?>
                                <?php if (!empty($telegram_link)): ?>
                                        <a class="header-widget__phone" href="<?= $telegram_link ?>">
                                            <span class="header-widget__icon header-widget__icon--phone">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.1117 4.49449C23.4296 2.94472 21.9074 1.65683 20.4317 2.227L2.3425 9.21601C0.694517 9.85273 0.621087 12.1572 2.22518 12.8975L6.1645 14.7157L8.03849 21.2746C8.13583 21.6153 8.40618 21.8791 8.74917 21.968C9.09216 22.0568 9.45658 21.9576 9.70712 21.707L12.5938 18.8203L16.6375 21.8531C17.8113 22.7334 19.5019 22.0922 19.7967 20.6549L23.1117 4.49449ZM3.0633 11.0816L21.1525 4.0926L17.8375 20.2531L13.1 16.6999C12.7019 16.4013 12.1448 16.4409 11.7929 16.7928L10.5565 18.0292L10.928 15.9861L18.2071 8.70703C18.5614 8.35278 18.5988 7.79106 18.2947 7.39293C17.9906 6.99479 17.4389 6.88312 17.0039 7.13168L6.95124 12.876L3.0633 11.0816ZM8.17695 14.4791L8.78333 16.6015L9.01614 15.321C9.05253 15.1209 9.14908 14.9366 9.29291 14.7928L11.5128 12.573L8.17695 14.4791Z" fill="#FFF" />
                                                </svg>
                                            </span>
                                            <span class="header-widget__contacts-link">Telegram</span>
                                        </a>
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
                        <?php endif; ?>
                    </div>

                    <hr class="header-widget__separator">
                <?php endif; ?>

                <?php if (!empty($logo) || !empty($logo_text) || !empty($av_link) || !empty($tg_link) || !empty($whatsapp_link) || !empty($vk_link) || !empty($menu) || !empty($button_text) || !empty($phone_number)): ?>
                
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
                                                <img class="header-widget__logo-img" width="50px" height="50px" src="<?php echo esc_url($default_src); ?>"
                                                    alt="<?php echo esc_attr($alt_text ?: 'Логотип'); ?>" <?php foreach ($image_sizes as $size => $src): ?>
                                                    data-<?php echo esc_attr($size); ?>="<?php echo esc_url($src); ?>" <?php endforeach; ?>>
                                  
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($logo_text)): ?>
                                        <div class="header-widget__description">
                                            <p class="header-widget__text"><?= $logo_text ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($menu)): ?>
                                <nav class="header-widget__menu">
                                    <ul class="rest-list menu__list">
                                        <?php
                                        $menu_items = wp_get_nav_menu_items($menu);

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
                            <?php if (!empty($tg_link) || !empty($whatsapp_link) || !empty($vk_link) || !empty($button_text) || !empty($phone_number)): ?>
                                <div class="header-widget__buttons">

                                    <?php if (!empty($av_link) || !empty($tg_link) || !empty($whatsapp_link) || !empty($vk_link)): ?>
                                        <div class="header-widget__social">
                                            <ul class="header-widget__social-icons">

                                                <?php if (!empty($tg_link)): ?>
                                                    <li class="header-widget__social-item header-widget__social-item--tg">
                                                        <a href="<?= $tg_link ?>" target="_blank">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" version="1.1" id="Layer_1" viewBox="0 0 24 24" xml:space="preserve">
                                                                <style type="text/css">
                                                                	.st0{fill:none;}
                                                                </style>
                                                                <path d="M19.2,4.4L2.9,10.7c-1.1,0.4-1.1,1.1-0.2,1.3l4.1,1.3l1.6,4.8c0.2,0.5,0.1,0.7,0.6,0.7c0.4,0,0.6-0.2,0.8-0.4  c0.1-0.1,1-1,2-2l4.2,3.1c0.8,0.4,1.3,0.2,1.5-0.7l2.8-13.1C20.6,4.6,19.9,4,19.2,4.4z M17.1,7.4l-7.8,7.1L9,17.8L7.4,13l9.2-5.8  C17,6.9,17.4,7.1,17.1,7.4z"/>
                                                                <rect y="0" class="st0" width="24" height="24"/>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (!empty($av_link)): ?>
                                                    <li class="header-widget__social-item header-widget__social-item--tg">
                                                        <a href="<?= $av_link ?>" target="_blank">
                                                            <svg width="24" height="24" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.357 4.092a3.108 3.108 0 11-6.216 0 3.108 3.108 0 016.216 0zm4.001 2.435a2.434 2.434 0 100-4.869 2.434 2.434 0 000 4.869zm3.783 4.675a3.782 3.782 0 11-7.565 0 3.782 3.782 0 017.565 0zm-9.132 0a1.76 1.76 0 11-3.52 0 1.76 1.76 0 013.52 0z" fill="#fff"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (!empty($whatsapp_link)): ?>
                                                    <li class="header-widget__social-item header-widget__social-item--ws">
                                                        <a href="<?= $whatsapp_link ?>" target="_blank">
                                                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_63_1171)">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.464 3.50708C15.6222 1.66306 13.1727 0.647078 10.5631 0.645996C5.18579 0.645996 0.809458 5.02221 0.807295 10.4009C0.806574 12.1204 1.25574 13.7988 2.1095 15.2782L0.725464 20.3335L5.89716 18.9769C7.32217 19.7542 8.92647 20.1638 10.5591 20.1643H10.5632C15.9399 20.1643 20.3167 15.7877 20.3188 10.4088C20.3198 7.80194 19.306 5.35098 17.464 3.50708ZM10.5631 18.5168H10.5597C9.10479 18.5162 7.67785 18.1251 6.43272 17.3865L6.13676 17.2107L3.0678 18.0158L3.88695 15.0236L3.69409 14.7168C2.88239 13.4258 2.45377 11.9336 2.45449 10.4015C2.45617 5.93088 6.09374 2.29367 10.5663 2.29367C12.7321 2.29439 14.7681 3.1389 16.2989 4.67158C17.8298 6.20425 18.6724 8.2415 18.6717 10.4082C18.6698 14.8792 15.0324 18.5168 10.5631 18.5168ZM15.0108 12.4438C14.7671 12.3218 13.5686 11.7322 13.3451 11.6508C13.1218 11.5694 12.9591 11.5289 12.7968 11.7728C12.6342 12.0168 12.1671 12.5659 12.0249 12.7285C11.8826 12.8912 11.7406 12.9116 11.4968 12.7895C11.2529 12.6676 10.4676 12.4101 9.53641 11.5796C8.81183 10.9333 8.32265 10.135 8.18037 9.89109C8.03834 9.64692 8.17917 9.52772 8.28732 9.39362C8.5512 9.06594 8.81544 8.72239 8.89667 8.55981C8.97802 8.39711 8.93728 8.25471 8.87624 8.13275C8.81544 8.01078 8.32793 6.81096 8.12486 6.32273C7.92683 5.84761 7.72604 5.91178 7.57631 5.90433C7.43428 5.89724 7.2717 5.8958 7.10912 5.8958C6.94666 5.8958 6.68254 5.95672 6.45904 6.20089C6.23566 6.44494 5.606 7.03458 5.606 8.23441C5.606 9.43423 6.47947 10.5933 6.60131 10.756C6.72316 10.9187 8.32024 13.3809 10.7654 14.4366C11.347 14.688 11.801 14.8378 12.1551 14.9502C12.7391 15.1357 13.2704 15.1095 13.6904 15.0468C14.1588 14.9768 15.1325 14.457 15.3358 13.8877C15.5389 13.3183 15.5389 12.8303 15.4779 12.7285C15.4171 12.6268 15.2545 12.5659 15.0108 12.4438Z" fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_63_1171">
                                                                        <rect width="21" height="21" fill="white"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (!empty($vk_link)): ?>
                                                    <li class="header-widget__social-item header-widget__social-item--vk">
                                                        <a href="<?= $vk_link ?>" target="_blank">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_37_153)">
                                                                    <path d="M19.894 14.5997C19.8698 14.5475 19.8472 14.5042 19.8262 14.4696C19.4792 13.8446 18.8161 13.0775 17.8373 12.1681L17.8166 12.1472L17.8063 12.137L17.7958 12.1266H17.7853C17.341 11.7031 17.0597 11.4183 16.9419 11.2726C16.7264 10.9949 16.6781 10.7138 16.7959 10.429C16.8791 10.2138 17.1918 9.75932 17.7331 9.06499C18.0178 8.69702 18.2433 8.4021 18.4099 8.17991C19.611 6.58314 20.1317 5.56279 19.9719 5.11844L19.9099 5.01461C19.8682 4.95209 19.7606 4.8949 19.5872 4.84275C19.4135 4.7907 19.1914 4.78209 18.9206 4.81678L15.9217 4.8375C15.8731 4.82028 15.8037 4.82189 15.7134 4.84275C15.6231 4.86361 15.5779 4.87408 15.5779 4.87408L15.5257 4.90016L15.4843 4.93149C15.4496 4.9522 15.4114 4.98864 15.3697 5.04072C15.3282 5.09262 15.2936 5.15353 15.2658 5.22294C14.9393 6.06294 14.5681 6.84392 14.1515 7.56586C13.8946 7.99634 13.6587 8.36942 13.4433 8.68531C13.2281 9.00109 13.0476 9.23375 12.9019 9.38288C12.756 9.53217 12.6244 9.65176 12.5061 9.7421C12.3881 9.83248 12.298 9.87067 12.2355 9.8567C12.173 9.84273 12.1141 9.82887 12.0583 9.81501C11.9612 9.7525 11.8831 9.66748 11.8242 9.55989C11.765 9.45229 11.7252 9.31687 11.7044 9.15373C11.6836 8.99048 11.6714 8.85006 11.6679 8.732C11.6646 8.61408 11.6661 8.44729 11.6732 8.2321C11.6804 8.01681 11.6836 7.87113 11.6836 7.79476C11.6836 7.53092 11.6888 7.24457 11.6991 6.93565C11.7096 6.62673 11.7181 6.38196 11.7252 6.20164C11.7323 6.02114 11.7356 5.83017 11.7356 5.62884C11.7356 5.42751 11.7233 5.26962 11.6991 5.15503C11.6752 5.04057 11.6385 4.92948 11.5901 4.82178C11.5414 4.71418 11.4701 4.63095 11.3766 4.57187C11.2829 4.51285 11.1664 4.46602 11.0278 4.43123C10.6598 4.34796 10.1912 4.30292 9.62185 4.29592C8.33069 4.28206 7.50105 4.36543 7.13311 4.54593C6.98733 4.6222 6.85541 4.7264 6.73746 4.85821C6.61247 5.011 6.59504 5.09437 6.68527 5.10809C7.10186 5.17049 7.39677 5.31977 7.57035 5.55579L7.6329 5.68085C7.68155 5.77108 7.73013 5.93083 7.77875 6.15988C7.8273 6.38893 7.85863 6.6423 7.87241 6.91986C7.90706 7.42672 7.90706 7.86059 7.87241 8.22153C7.83765 8.5826 7.80483 8.8637 7.7735 9.06503C7.74217 9.26635 7.69534 9.4295 7.6329 9.55441C7.57035 9.67937 7.52873 9.75574 7.50787 9.78346C7.48704 9.81118 7.46968 9.82865 7.4559 9.83551C7.36566 9.87008 7.27182 9.8877 7.17469 9.8877C7.07742 9.8877 6.95947 9.83905 6.82065 9.74181C6.68188 9.64457 6.53785 9.51101 6.38856 9.3409C6.23928 9.17076 6.07093 8.933 5.88342 8.62757C5.69606 8.32215 5.50166 7.96119 5.30033 7.54467L5.13376 7.2426C5.02963 7.04828 4.88739 6.76532 4.70689 6.394C4.52628 6.02252 4.36664 5.6632 4.22786 5.31609C4.17238 5.17031 4.08904 5.05932 3.97799 4.98295L3.92587 4.95162C3.89122 4.9239 3.8356 4.89447 3.7593 4.8631C3.68289 4.83177 3.60316 4.8093 3.51978 4.79548L0.666572 4.8162C0.375011 4.8162 0.177184 4.88225 0.073018 5.01417L0.0313299 5.07657C0.0105041 5.11133 0 5.16684 0 5.24325C0 5.31963 0.0208258 5.41336 0.0625139 5.52435C0.47903 6.50327 0.931983 7.44736 1.42137 8.35677C1.91076 9.26617 2.33603 9.99872 2.69692 10.5538C3.05789 11.1092 3.42583 11.6334 3.80073 12.1262C4.17563 12.6191 4.42379 12.935 4.54521 13.0738C4.66677 13.2128 4.76225 13.3167 4.83166 13.3861L5.09204 13.636C5.25865 13.8027 5.5033 14.0022 5.82612 14.2348C6.14901 14.4674 6.50648 14.6965 6.89871 14.9223C7.291 15.1477 7.74739 15.3317 8.2681 15.4739C8.78875 15.6164 9.2955 15.6735 9.78842 15.6459H10.986C11.2288 15.625 11.4128 15.5486 11.5379 15.4168L11.5793 15.3646C11.6072 15.3232 11.6333 15.2588 11.6573 15.1722C11.6817 15.0854 11.6938 14.9898 11.6938 14.8858C11.6867 14.5874 11.7094 14.3184 11.7614 14.0789C11.8133 13.8395 11.8724 13.659 11.9386 13.5374C12.0047 13.416 12.0793 13.3135 12.1624 13.2304C12.2456 13.1471 12.3049 13.0967 12.3397 13.0793C12.3743 13.0619 12.4019 13.05 12.4227 13.0429C12.5893 12.9874 12.7854 13.0412 13.0112 13.2044C13.2369 13.3676 13.4486 13.569 13.6465 13.8084C13.8444 14.048 14.0821 14.3169 14.3597 14.6153C14.6376 14.9139 14.8805 15.1358 15.0886 15.2818L15.2968 15.4068C15.4359 15.4902 15.6164 15.5665 15.8386 15.636C16.0604 15.7053 16.2547 15.7227 16.4215 15.688L19.0872 15.6464C19.3509 15.6464 19.556 15.6028 19.7015 15.5161C19.8474 15.4294 19.934 15.3338 19.9619 15.2298C19.9898 15.1257 19.9913 15.0076 19.9672 14.8756C19.9425 14.7439 19.9182 14.6518 19.894 14.5997Z" fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_37_153">
                                                                        <rect width="20" height="20" fill="white"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                              <?php if (!empty($phone_number)||!empty($phone_number_2)): ?>
                                    <div class="header-widget__phone-wrapper">
                                        <!-- Общая иконка для вертикального режима -->
																				   <div class="header-widget__phone-number-wrap header-widget__phone-number-icon--mobile">
                                        <span class="header-widget__phone-number-icon ">
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
                                        </span>
                                        </div>
                                        <?php if (!empty($phone_number)): ?>
                                            <a href="tel:<?= $sanitize_phone_number ?>" class="header-widget__phone-number">
                                                <div class="header-widget__phone-number-wrap">
                                                    <span class="header-widget__phone-number-icon">
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
                                                    </span>
                                                </div>
                                                <span class="header-widget__phone-number-text"><?= $phone_number ?></span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($phone_number_2)): ?>
                                            <a href="tel:<?= $sanitize_phone_number_2 ?>" class="header-widget__phone-number header-widget__phone-number--second">
                                                <div class="header-widget__phone-number-wrap">
                                                    <span class="header-widget__phone-number-icon">
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
                                                    </span>
                                                </div>
                                                <span class="header-widget__phone-number-text"><?= $phone_number_2 ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php
                                    if (!empty($button_text)) {
                                        $button_id = !empty($button_id) ? 'id="' . esc_attr($button_id) . '"' : "";
                                        if ($button_type === 'link') {
                                            if (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) {
                                                echo '<a href="#' . esc_attr($popup_id) . '" ' . $button_id . ' animation="ripple" class="header-widget__callback-button header-widget__button ' . esc_attr($button_class) . '" ' . $popup_data . '>' . esc_html($button_text) . '</a>';
                                            } else {
                                                $url = !empty($button_url) ? esc_url($button_url) : '#';
                                                echo '<a href="' . $url . '" ' . $button_id . ' animation="ripple" class="header-widget__callback-button header-widget__button ' . esc_attr($button_class) . '">' . esc_html($button_text) . '</a>';
                                            }
                                        } elseif ($button_type === 'submit') {
                                            $data_src = (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) ? ' data-mfp-src="#' . esc_attr($popup_id) . '"' : '';
                                            echo '<button type="button" ' . $button_id . ' class="header-widget__callback-button header-widget__button ' . esc_attr($button_class) . '"' . $data_src . '>' . esc_html($button_text) . '</button>';
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
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="M15.6359 11.1586C14.5951 11.1586 13.5732 10.9958 12.6047 10.6757C12.1302 10.5139 11.5469 10.6624 11.2572 10.9598L9.34575 12.4028C7.12898 11.2195 5.76349 9.85442 4.59633 7.65429L5.99684 5.79262C6.3607 5.42924 6.49121 4.89844 6.33485 4.40039C6.01344 3.42687 5.85017 2.40541 5.85017 1.36416C5.85021 0.611956 5.23826 0 4.4861 0H1.36412C0.611956 0 0 0.611956 0 1.36412C0 9.98586 7.01418 17 15.6359 17C16.3881 17 17 16.388 17 15.6359V12.5226C17 11.7705 16.388 11.1586 15.6359 11.1586Z"></path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <span class="header-widget__phone-number-text"><?= $phone_number ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($phone_number_2) && $enable_phone_number_2_mob === "yes"): ?>
                        <a href="tel:<?= $sanitize_phone_number_2 ?>" class="header-widget__phone-number header-widget__phone-number--mob header-widget__phone-number--mob-second">
                            <div class="header-widget__phone-number-wrap">
                                <span class="header-widget__phone-number-icon">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="M15.6359 11.1586C14.5951 11.1586 13.5732 10.9958 12.6047 10.6757C12.1302 10.5139 11.5469 10.6624 11.2572 10.9598L9.34575 12.4028C7.12898 11.2195 5.76349 9.85442 4.59633 7.65429L5.99684 5.79262C6.3607 5.42924 6.49121 4.89844 6.33485 4.40039C6.01344 3.42687 5.85017 2.40541 5.85017 1.36416C5.85021 0.611956 5.23826 0 4.4861 0H1.36412C0.611956 0 0 0.611956 0 1.36412C0 9.98586 7.01418 17 15.6359 17C16.3881 17 17 16.388 17 15.6359V12.5226C17 11.7705 16.388 11.1586 15.6359 11.1586Z"></path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <span class="header-widget__phone-number-text"><?= $phone_number_2 ?></span>
                        </a>
                    <?php endif; ?>
										</div>
                    <?php endif; ?>

                    <?PHP
                    if (!empty($button_text) && $enable_button_text_mob === "yes") {
                        $button_id = !empty($button_id) ? 'id="' . esc_attr($button_id) . '"' : "";
                        if ($button_type === 'link') {
                            if (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) {
                                echo '<a href="#' . esc_attr($popup_id) . '" ' . $button_id . ' class="header-widget__callback-button header-widget__button header-widget__callback-button--mob ' . esc_attr($button_class) . '" ' . $popup_data . '>' . esc_html($button_text) . '</a>';
                            } else {
                                $url = !empty($button_url) ? esc_url($button_url) : '#';
                                echo '<a href="' . $url . '" ' . $button_id . ' class="header-widget__callback-button header-widget__button header-widget__callback-button--mob ' . esc_attr($button_class) . '">' . esc_html($button_text) . '</a>';
                            }
                        } elseif ($button_type === 'submit') {
                            $data_src = (!empty($settings['enable_popup']) && $settings['enable_popup'] === 'yes' && !empty($popup_id)) ? ' data-mfp-src="#' . esc_attr($popup_id) . '"' : '';
                            echo '<button type="button" ' . $button_id . ' class="header-widget__callback-button header-widget__button  header-widget__callback-button--mob ' . esc_attr($button_class) . '"' . $data_src . '>' . esc_html($button_text) . '</button>';
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
                        $menu_items = wp_get_nav_menu_items($menu);
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
                    <?php if (!empty($av_link) || !empty($tg_link) || !empty($whatsapp_link) || !empty($vk_link) && $enable_icon_mob === "yes"): ?>
                        <div class="header-widget__social  header-widget__social--mob">
                            <ul class="header-widget__social-icons">

                                <?php if (!empty($tg_link)): ?>
                                    <li class="header-widget__social-item header-widget__social-item--tg">
                                        <a href="<?= $tg_link ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" version="1.1" id="Layer_1" viewBox="0 0 24 24" xml:space="preserve">
                                                <style type="text/css">
                                                .st0{fill:none;}
                                                </style>
                                                <path d="M19.2,4.4L2.9,10.7c-1.1,0.4-1.1,1.1-0.2,1.3l4.1,1.3l1.6,4.8c0.2,0.5,0.1,0.7,0.6,0.7c0.4,0,0.6-0.2,0.8-0.4  c0.1-0.1,1-1,2-2l4.2,3.1c0.8,0.4,1.3,0.2,1.5-0.7l2.8-13.1C20.6,4.6,19.9,4,19.2,4.4z M17.1,7.4l-7.8,7.1L9,17.8L7.4,13l9.2-5.8  C17,6.9,17.4,7.1,17.1,7.4z"/>
                                                <rect y="0" class="st0" width="24" height="24"/>
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($av_link)): ?>
                                    <li class="header-widget__social-item header-widget__social-item--av">
                                        <a href="<?= $av_link ?>" target="_blank">
                                            <svg width="24" height="24" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.357 4.092a3.108 3.108 0 11-6.216 0 3.108 3.108 0 016.216 0zm4.001 2.435a2.434 2.434 0 100-4.869 2.434 2.434 0 000 4.869zm3.783 4.675a3.782 3.782 0 11-7.565 0 3.782 3.782 0 017.565 0zm-9.132 0a1.76 1.76 0 11-3.52 0 1.76 1.76 0 013.52 0z" fill="#fff"></path>
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($vk_link)): ?>
                                    <li class="header-widget__social-item header-widget__social-item--vk">
                                        <a href="<?= $vk_link ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path d="M19.894 14.5997C19.8698 14.5475 19.8472 14.5042 19.8262 14.4696C19.4792 13.8446 18.8161 13.0775 17.8373 12.1681L17.8166 12.1472L17.8063 12.137L17.7958 12.1266H17.7853C17.341 11.7031 17.0597 11.4183 16.9419 11.2726C16.7264 10.9949 16.6781 10.7138 16.7959 10.429C16.8791 10.2138 17.1918 9.75932 17.7331 9.06499C18.0178 8.69702 18.2433 8.4021 18.4099 8.17991C19.611 6.58314 20.1317 5.56279 19.9719 5.11844L19.9099 5.01461C19.8682 4.95209 19.7606 4.8949 19.5872 4.84275C19.4135 4.7907 19.1914 4.78209 18.9206 4.81678L15.9217 4.8375C15.8731 4.82028 15.8037 4.82189 15.7134 4.84275C15.6231 4.86361 15.5779 4.87408 15.5779 4.87408L15.5257 4.90016L15.4843 4.93149C15.4496 4.9522 15.4114 4.98864 15.3697 5.04072C15.3282 5.09262 15.2936 5.15353 15.2658 5.22294C14.9393 6.06294 14.5681 6.84392 14.1515 7.56586C13.8946 7.99634 13.6587 8.36942 13.4433 8.68531C13.2281 9.00109 13.0476 9.23375 12.9019 9.38288C12.756 9.53217 12.6244 9.65176 12.5061 9.7421C12.3881 9.83248 12.298 9.87067 12.2355 9.8567C12.173 9.84273 12.1141 9.82887 12.0583 9.81501C11.9612 9.7525 11.8831 9.66748 11.8242 9.55989C11.765 9.45229 11.7252 9.31687 11.7044 9.15373C11.6836 8.99048 11.6714 8.85006 11.6679 8.732C11.6646 8.61408 11.6661 8.44729 11.6732 8.2321C11.6804 8.01681 11.6836 7.87113 11.6836 7.79476C11.6836 7.53092 11.6888 7.24457 11.6991 6.93565C11.7096 6.62673 11.7181 6.38196 11.7252 6.20164C11.7323 6.02114 11.7356 5.83017 11.7356 5.62884C11.7356 5.42751 11.7233 5.26962 11.6991 5.15503C11.6752 5.04057 11.6385 4.92948 11.5901 4.82178C11.5414 4.71418 11.4701 4.63095 11.3766 4.57187C11.2829 4.51285 11.1664 4.46602 11.0278 4.43123C10.6598 4.34796 10.1912 4.30292 9.62185 4.29592C8.33069 4.28206 7.50105 4.36543 7.13311 4.54593C6.98733 4.6222 6.85541 4.7264 6.73746 4.85821C6.61247 5.011 6.59504 5.09437 6.68527 5.10809C7.10186 5.17049 7.39677 5.31977 7.57035 5.55579L7.6329 5.68085C7.68155 5.77108 7.73013 5.93083 7.77875 6.15988C7.8273 6.38893 7.85863 6.6423 7.87241 6.91986C7.90706 7.42672 7.90706 7.86059 7.87241 8.22153C7.83765 8.5826 7.80483 8.8637 7.7735 9.06503C7.74217 9.26635 7.69534 9.4295 7.6329 9.55441C7.57035 9.67937 7.52873 9.75574 7.50787 9.78346C7.48704 9.81118 7.46968 9.82865 7.4559 9.83551C7.36566 9.87008 7.27182 9.8877 7.17469 9.8877C7.07742 9.8877 6.95947 9.83905 6.82065 9.74181C6.68188 9.64457 6.53785 9.51101 6.38856 9.3409C6.23928 9.17076 6.07093 8.933 5.88342 8.62757C5.69606 8.32215 5.50166 7.96119 5.30033 7.54467L5.13376 7.2426C5.02963 7.04828 4.88739 6.76532 4.70689 6.394C4.52628 6.02252 4.36664 5.6632 4.22786 5.31609C4.17238 5.17031 4.08904 5.05932 3.97799 4.98295L3.92587 4.95162C3.89122 4.9239 3.8356 4.89447 3.7593 4.8631C3.68289 4.83177 3.60316 4.8093 3.51978 4.79548L0.666572 4.8162C0.375011 4.8162 0.177184 4.88225 0.073018 5.01417L0.0313299 5.07657C0.0105041 5.11133 0 5.16684 0 5.24325C0 5.31963 0.0208258 5.41336 0.0625139 5.52435C0.47903 6.50327 0.931983 7.44736 1.42137 8.35677C1.91076 9.26617 2.33603 9.99872 2.69692 10.5538C3.05789 11.1092 3.42583 11.6334 3.80073 12.1262C4.17563 12.6191 4.42379 12.935 4.54521 13.0738C4.66677 13.2128 4.76225 13.3167 4.83166 13.3861L5.09204 13.636C5.25865 13.8027 5.5033 14.0022 5.82612 14.2348C6.14901 14.4674 6.50648 14.6965 6.89871 14.9223C7.291 15.1477 7.74739 15.3317 8.2681 15.4739C8.78875 15.6164 9.2955 15.6735 9.78842 15.6459H10.986C11.2288 15.625 11.4128 15.5486 11.5379 15.4168L11.5793 15.3646C11.6072 15.3232 11.6333 15.2588 11.6573 15.1722C11.6817 15.0854 11.6938 14.9898 11.6938 14.8858C11.6867 14.5874 11.7094 14.3184 11.7614 14.0789C11.8133 13.8395 11.8724 13.659 11.9386 13.5374C12.0047 13.416 12.0793 13.3135 12.1624 13.2304C12.2456 13.1471 12.3049 13.0967 12.3397 13.0793C12.3743 13.0619 12.4019 13.05 12.4227 13.0429C12.5893 12.9874 12.7854 13.0412 13.0112 13.2044C13.2369 13.3676 13.4486 13.569 13.6465 13.8084C13.8444 14.048 14.0821 14.3169 14.3597 14.6153C14.6376 14.9139 14.8805 15.1358 15.0886 15.2818L15.2968 15.4068C15.4359 15.4902 15.6164 15.5665 15.8386 15.636C16.0604 15.7053 16.2547 15.7227 16.4215 15.688L19.0872 15.6464C19.3509 15.6464 19.556 15.6028 19.7015 15.5161C19.8474 15.4294 19.934 15.3338 19.9619 15.2298C19.9898 15.1257 19.9913 15.0076 19.9672 14.8756C19.9425 14.7439 19.9182 14.6518 19.894 14.5997Z" fill="white"></path>
                                                </g>
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($whatsapp_link)): ?>
                                    <li class="header-widget__social-item header-widget__social-item--ws">
                                        <a href="<?= $whatsapp_link ?>" target="_blank">
                                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.464 3.50708C15.6222 1.66306 13.1727 0.647078 10.5631 0.645996C5.18579 0.645996 0.809458 5.02221 0.807295 10.4009C0.806574 12.1204 1.25574 13.7988 2.1095 15.2782L0.725464 20.3335L5.89716 18.9769C7.32217 19.7542 8.92647 20.1638 10.5591 20.1643H10.5632C15.9399 20.1643 20.3167 15.7877 20.3188 10.4088C20.3198 7.80194 19.306 5.35098 17.464 3.50708ZM10.5631 18.5168H10.5597C9.10479 18.5162 7.67785 18.1251 6.43272 17.3865L6.13676 17.2107L3.0678 18.0158L3.88695 15.0236L3.69409 14.7168C2.88239 13.4258 2.45377 11.9336 2.45449 10.4015C2.45617 5.93088 6.09374 2.29367 10.5663 2.29367C12.7321 2.29439 14.7681 3.1389 16.2989 4.67158C17.8298 6.20425 18.6724 8.2415 18.6717 10.4082C18.6698 14.8792 15.0324 18.5168 10.5631 18.5168ZM15.0108 12.4438C14.7671 12.3218 13.5686 11.7322 13.3451 11.6508C13.1218 11.5694 12.9591 11.5289 12.7968 11.7728C12.6342 12.0168 12.1671 12.5659 12.0249 12.7285C11.8826 12.8912 11.7406 12.9116 11.4968 12.7895C11.2529 12.6676 10.4676 12.4101 9.53641 11.5796C8.81183 10.9333 8.32265 10.135 8.18037 9.89109C8.03834 9.64692 8.17917 9.52772 8.28732 9.39362C8.5512 9.06594 8.81544 8.72239 8.89667 8.55981C8.97802 8.39711 8.93728 8.25471 8.87624 8.13275C8.81544 8.01078 8.32793 6.81096 8.12486 6.32273C7.92683 5.84761 7.72604 5.91178 7.57631 5.90433C7.43428 5.89724 7.2717 5.8958 7.10912 5.8958C6.94666 5.8958 6.68254 5.95672 6.45904 6.20089C6.23566 6.44494 5.606 7.03458 5.606 8.23441C5.606 9.43423 6.47947 10.5933 6.60131 10.756C6.72316 10.9187 8.32024 13.3809 10.7654 14.4366C11.347 14.688 11.801 14.8378 12.1551 14.9502C12.7391 15.1357 13.2704 15.1095 13.6904 15.0468C14.1588 14.9768 15.1325 14.457 15.3358 13.8877C15.5389 13.3183 15.5389 12.8303 15.4779 12.7285C15.4171 12.6268 15.2545 12.5659 15.0108 12.4438Z"></path>
                                                </g>

                                            </svg>
                                        </a>
                                    </li>
                                <?php endif; ?>
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

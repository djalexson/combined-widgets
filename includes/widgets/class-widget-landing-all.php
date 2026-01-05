<?php
namespace CW\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use CW\Traits\Common_Controls;

class Landing_All extends Widget_Base {
    
    use Common_Controls;

    public function get_name() { return 'cw_landing_all'; }
    public function get_title() { return __( 'AS: Landing (All-in-one)', 'combined-widgets' ); }
    public function get_icon() { return 'eicon-site-identity'; }
    public function get_categories() { return [ 'as-widgets' ]; }

    public function get_style_depends() { return [ 'cw-sbalance' ]; }
    public function get_script_depends() { return [ 'cw-sbalance-anim' ]; }

    protected function register_controls() {

        // HERO
        $this->start_controls_section('hero', [
            'label' => __( 'Hero', 'combined-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('hero_title', [ 'label' => __('Заголовок', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => "Управляйте бизнесом,<br>а учёт оставьте мне" ]);
        $this->add_control('hero_text', [ 'label' => __('Текст', 'combined-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => "Ваш QuickBooks ежемесячно настроен, обновлён и подготовлен к отчётам.\nЯ веду учёт, а вы — свой бизнес." ]);
        $this->add_control('hero_btn_icon', [ 'label' => __('Иконка кнопки (CSS-класс)', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'fas fa-paper-plane', 'placeholder' => 'fas fa-icon' ]);
        $this->add_control('hero_btn_text', [ 'label' => __('Текст кнопки', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Заявка на QuickBooks Setup' ]);
        $this->add_control('hero_btn_link', [ 'label' => __('Ссылка', 'combined-widgets'), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#quickbooks-form' ], 'show_external' => false ]);
        $this->add_control('hero_image', [ 'label' => __('Изображение', 'combined-widgets'), 'type' => Controls_Manager::MEDIA ]);

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

        $this->end_controls_section();

        // GUIDES + FAQ + FORM
        $this->start_controls_section('shortcodes', [
            'label' => __( 'Guides / FAQ / Form', 'combined-widgets' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('guides_id', [ 'label' => __('Guides ID', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'guides' ]);
        $this->add_control('guides_shortcode', [ 'label' => __('Guides шорткод', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => '[products limit="6" columns="3" category="guides"]' ]);
        $this->add_control('form_id', [ 'label' => __('Form ID', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'quickbooks-form', 'separator' => 'before' ]);
        $this->add_control('form_shortcode', [ 'label' => __('Form шорткод', 'combined-widgets'), 'type' => Controls_Manager::TEXT, 'default' => '', 'placeholder' => '[contact-form-7 id="123"]' ]);

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

    protected function render() {
        $s = $this->get_settings_for_display();
        $anim = $this->get_anim_class();
        $anim_attrs = $this->get_animation_attrs();

        // HERO
        $hero_title = wp_kses_post($s['hero_title']);
        $hero_text = wp_kses_post(nl2br(esc_html($s['hero_text'])));
        $hlink = $s['hero_btn_link'];
        $hhref = !empty($hlink['url']) ? esc_url($hlink['url']) : '#';
        $htarget = !empty($hlink['is_external']) ? ' target="_blank" rel="noopener"' : '';
        $img = !empty($s['hero_image']['url']) ? esc_url($s['hero_image']['url']) : '';
        $hstyle = $img ? ' style="background-image:url(\'' . $img . '\');"' : '';

        echo '<section class="sb-hero-split' . $anim . '"' . $anim_attrs . '>';
        echo '<div class="sb-hero-split__inner">';
        echo '<div class="sb-hero-split__content sb-anim__item"><h1>' . $hero_title . '</h1><p>' . $hero_text . '</p>';
        echo '<a class="sb-hero-split__btn" href="' . $hhref . '"' . $htarget . '>' . $this->icon_html($s['hero_btn_icon']) . esc_html($s['hero_btn_text']) . '</a></div>';
        echo '<div class="sb-hero-split__media sb-anim__item"' . $hstyle . '></div>';
        echo '</div></section>';

        // PACKAGES
        echo '<section class="sb-section sb-packages' . $anim . '" id="' . esc_attr(sanitize_title($s['packages_id'])) . '"' . $anim_attrs . '>';
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
        echo '<section class="sb-section sb-trust' . $anim . '"' . $anim_attrs . '><div class="sb-container"><div class="sb-strip">';
        $trust = [ ['fas fa-language', 'На русском', 'Понятно и без стресса'], ['fas fa-shield-halved', 'Аккуратно', 'Чистая структура учёта'], ['fas fa-rocket', 'Быстрый старт', 'Двигаемся по шагам'] ];
        foreach($trust as $t){
            echo '<div class="sb-strip__item sb-anim__item"><div class="sb-ico"><i class="' . $t[0] . '"></i></div><div><div class="sb-strip__title">' . $t[1] . '</div><div class="sb-strip__text">' . $t[2] . '</div></div></div>';
        }
        echo '</div></div></section>';

        // PROCESS
        echo '<section class="sb-section sb-process' . $anim . '"' . $anim_attrs . '><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-route"></i> Как проходит работа</h2><p>Прозрачный процесс: вы понимаете, что происходит на каждом шаге.</p></div>';
        echo '<div class="sb-steps">';
        $steps = [['Заявка', 'Коротко описываете задачу'], ['Аудит', 'Смотрю структуру, банки, категории'], ['Настройка / Cleanup', 'Навожу порядок и фиксирую правила'], ['Результат', 'Корректные отчёты и понятная система']];
        foreach($steps as $i => $st){ echo '<div class="sb-step sb-anim__item"><div class="sb-step__num">' . ($i+1) . '</div><div class="sb-step__body"><h3><i class="fas fa-circle-check"></i> ' . $st[0] . '</h3><p>' . $st[1] . '</p></div></div>'; }
        echo '</div><div class="sb-center sb-anim__item"><a class="sb-btn sb-btn--accent" href="#quickbooks-form"><i class="fas fa-paper-plane"></i> Оставить заявку</a></div>';
        echo '</div></section>';

        // REVIEWS
        echo '<section class="sb-section sb-reviews' . $anim . '" id="reviews"' . $anim_attrs . '><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-comment-dots"></i> Отзывы клиентов</h2><p>Несколько коротких отзывов</p></div>';
        echo '<div class="sb-grid sb-grid--3">';
        $reviews = [ ['Setup', '«Всё настроили аккуратно и быстро.»', 'Клиент, бизнес в США'], ['Cleanup', '«После cleanup отчёты стали нормальными.»', 'Клиент, сервисный бизнес'], ['Support', '«Ежемесячно всё под контролем.»', 'Клиент, e-commerce'] ];
        foreach($reviews as $r){ echo '<article class="sb-quote sb-anim__item"><div class="sb-quote__top"><div class="sb-quote__stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div><div class="sb-quote__badge"><i class="fas fa-check"></i> ' . $r[0] . '</div></div><p>' . $r[1] . '</p><div class="sb-quote__who"><i class="fas fa-user"></i> ' . $r[2] . '</div></article>'; }
        echo '</div></div></section>';

        // FORM 1040
        echo '<section class="sb-section sb-secondary' . $anim . '" id="form-1040"' . $anim_attrs . '><div class="sb-container"><div class="sb-two">';
        echo '<div class="sb-anim__item"><h2><i class="fas fa-file-invoice"></i> Помощь по Form 1040</h2><p>Консультации по налоговым декларациям.</p><ul class="sb-list"><li><i class="fas fa-check"></i> Разбор ситуации</li><li><i class="fas fa-check"></i> Ответы простым языком</li><li><i class="fas fa-check"></i> Проверка документов</li></ul><a class="sb-btn sb-btn--ghost" href="#quickbooks-form"><i class="fas fa-arrow-right"></i> Нужна консультация</a></div>';
        echo '<div class="sb-card sb-card--soft sb-anim__item"><h3><i class="fas fa-circle-info"></i> Если вы пришли "только по налогам"</h3><p>Оставьте заявку — уточню детали.</p></div>';
        echo '</div></div></section>';

        // TEAM
        $cols = max(1, min(4, intval($s['team_columns'])));
        echo '<section class="sb-team' . $anim . '" id="' . esc_attr(sanitize_title($s['team_id'])) . '"' . $anim_attrs . '><div class="sb-container">';
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
        $gscode = trim((string)$s['guides_shortcode']);
        echo '<section class="sb-section sb-guides' . $anim . '" id="' . esc_attr(sanitize_title($s['guides_id'])) . '"' . $anim_attrs . '><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-book-open"></i> PDF-гайды</h2><p>Гайды по QuickBooks и формам IRS.</p></div>';
        echo '<div class="sb-products sb-anim__item">' . ($gscode ? do_shortcode($gscode) : '<div class="sb-products__placeholder"><i class="fas fa-cart-shopping"></i> Здесь товары WooCommerce</div>') . '</div>';
        echo '<div class="sb-center sb-anim__item"><a class="sb-btn sb-btn--ghost" href="/shop/"><i class="fas fa-arrow-right"></i> Перейти в магазин</a></div>';
        echo '</div></section>';

        // FAQ
        echo '<section class="sb-section sb-faq' . $anim . '"' . $anim_attrs . '><div class="sb-container">';
        echo '<div class="sb-head sb-anim__item"><h2><i class="fas fa-circle-question"></i> Частые вопросы</h2><p>Коротко — по делу.</p></div>';
        echo '<div class="sb-faq__items">';
        if (!empty($s['faq_items']) && is_array($s['faq_items'])) {
            foreach ($s['faq_items'] as $it) {
                echo '<details class="sb-faq__item sb-anim__item"><summary><i class="fas fa-angle-down"></i> ' . esc_html($it['q']) . '</summary><div class="sb-faq__content">' . esc_html($it['a']) . '</div></details>';
            }
        }
        echo '</div></div></section>';

        // FINAL FORM
        $fscode = trim((string)$s['form_shortcode']);
        echo '<section class="sb-section sb-final' . $anim . '" id="' . esc_attr(sanitize_title($s['form_id'])) . '"' . $anim_attrs . '><div class="sb-container"><div class="sb-final__box">';
        echo '<div class="sb-final__text sb-anim__item"><h2><i class="fas fa-paper-plane"></i> Оставьте заявку на QuickBooks Setup</h2><p>Опишите задачу — я отвечу.</p></div>';
        echo '<div class="sb-final__form sb-anim__item">' . ($fscode ? do_shortcode($fscode) : '<div class="sb-form-placeholder"><i class="fas fa-envelope"></i> Здесь будет форма</div>') . '</div>';
        echo '</div></div></section>';
    }
}








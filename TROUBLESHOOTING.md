# Решение проблем с попапом

## Если попап не открывается:

### 1. Проверьте консоль браузера (F12)
Откройте DevTools и проверьте вкладку Console на наличие ошибок:
- `magnific-popup is not a function` - библиотека не загружена
- `jQuery is not defined` - проблема с jQuery
- `Cannot read property 'magnificPopup'` - конфликт скриптов

### 2. Убедитесь что попап включен
В редакторе Elementor:
- Откройте виджет AS Custom Header
- Перейдите в раздел "Popup Contact Form 7"
- Убедитесь что переключатель "Включить попап" = ДА
- Выберите форму Contact Form 7

### 3. Проверьте что форма существует
- Зайдите в WordPress Admin → Contact → Contact Forms
- Убедитесь что форма создана и опубликована

### 4. Очистите кеш
```bash
wp cache flush --allow-root
wp elementor flush-css --allow-root
wp transient delete --all --allow-root
```

### 5. Проверьте загрузку скриптов
В исходном коде страницы (Ctrl+U) найдите:
- `magnific-popup.min.js` - должен быть подключен
- `custom-popup.js` - должен быть подключен
- `magnific-popup.css` - должен быть подключен

### 6. Проверьте HTML код кнопки
Кнопка должна выглядеть так:
```html
<a href="#opal-contactform-popup-XXX" 
   class="header-widget__callback-button header-widget__button" 
   data-effect="mfp-zoom-in">
   Текст кнопки
</a>
```

И попап контейнер:
```html
<div class="mfp-hide contactform-content my-popup" 
     id="opal-contactform-popup-XXX">
   <!-- форма здесь -->
</div>
```

### 7. Конфликт с другими плагинами
Попробуйте отключить другие плагины попапов/лайтбоксов:
- WP Lightbox
- Easy FancyBox
- Popup Maker
- и т.д.

### 8. Тема конфликтует
Некоторые темы подключают свои версии Magnific Popup.
Проверьте в functions.php темы наличие `wp_enqueue_script('magnific-popup')`

## Технические детали

### Селекторы для инициализации попапа:
1. `.header-widget__callback-button[data-effect="mfp-zoom-in"]`
2. `button[data-mfp-src]`
3. `a[data-mfp-src]`

### Версия Magnific Popup: 1.1.0
CDN: https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/

### Используемые классы анимации:
- `mfp-zoom-in` - основная анимация
- `cw-popup-open` - класс на body при открытии

## Контакты
Если проблема не решена, проверьте:
1. Версию PHP (минимум 7.4)
2. Версию WordPress (минимум 5.8)
3. Версию Elementor (минимум 3.0)

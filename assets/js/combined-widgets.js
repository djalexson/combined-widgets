(function($) {
    'use strict';

    // Polylang Language Switcher Dropdown
    $('.header-widget__lang-current').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $dropdown = $(this).closest('.header-widget__lang-dropdown');
        $dropdown.toggleClass('is-open');
    });

    // Close language dropdown on outside click
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.header-widget__lang-dropdown').length) {
            $('.header-widget__lang-dropdown').removeClass('is-open');
        }
    });

    // Close language dropdown on escape
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $('.header-widget__lang-dropdown').removeClass('is-open');
        }
    });
})(jQuery);

(function() {
    'use strict';

    // Настройки по умолчанию
    var config = {
        threshold: 0.15,           // Элемент должен быть виден на 15%
        rootMargin: '0px 0px -100px 0px',  // Срабатывает за 100px до появления в viewport
        duration: 600,
        staggerDelay: 100
    };

    // CSS стили для анимаций
    var styleId = 'sb-scroll-anim-styles';
    if (!document.getElementById(styleId)) {
        var css = `
            /* Базовые стили */
            .sb-anim__item {
                opacity: 0;
                transition-property: opacity, transform;
                transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
                will-change: opacity, transform;
            }

            /* Типы анимаций - начальное состояние */
            .sb-anim--fade .sb-anim__item { transform: translateY(30px); }
            .sb-anim--fade-up .sb-anim__item { transform: translateY(60px); }
            .sb-anim--fade-down .sb-anim__item { transform: translateY(-60px); }
            .sb-anim--fade-left .sb-anim__item { transform: translateX(-60px); }
            .sb-anim--fade-right .sb-anim__item { transform: translateX(60px); }
            .sb-anim--zoom-in .sb-anim__item { transform: scale(0.85); }
            .sb-anim--zoom-out .sb-anim__item { transform: scale(1.15); }
            .sb-anim--slide-up .sb-anim__item { transform: translateY(100px); }
            .sb-anim--flip .sb-anim__item { 
                transform: perspective(1200px) rotateX(-25deg);
                transform-origin: center bottom;
            }

            /* Активное состояние */
            .sb-anim.is-visible .sb-anim__item {
                opacity: 1;
                transform: translateY(0) translateX(0) scale(1) rotateX(0);
            }

            /* Последовательные задержки для элементов */
            .sb-anim.is-visible .sb-anim__item:nth-child(1) { transition-delay: 0ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(2) { transition-delay: 100ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(3) { transition-delay: 200ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(4) { transition-delay: 300ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(5) { transition-delay: 400ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(6) { transition-delay: 500ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(7) { transition-delay: 600ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(8) { transition-delay: 700ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(9) { transition-delay: 800ms; }
            .sb-anim.is-visible .sb-anim__item:nth-child(10) { transition-delay: 900ms; }

            /* Отключение в редакторе Elementor */
            .elementor-editor-active .sb-anim__item,
            .elementor-editor-preview .sb-anim__item {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }

            /* Уважаем prefers-reduced-motion */
            @media (prefers-reduced-motion: reduce) {
                .sb-anim__item {
                    opacity: 1 !important;
                    transform: none !important;
                    transition: none !important;
                }
            }
        `;
        var style = document.createElement('style');
        style.id = styleId;
        style.textContent = css;
        document.head.appendChild(style);
    }

    function initScrollAnimations() {
        // Проверки окружения
        var isEditor = document.body.classList.contains('elementor-editor-active') ||
                      document.body.classList.contains('elementor-editor-preview');
        
        var prefersReduced = window.matchMedia && 
                            window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Если редактор или пользователь отключил анимации - показываем всё сразу
        if (isEditor || prefersReduced) {
            document.querySelectorAll('.sb-anim').forEach(function(el) {
                el.classList.add('is-visible');
            });
            return;
        }

        // Fallback для старых браузеров
        if (!('IntersectionObserver' in window)) {
            document.querySelectorAll('.sb-anim').forEach(function(el) {
                el.classList.add('is-visible');
            });
            return;
        }

        // Находим все анимируемые блоки
        var animBlocks = document.querySelectorAll('.sb-anim');
        if (!animBlocks.length) return;

        // Применяем настройки длительности
        animBlocks.forEach(function(block) {
            var duration = block.dataset.duration || config.duration;
            var items = block.querySelectorAll('.sb-anim__item');
            
            items.forEach(function(item) {
                item.style.transitionDuration = duration + 'ms';
            });
        });

        // Создаём Intersection Observer
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    // Небольшая задержка перед анимацией для более плавного эффекта
                    setTimeout(function() {
                        if (entry.target) {
                            entry.target.classList.add('is-visible');
                        }
                    }, 50);
                    
                    // Перестаём следить за элементом (запускаем анимацию только один раз)
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            threshold: config.threshold,
            rootMargin: config.rootMargin
        });

        // Наблюдаем за каждым блоком
        animBlocks.forEach(function(block) {
            observer.observe(block);
        });
    }

    // Запускаем после загрузки DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initScrollAnimations);
    } else {
        initScrollAnimations();
    }

    // Перезапускаем в редакторе Elementor при изменениях
    if (window.elementorFrontend) {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/widget', function() {
            setTimeout(initScrollAnimations, 100);
        });
    }
})();

/* ========== Popup Forms ========== */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Создаём контейнер для попапа если его нет
        if ($('#sb-popup-overlay').length === 0) {
            $('body').append('<div id="sb-popup-overlay" class="sb-popup-overlay"><div class="sb-popup-content"><button class="sb-popup-close">&times;</button><div class="sb-popup-body"></div></div></div>');
        }

        // Обработчик клика на кнопки с попапом
        $(document).on('click', '[data-popup-form]', function(e) {
            e.preventDefault();
            var formId = $(this).data('popup-form');
            
            if (formId) {
                // Загружаем форму
                var shortcode = '[contact-form-7 id="' + formId + '"]';
                
                // Показываем попап
                var $overlay = $('#sb-popup-overlay');
                var $body = $overlay.find('.sb-popup-body');
                
                $body.html('<div class="sb-popup-loading"><i class="fas fa-spinner fa-spin"></i> Загрузка...</div>');
                $overlay.fadeIn(200);
                
                // AJAX загрузка формы
                $.ajax({
                    url: window.wpcf7 ? window.wpcf7.apiSettings.root : '/wp-json/contact-form-7/v1/contact-forms/' + formId,
                    method: 'GET',
                    success: function(response) {
                        $body.html('<div class="wpcf7">' + response.form + '</div>');
                    },
                    error: function() {
                        $body.html('<div class="sb-popup-error">Ошибка загрузки формы</div>');
                    }
                });
            }
        });

        // Закрытие попапа
        $(document).on('click', '.sb-popup-close, .sb-popup-overlay', function(e) {
            if (e.target === this) {
                $('#sb-popup-overlay').fadeOut(200);
            }
        });

        // Закрытие по ESC
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('#sb-popup-overlay').fadeOut(200);
            }
        });
    });
})(jQuery);

/* ========== custom-header.js ========== */
// Ripple effect for buttons with animation="ripple"
const elements = document.querySelectorAll('[animation="ripple"]');
[...elements].forEach(element => {
	element.addEventListener('mouseenter', function (e) {
		const rect = this.getBoundingClientRect();
		const x = e.clientX - rect.left;
		const y = e.clientY - rect.top;
		const size = Math.max(rect.width, rect.height);

		const ripple = document.createElement('span');
		ripple.className = 'ripple';
		ripple.style.left = `${x}px`;
		ripple.style.top = `${y}px`;
		ripple.style.setProperty('--scale', size);

		this.appendChild(ripple);

		setTimeout(() => {
			ripple.remove();
		}, 1000);
	});
});

// Auto-position menus to prevent overflow
function menuAutoPosition(className) {
	const screenWidth = window.innerWidth;
	const menus = document.querySelectorAll(className);

	menus.forEach((menu) => {
		const menuBounds = menu.getBoundingClientRect();
		const currentLeft = parseFloat(getComputedStyle(menu).left) || 0; 
		
		if (menuBounds.right > screenWidth) {
			const offset = menuBounds.right - screenWidth; 
			menu.style.left = `${currentLeft - offset}px`;			
		} else if (menuBounds.left < 0) {
			const offset = Math.abs(menuBounds.left); 
			menu.style.left = `${currentLeft + offset}px`;
		} else {
			menu.style.left = "0";
		}
	});
}

function initMenuAutoPosition() {
	if (document.querySelectorAll(".mega-menu").length) {
		menuAutoPosition(".mega-menu");
	}
	if (document.querySelectorAll(".submenu").length) {
		menuAutoPosition(".submenu");
	}
	if (window.innerWidth >= 1279) {
		if( document.querySelector(".header-widget-mob-overlay")){
			handleBurgerState("close");
		}
	}
}

initMenuAutoPosition();
window.addEventListener("resize", initMenuAutoPosition);

// Contact Form 7 integration
const form = document.querySelector('[data-wpcf7-id="10"] .wpcf7-form');
if (form) {
	const checkbox = form.querySelector('.form-check');
	const name = form.querySelector('.form-input-name');
	const phone = form.querySelector('.form-input-phone');
	const submitButton = form.querySelector('.wpcf7-submit');
	const responseOutput = form.querySelector('.wpcf7-response-output');
	const targetInput = form.querySelector('[name="text-843"]');
	const targetphone = form.querySelector('[name="tel-phone"]');
	const container = form.querySelectorAll(".alert-mess");
	
	jQuery(document).on('customPopupClosed', function() {
		if (targetInput) {
			targetInput.value = "";
		}
		if (name) {
			name.value = "";
		}
		if (targetphone) {
			targetphone.value = "";
		}
		if (phone) {
			phone.value = "";
		}
		setTimeout(() => {
			const targetElement = form.querySelector('[data-name="text-843"] span');
			const target = form.querySelector('[data-name="tel-phone"] span');
			
			if (targetElement) {
				targetElement.remove();
			}
			if (target) {
				target.remove();
			}
		}, 1800)	

		if (container && container[0] && container[0].innerHTML !== "") {
			container[0].innerHTML = "";
		}
		if (container && container[1] && container[1].innerHTML !== "") {
			container[1].innerHTML = "";
		}
	});

	if (name) {
		name.addEventListener("input", (e) => {
			if (targetInput) {
				targetInput.value = e.target.value;
			}
		});
	}
	
	if (phone) {
		phone.addEventListener("input", (e) => {
			let input = e.target.value.replace(/\D/g, ''); 
			let match = input.match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);

			let formatted = !match[2]
				? match[1]
				: "+7 " +
					(match[2] ? "(" + match[2] + ") " : "") +
					(match[3] ? match[3] : "") +
					(match[4] ? "-" + match[4] : "") +
					(match[5] ? "-" + match[5] : "");
			e.target.value = formatted;
			if (typeof targetphone !== 'undefined' && targetphone) {
				targetphone.value = formatted;
			}
		});
	}

	if (checkbox) {
		checkbox.addEventListener("change", (e) => {
			if (!e.target.checked) {
				submitButton.disabled = true;
				e.preventDefault();
			} else {
				submitButton.disabled = false;
			}
		});
	}
	
	form.addEventListener('submit', function (e) {
		setTimeout(() => {
			const targetElement = form.querySelector('[data-name="text-843"] span');
			const targetP = form.querySelector('[data-name="tel-phone"] span');
	
			if (targetP) {
				if (container.length > 0) {
					container[1].innerHTML = targetP.innerHTML;
				}
			}
			if (targetElement) {
				if (container.length > 0) {
					container[0].innerHTML = targetElement.innerHTML;
				}
			}
		}, 1800);
	});
}

// Burger menu toggle
function toggleBurger() {
	const burgers = document.querySelectorAll(".header-widget__burger");
	burgers.forEach((e,i) => {
		if (!burgers[i].classList.contains("active")) {
			burgers[i].classList.remove("active");
		}else{
			burgers[i].classList.add("active");
		}
	});
}

const body = document.body;
const overlayClass = "header-widget-mob-overlay";
let overlay = document.querySelector(`.${overlayClass}`);

function handleBurgerState(type) {
	const mobileMenu = document.querySelector(".header-widget-mob");

	if (type === "open") {
		if (!overlay) {
			overlay = document.createElement("div");
			overlay.className = overlayClass;
			body.prepend(overlay);
		}
		overlay.appendChild(mobileMenu);

		setTimeout(() => {
			overlay.classList.add("active");
			body.classList.add("header-widget-mob-body");
			toggleBurger();
		}, 100);
	} else if (type === "close") {
		overlay.classList.remove("active");
		body.classList.remove("header-widget-mob-body");

		setTimeout(() => {
			toggleBurger();
			document.querySelector(".header-widget").after(mobileMenu);
			overlay.remove();
			overlay = null;
		}, 300);
	}
}

function handleBurgerClick(event) {
	const targetBurger = event.target.closest(".header-widget__burger");
	const isOverlayClick = event.target.classList.contains(overlayClass);
	const isCallbackButton = event.target.closest(".header-widget__callback-button--mob");

	if (targetBurger || isOverlayClick) {
		if (targetBurger && !targetBurger.classList.contains("active")) {
			handleBurgerState("open");
		} else {
			handleBurgerState("close");
		}
	}else if(isCallbackButton){
		handleBurgerState("close");
	}
}

window.addEventListener("click", handleBurgerClick);

const menuContainer = document.querySelector(".header-widget__menu--mob");
if (menuContainer) {
	menuContainer.addEventListener("click", event => {
		const clickedElement = event.target;

		if (clickedElement.tagName === "SPAN" && clickedElement.closest(".menu__item--mob-has-children")) {
			const parentItem = clickedElement.closest(".menu__item--mob-has-children");
			const siblingOpenItems = parentItem.parentElement.querySelectorAll(":scope > .menu__item--mob-has-children.open");
			
			siblingOpenItems.forEach(openItem => {
				if (openItem !== parentItem) {
					openItem.classList.remove("open");
				}
			});
			parentItem.classList.toggle("open");
		}
	});
}

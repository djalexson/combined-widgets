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

(function(){
  'use strict';

  // Настройки по умолчанию
  var defaults = {
    threshold: 0.15,
    rootMargin: '0px 0px -50px 0px',
    duration: 600,
    delay: 0,
    easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
    once: true
  };

  // CSS стили для анимаций (инжектим динамически)
  var styleId = 'sb-anim-styles';
  if (!document.getElementById(styleId)) {
    var css = `
      /* Базовые стили анимации */
      .sb-anim__item {
        opacity: 0;
        transition-property: opacity, transform;
        transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: opacity, transform;
      }
      
      /* Типы анимаций - начальное состояние */
      .sb-anim__item[data-anim="fade"],
      .sb-anim__item:not([data-anim]) {
        transform: translateY(20px);
      }
      .sb-anim__item[data-anim="fade-up"] {
        transform: translateY(40px);
      }
      .sb-anim__item[data-anim="fade-down"] {
        transform: translateY(-40px);
      }
      .sb-anim__item[data-anim="fade-left"] {
        transform: translateX(-40px);
      }
      .sb-anim__item[data-anim="fade-right"] {
        transform: translateX(40px);
      }
      .sb-anim__item[data-anim="zoom-in"] {
        transform: scale(0.8);
      }
      .sb-anim__item[data-anim="zoom-out"] {
        transform: scale(1.2);
      }
      .sb-anim__item[data-anim="flip"] {
        transform: perspective(1000px) rotateX(-30deg);
      }
      .sb-anim__item[data-anim="slide-up"] {
        transform: translateY(100px);
      }
      
      /* Активное состояние */
      .sb-anim.is-inview .sb-anim__item,
      .sb-anim__item.is-visible {
        opacity: 1;
        transform: translateY(0) translateX(0) scale(1) rotateX(0);
      }
      
      /* Последовательные задержки для дочерних элементов */
      .sb-anim.is-inview .sb-anim__item:nth-child(1) { transition-delay: 0ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(2) { transition-delay: 80ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(3) { transition-delay: 160ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(4) { transition-delay: 240ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(5) { transition-delay: 320ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(6) { transition-delay: 400ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(7) { transition-delay: 480ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(8) { transition-delay: 560ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(9) { transition-delay: 640ms; }
      .sb-anim.is-inview .sb-anim__item:nth-child(10) { transition-delay: 720ms; }
      
      /* Отключение анимации в редакторе Elementor */
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

  function onReady(fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
  }

  function initScrollAnimations() {
    // Находим все контейнеры анимации
    var containers = document.querySelectorAll('.sb-anim');
    // Также находим отдельные элементы с data-anim
    var standaloneItems = document.querySelectorAll('[data-anim]:not(.sb-anim__item)');
    
    if (!containers.length && !standaloneItems.length) return;

    // Проверка prefers-reduced-motion
    var prefersReducedMotion = window.matchMedia && 
      window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Проверка на редактор Elementor
    var isEditor = document.body.classList.contains('elementor-editor-active') ||
                   document.body.classList.contains('elementor-editor-preview');
    
    if (prefersReducedMotion || isEditor) {
      // Показываем всё сразу без анимации
      containers.forEach(function(c) { c.classList.add('is-inview'); });
      standaloneItems.forEach(function(el) { el.classList.add('is-visible'); });
      return;
    }

    // Fallback для старых браузеров
    if (!('IntersectionObserver' in window)) {
      containers.forEach(function(c) { c.classList.add('is-inview'); });
      standaloneItems.forEach(function(el) { el.classList.add('is-visible'); });
      return;
    }

    // Применяем индивидуальные настройки
    function applySettings(el) {
      var duration = el.dataset.duration || defaults.duration;
      var delay = el.dataset.delay || defaults.delay;
      
      el.style.transitionDuration = duration + 'ms';
      if (delay > 0) {
        el.style.transitionDelay = delay + 'ms';
      }
    }

    // Создаём Observer для контейнеров
    var containerObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var container = entry.target;
          var once = container.dataset.once !== 'false';
          
          // Применяем настройки к дочерним элементам
          var items = container.querySelectorAll('.sb-anim__item');
          items.forEach(applySettings);
          
          // Активируем анимацию
          container.classList.add('is-inview');
          
          if (once) {
            containerObserver.unobserve(container);
          }
        } else {
          // Если once=false, убираем класс при выходе из viewport
          if (entry.target.dataset.once === 'false') {
            entry.target.classList.remove('is-inview');
          }
        }
      });
    }, {
      root: null,
      threshold: defaults.threshold,
      rootMargin: defaults.rootMargin
    });

    // Создаём Observer для отдельных элементов
    var itemObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var once = el.dataset.once !== 'false';
          
          applySettings(el);
          el.classList.add('is-visible');
          
          if (once) {
            itemObserver.unobserve(el);
          }
        } else {
          if (entry.target.dataset.once === 'false') {
            entry.target.classList.remove('is-visible');
          }
        }
      });
    }, {
      root: null,
      threshold: defaults.threshold,
      rootMargin: defaults.rootMargin
    });

    // Запускаем наблюдение
    containers.forEach(function(c) {
      // Устанавливаем кастомный offset если есть
      var offset = c.dataset.offset;
      if (offset) {
        var customObserver = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-inview');
              if (entry.target.dataset.once !== 'false') {
                customObserver.unobserve(entry.target);
              }
            } else if (entry.target.dataset.once === 'false') {
              entry.target.classList.remove('is-inview');
            }
          });
        }, {
          root: null,
          threshold: defaults.threshold,
          rootMargin: '0px 0px -' + offset + 'px 0px'
        });
        customObserver.observe(c);
      } else {
        containerObserver.observe(c);
      }
    });

    standaloneItems.forEach(function(el) {
      itemObserver.observe(el);
    });

    // Пересоздаём observer при изменении размера окна (для пересчёта)
    var resizeTimer;
    window.addEventListener('resize', function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
        // Re-check visibility after resize
      }, 250);
    });
  }

  onReady(initScrollAnimations);

  // Экспортируем функцию для повторной инициализации (AJAX, Elementor)
  window.sbAnimInit = initScrollAnimations;

  // Поддержка Elementor frontend
  if (typeof jQuery !== 'undefined') {
    jQuery(window).on('elementor/frontend/init', function() {
      if (typeof elementorFrontend !== 'undefined') {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
          setTimeout(initScrollAnimations, 100);
        });
      }
    });
  }
})();

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

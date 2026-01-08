jQuery(function($) {
	// Теперь $ будет работать как jQuery
	class ContactFormPopup {
			static instance;

			static getInstance() {
					if (!ContactFormPopup.instance) {
							ContactFormPopup.instance = new ContactFormPopup();
					}
					return ContactFormPopup.instance;
			}

			constructor() {
					$(document).ready(() => {
							this.init();
					});
					$(window).on('elementor/frontend/init', () => {
							this.init();
					});
			}

			init() {


				const initScope = ($scope) => {
					const $buttons = $scope.find('.header-widget__callback-button');
				console.log('ContactFormPopup: инициализация попапов');			
					if (!$buttons.length) return;

					// Проверяем наличие Magnific Popup
					const hasMfp = !!$.fn.magnificPopup;
	
					$buttons.each(function() {
						const $btn = $(this);
						const effect = $btn.attr('data-effect') || 'mfp-fade';
						const href = $btn.attr('href');
						const dataSrc = $btn.attr('data-mfp-src');
						
	
						if (hasMfp) {
							// Анкорная ссылка на inline-попап
							if (href && href.startsWith('#')) {
								const targetId = href;
								const $target = $(targetId);
								
								$btn.magnificPopup({
									type: 'inline',
									removalDelay: 500,
									callbacks: {
										beforeOpen: function() { 
											this.st.mainClass = effect;
															},
										close: function() { 
											$(document).trigger('customPopupClosed');
											console.log('ContactFormPopup: закрытие попапа');
										}
									},
									midClick: true
								});
							} else if (dataSrc) {
								// Кнопка с data-mfp-src
								
								$btn.on('click', function(e){
									e.preventDefault();
								
									$.magnificPopup.open({
										items: { src: dataSrc },
										type: 'inline',
										removalDelay: 500,
										mainClass: effect || 'mfp-fade',
										callbacks: {
											close: function() { 
												$(document).trigger('customPopupClosed');
											}
										}
									});
								});
							}
						} else {
					
							if (href && href.startsWith('#')) {
								$btn.on('click', function(e){
									e.preventDefault();
									const $target = $(href);
									if ($target.length) {
										$target.show();
									}
								});
							}
						}
					});
				};

				// Инициализация для Elementor
				if (window.elementorFrontend && elementorFrontend.hooks) {
					elementorFrontend.hooks.addAction('frontend/element_ready/AS_custom_header_widget.default', initScope);
				}
				
				// Инициализация для обычной страницы
				initScope($(document));
			}
	}

	// Инициализация класса
	ContactFormPopup.getInstance();
});
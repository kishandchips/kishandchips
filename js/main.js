;(function($) {

	window.main = {
		vars: {},
		init: function(){

			var header = main.vars.header = $('#header'),
				mainNavigation = header.mainNavigation = $('.main-navigation', header);

			if($.fn.scroller){
				$('.scroller').each(function(){
					var scroller = $(this);
					var options = {};

					if(scroller.hasClass('gallery-scroller') || scroller.data('scroll-all') === true) options.scrollAll = true;
					if(scroller.data('auto-scroll') === true ) options.autoScroll = true;
					if(scroller.data('resize') === true ) options.resize = true;
					if(scroller.data('callback')) {
						scroller.bind('onChange', function(e, nextItem){
							var func = window[scroller.data('callback')];
							func($(this), nextItem);
						});
					}

					scroller.scroller(options);
				});
			}

			$('a[href^=#].scroll-to-btn').click(function(){
				var target = $($(this).attr('href'));
				var offsetTop = (target.length != 0) ? target.offset().top : 0;
				//$('body, html').animate({scrollTop: offsetTop}, 500, 'easeInOutQuad');
				return false;
			});

			this.lightbox.init();
			this.ajaxPage.init();

		
			$('.mobile-navigation-btn', header).on('click', function(){
				$('.main-navigation', header).slideToggle(200);
			});

			var projectplannerForm = $('#project-planner');
			if(projectplannerForm.length > 0){
				$('.gf_page_steps .gf_step', projectplannerForm).each(function(){
					var step = $(this),
						pageId = step.attr('id').replace('gf_step_', '');

					$('.gform_body #gform_page_' + pageId + ' .gform_page_fields', projectplannerForm).prepend(step);
				});
			}

			$(window).resize(this.resize);
			this.resize();

		},

		loaded: function(){
			$('body').addClass('loaded');
			this.equalHeight();
			this.setBoxSizing();
			this.accordion();
		},

		lightbox: {
			init: function(){

			}
		},

		setBoxSizing: function(){
			if( $('html').hasClass('no-boxsizing') ){
		        $('.span:visible').each(function(){
		        	console.log($(this).attr('class'));
		        	var span = $(this);
		            var fullW = span.outerWidth(),
		                actualW = span.width(),
		                wDiff = fullW - actualW,
		                newW = actualW - wDiff;
		 			
		            span.css('width',newW);
		        });
		    }
		},		

		ajaxPage: {
			init: function(){
				main.ajaxPage.container = $('#ajax-page');
				$('.ajax-btn').on('click', function(e){
					e.preventDefault();
					main.ajaxPage.load($(this).attr('href'));
				});
			},
			load: function(url){

				var container = main.ajaxPage.container,
					regex = new RegExp('(\\?|\\&)ajax=.*?(?=(&|$))'),
		        	qstring = /\?.+$/;

			    if (regex.test(url)){
			        ajaxUrl = url.replace(regex, '$1ajax=true');
			    } else if (qstring.test(url)) {
			        ajaxUrl = url + '&ajax=true';
			    } else {
			        ajaxUrl =  url + '?ajax=true';
			    }
			    history.pushState(null, null, url);
			    $('html, body').animate({scrollTop: container.offset().top - 200}, 800, 'easeInOutQuad');
			    if($('.content', container).length == 0){

					loader = $('<div class="loader"></div>').hide();
					container.append(loader);
					
					container.delay(200).animate({height: loader.actual('outerHeight')}, function(){
						loader.fadeIn();

						$.get(ajaxUrl, function(data) {
							var content = $('<div class="content"></div>').hide();

							container.append(content);
							content.html(data);
							loader.fadeOut(function(){
								if($.fn.imagesLoaded){
									content.imagesLoaded(function(){
										main.resize();
										container.animate({'height': content.height()}, function(){
											container.css({'height': 'auto'});
											content.fadeIn();
										});
									});
								} else {
									container.animate({'height': content.actual('height')}, function(){
										container.css({'height': 'auto'});
										content.fadeIn();
										main.resize();
									});
								}
								
							});
						});
					});
				} else {
					var content = $('.content', container),
						loader = $('.loader', container);
					content.fadeOut(function(){
						loader.fadeIn();
						
						$.get(ajaxUrl, function(data) {
							content.html(data);
							loader.fadeOut(function(){
								if($.fn.imagesLoaded){
									content.imagesLoaded(function(){
										main.resize();
										container.animate({'height': content.height()}, function(){
											container.css({'height': 'auto'});
											content.fadeIn();
										});
									});
								} else {
									container.animate({'height': content.actual('height')}, function(){
										container.css({'height': 'auto'});
										content.fadeIn();
										main.resize();
									});
								}
								
							});
						});
					});
				}
			}
		},

		accordion: function() {
			  	var allPanels = $('.accordion, .acc-close').hide();
			  	var openBtn = $('.acc-open');

				$(document).on('click', '.acc-open', function(e) {
			  	e.preventDefault();
			  	scrollPosition = ($(this).parent().offset().top);
			  	console.log(scrollPosition);
			  	$('html, body').animate({scrollTop: scrollPosition}, 300);


			    allPanels.slideUp();
			    $(this).parent().parent().next('.accordion').slideDown();
			    openBtn.show();
			    $(this).hide();
			    $(this).next('.acc-close').show();
			    return false;
			  });

			  $('.acc-close').click(function(e) {
			  	e.preventDefault();
			  	$(this).parent().parent().next('.accordion').slideUp();
			  	$('html, body').animate({scrollTop: scrollPosition}, 300);
			    $(this).hide();
			    openBtn.show();
			    return false;
			  });

			  $('.close-bottom .close-btn').click(function(e) {
			  	e.preventDefault();
			  	$('.acc-close').click();
			  }); 

		},

		equalHeight: function(){
			if($('.equal-height').length !== 0){
		
				var currTallest = 0,
				currRowStart = 0,
				rowDivs = new Array(),
				topPos = 0;

				$('.equal-height').each(function() {

					var element = $(this);
					topPos = element.offset().top;
					element.height('auto');
					if (currRowStart != topPos) {

						for (i = 0 ; i < rowDivs.length ; i++) {
							rowDivs[i].height(currTallest);
						}

						rowDivs.length = 0;
						currRowStart = topPos;
						currTallest = element.height();
						rowDivs.push(element);

					} else {
						rowDivs.push(element);
						currTallest = (currTallest < element.height()) ? (element.height()) : (currTallest);
					}

					for (i = 0 ; i < rowDivs.length ; i++) {
						rowDivs[i].height(currTallest);
					}

				});
			}
		},

		resize: function(){
			var windowWidth = $(window).width(),
				mainNavigation = main.vars.header.mainNavigation;
			if(windowWidth <= 400 && mainNavigation.is(':visible')){
				mainNavigation.hide();
			} else if(windowWidth > 400 && !mainNavigation.is(':visible')) {
				mainNavigation.show();
			}

			main.equalHeight();	
		}
	}

	$(function(){
		main.init();
	});

	$(window).load(function(){
		main.loaded();
	});
})(jQuery);
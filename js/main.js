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
					var image = $('img.first', this);

					image.hide();

					if(scroller.hasClass('gallery-scroller') || scroller.data('scroll-all') === true) options.scrollAll = true;
					if(scroller.data('auto-scroll') === true ) options.autoScroll = true;
					if(scroller.data('resize') === true ) options.resize = true;
					if(scroller.data('callback')) {
						scroller.bind('onChange', function(e, nextItem){
							var func = window[scroller.data('callback')];
							func($(this), nextItem);
						});					
					}
					
					if($.fn.imagesLoaded){
						image.imagesLoaded(function(){
							image.fadeIn();
						});
					}

					scroller.scroller(options);
				});				
			}

			this.lightbox.init();
			this.ajaxPage.init();
			this.accordion.init();

		
			$('.mobile-navigation-btn', header).on('click', function(){
				$('.main-navigation', header).slideToggle(200);
			});

			if($(''))
			var projectplannerForm = $('#project-planner, #form-want-a-job');
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

		accordion: {
			init: function() {
				main.accordion.allPanels = $('.accordion');
				main.accordion.hideclosebtn = $('.acc-close').hide();
				main.accordion.allPanels.hide();
 		
				main.accordion.anchor();
				main.accordion.deeplink();

				$('.acc-open, a.title').on('click', function(e) {
					e.preventDefault();
					var id = $(this).data('id');
					main.accordion.open(id);
				});

				$('.close-btn').on('click', function(e) {
					e.preventDefault();
					var id = $(this).data('id');
					main.accordion.close(id);
				});
			},

			open: function(id) {	
					var item = $('.accordion[data-id='+id+']'),
						parent = $('div').find("[id='child-" + id + "']");
					main.accordion.scrollto(parent);
					item.addClass('open');
					if (item.is(":visible")) {
						$('.acc-close', parent).hide();
						$('.acc-open', parent).show();
					} else {
						$('.acc-close', parent).show();
						$('.acc-open', parent).hide();
					}					
					item.slideToggle(300);


							
			},

			close: function(id) {		
					var item = $('.accordion[data-id='+id+']'),
					parent = $('div').find("[id='child-" + id + "']");
					item.removeClass('open');
					$('.acc-close', parent).hide();
					$('.acc-open', parent).show();
					console.log(parent);
					item.slideUp(300);
					main.accordion.scrollto(parent);

					if (window.history && window.history.pushState) {
						var url = baseUrl + '/what-we-do/';
						history.pushState({page:url}, url, url);
					}				
			},

			scrollto: function(obj) {
				scrollposition = obj.offset().top;
				$('html, body').animate({scrollTop: scrollposition + 4}, 300);
			},

			anchor: function() {
				$('.child-page a:not(.link, .title)').on('click', function(e) {
					e.preventDefault();
					var target = $(this).attr('href');
				
				    $(this).parent().next('.acc-open').hide();
				    $(this).parent().next('.acc-close').show();		
					$(this).parent().parent().parent().next('.accordion').slideDown();
					main.accordion.scrollto($(target));				

					if (window.history && window.history.pushState) {
							history.pushState(null, null, target);
					}					
				});					
			},

			deeplink: function() {
				if(window.location.hash != '') {
					var hash = window.location.hash,
						object = $(hash);
					object.parent().show();
					main.accordion.scrollto(object);
				}				
			}
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

function onHomeScrollerChange(scroller, nextItem){
	var kccolor = nextItem.data('kc-color');
	var digitalcolor = nextItem.data('digital-color');
	var kc_title = $('.scroller-mask .header span.kc_title');
	var digital_title = $('.scroller-mask .header span.digital_title');
    setTimeout( function(){
      kc_title.css('color',kccolor);
      digital_title.css('color',digitalcolor);
    },300);	
}
(function($){

    "use strict";
	
    /* ---------------------------------------------------------------------------
	 * Sticky header
	 * --------------------------------------------------------------------------- */
	function mfn_sticky(){
		if( $('body').hasClass('header-below') ){
	    	// header below slider
	    	var mfn_header_height = $('#mfn-rev-slider').innerHeight() + $('#Header').innerHeight();
	    } else {
	    	// default
	    	var mfn_header_height = $('#Top_bar').innerHeight() + $('#Action_bar').innerHeight();
	    }
		
		if( $('body').hasClass('sticky-header') ){	
			var start_y = mfn_header_height;
			var window_y = $(window).scrollTop();
	
			if( window_y > start_y ){
				if( ! ($('#Top_bar').hasClass('is-sticky'))) {
					$('.header-classic .header_placeholder').css('margin-top', $('#Top_bar').innerHeight() - $('#Action_bar').innerHeight());
					$('.header-stack   .header_placeholder').css('margin-top', 71);
					$('.header-below   .header_placeholder').css('margin-top', $('#Top_bar').innerHeight());
					$('#Top_bar')
						.addClass('is-sticky')
						.css('top',-60)
						.animate({
							'top': $('#wpadminbar').innerHeight()
						},300);
				}
			}
			else {
				if($('#Top_bar').hasClass('is-sticky')) {
					$('.header-classic .header_placeholder, .header-stack .header_placeholder, .header-below .header_placeholder')
						.css('margin-top',0);
					$('#Top_bar')
						.removeClass('is-sticky')
						.css('top', 61);
				}	
			}
		}
	}
	
	
	/* ---------------------------------------------------------------------------
	 * Sidebar height
	 * --------------------------------------------------------------------------- */
	function mfn_sidebar(){
		if( $('.with_aside .four.columns').length ){
			var contentH = $('#Content .sections_group').height() - 20;
			$('.with_aside .four.columns .widget-area').height();
			$('.with_aside .four.columns .widget-area').css( 'min-height', contentH + 'px' );
		}
	}
	
	
	/* ---------------------------------------------------------------------------
	 * Header width
	 * --------------------------------------------------------------------------- */
	function mfn_header(){
		var rightW = $('.top_bar_right').innerWidth();
		var parentW = $('#Top_bar .one').innerWidth() - 10;
		var leftW = parentW - rightW;
		$('.top_bar_left, .menu > li > ul.mfn-megamenu ').width( leftW );
	}
	
	
	/* ---------------------------------------------------------------------------
	 * Full Screen Section
	 * --------------------------------------------------------------------------- */
	function mfn_sectionH(){
		var windowH = $(window).height();
		$('.section.full-screen').each(function(){
			var section = $(this);
			var wrapper = $('.section_wrapper',section);
			section
				.css('padding', 0)
				.height( windowH );
			var padding = ( windowH - wrapper.height() ) / 2;
			wrapper.css('padding-top', padding + 20);			// 20 = column margin-bottom / 2
		});
	}

	
	/* --------------------------------------------------------------------------------------------------------------------------
	 * $(document).ready
	 * ----------------------------------------------------------------------------------------------------------------------- */
	$(document).ready(function(){
	

		/* ---------------------------------------------------------------------------
		 * Content sliders
		 * --------------------------------------------------------------------------- */
		mfnSliderContent();
		mfnSliderOffer();
		mfnSliderBlog();
		mfnSliderClients();
		mfnSliderPortfolio();
		mfnSliderShop();
		mfnSliderTestimonials();
		
		
		/* ---------------------------------------------------------------------------
		 * Responsive menu
		 * --------------------------------------------------------------------------- */
		$('.responsive-menu-toggle').click(function(e){
			e.preventDefault();
			$(this).toggleClass('active');
			$('#Top_bar #menu').stop(true,true).slideToggle(200);
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Main menu
		 * --------------------------------------------------------------------------- */
		
		// Muffin Menu -------------------------------
		$("#menu > ul.menu").muffingroup_menu({
			arrows	: true
		});
		
		$("#secondary-menu > ul.secondary-menu").muffingroup_menu();
		
		mfn_sticky();

		
		/* ---------------------------------------------------------------------------
		 * Menu - OnePage - remove active
		 * --------------------------------------------------------------------------- */
		function menuOnePage(){
			var menu = $('#menu');
			
			if( menu.find('li.current-menu-item, li.current-menu-ancestor, li.current_page_item').length > 1 ){
				menu.find('li.current-menu-item:not(:first)').removeClass('current-menu-item current-menu-ancestor current_page_item');
				
				// menu item click
				menu.find('a').click(function(){
					$(this).closest('li').siblings('li').removeClass('current-menu-item current-menu-ancestor current_page_item');
					$(this).closest('li').addClass('current-menu-item');
				});
			}
		}
		menuOnePage();
		
		
		/* ---------------------------------------------------------------------------
		 * Creative Header
		 * --------------------------------------------------------------------------- */
		function creativeHeader(){
			var ch = $('#Header_creative');
			var current;
			
			$('.creative-menu-toggle').click(function(e){
				e.preventDefault();
				ch.addClass('active').animate({ 'left':-1 },500);
				ch.find('.creative-wrapper').fadeIn(500);
				ch.find('.creative-menu-toggle, .creative-social').fadeOut(500);
			});
			
			ch.live('mouseenter', function() {    
			    current = 1;
			}).live('mouseleave', function() {
			    current = null;
			    setTimeout(function(){
			    	if ( ! current ){
				    	ch.removeClass('active').animate({ 'left':-200 },500);
						ch.find('.creative-wrapper').fadeOut(500);
						ch.find('.creative-menu-toggle, .creative-social').fadeIn(500);
			    	}
			    }, 1000);
			});
			
		}
		creativeHeader();

		
		/* ---------------------------------------------------------------------------
		 * Maintenance
		 * --------------------------------------------------------------------------- */
        $('.downcount').each(function(){
            var el = $(this);
           	el.downCount({
    			date	: el.attr('data-date'),
    			offset	: el.attr('data-offset')
    		});  
        });     
            

        /* ---------------------------------------------------------------------------
		 * niceScroll
		 * --------------------------------------------------------------------------- */
        if( $('body').hasClass('nice-scroll-on') 
        	&& $(window).width() > 767
        	&& ! navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/))
        {
        	$('html').niceScroll({
        		autohidemode		: false,
        		cursorborder		: 0,
        		cursorborderradius	: 5,
        		cursorcolor			: '#222222',
        		cursorwidth			: 10,
        		horizrailenabled	: false,
        		mousescrollstep		: 40,
        		scrollspeed			: 60
        	});
        	$('body').removeClass('nice-scroll-on').addClass('nice-scroll');
	    }
        
        
		/* ---------------------------------------------------------------------------
		 * Sliding Top
		 * --------------------------------------------------------------------------- */
		$(".sliding-top-control").click(function(e){
			e.preventDefault();
			$('#Sliding-top .widgets_wrapper').slideToggle();
			$('#Sliding-top').toggleClass('active');
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Header Search
		 * --------------------------------------------------------------------------- */
		$("#search_button, #Top_bar .icon_close").click(function(e){
			e.preventDefault();
			$('#Top_bar .search_wrapper').fadeToggle();
		});
		
		
		/* ---------------------------------------------------------------------------
		 * WP Gallery
		 * --------------------------------------------------------------------------- */
		$('.gallery-icon > a')
			.wrap('<div class="image_frame scale-with-grid"><div class="image_wrapper"></div></div>')
			.prepend('<div class="mask"></div>')
			.attr('rel', 'prettyphoto[gallery]')
			.children('img' )
				.css('height', 'auto')
				.css('width', '100%');
		
		
		/* ---------------------------------------------------------------------------
		 * PrettyPhoto
		 * --------------------------------------------------------------------------- */
		if( $(window).width() >= 768 ){
			$('a[rel^="prettyphoto"], .prettyphoto').prettyPhoto({
				show_title		: false,
				deeplinking		: false,
				social_tools	: false
			});
		}
		
		
		/* ---------------------------------------------------------------------------
		 * Alert
		 * --------------------------------------------------------------------------- */
		$('.alert .close').click(function(e){
			e.preventDefault();
			$(this).closest('.alert').hide(300);
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Buttons - mark Buttons with Icon & Label
		 * --------------------------------------------------------------------------- */
		$('a.button_js').each(function(){
			var btn = $(this);
			if( btn.find('.button_icon').length && btn.find('.button_label').length ){
				btn.addClass('kill_the_icon');
			}
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Posts sticky navigation
		 * --------------------------------------------------------------------------- */
		$('.fixed-nav').appendTo('body');
		
		
		/* ---------------------------------------------------------------------------
		 * Feature List
		 * --------------------------------------------------------------------------- */
		$('.feature_list ul li:nth-child(4n):not(:last-child)').after('<hr />');
		
		
		/* ---------------------------------------------------------------------------
		 * IE fixes
		 * --------------------------------------------------------------------------- */
		function checkIE(){
			// IE 9
			var ua = window.navigator.userAgent;
	        var msie = ua.indexOf("MSIE ");
	        if( msie > 0 && parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))) == 9 ){
	        	$("body").addClass("ie");
			}
		}
		checkIE();
		
		
		/* ---------------------------------------------------------------------------
		 * Paralex Backgrounds
		 * --------------------------------------------------------------------------- */
		var ua = navigator.userAgent,
		isMobileWebkit = /WebKit/.test(ua) && /Mobile/.test(ua);
		if( ! isMobileWebkit && $(window).width() >= 768 ){
			$.stellar({
				horizontalScrolling	: false,
				responsive			: true
			});
		}
	
		
		/* ---------------------------------------------------------------------------
		 * Blog & Portfolio filters
		 * --------------------------------------------------------------------------- */
		$('.filters_buttons .open').click(function(e){
			e.preventDefault();
			var type = $(this).closest('li').attr('class');
			$('.filters_wrapper').show(200);
			$('.filters_wrapper ul.'+ type).show(200);
			$('.filters_wrapper ul:not(.'+ type +')').hide();
		});
		
		$('.filters_wrapper .close a').click(function(e){
			e.preventDefault();
			$('.filters_wrapper').hide(200);
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Portfolio List - next/prev buttons
		 * --------------------------------------------------------------------------- */
		$('.portfolio_next_js').click(function(e){
			e.preventDefault();
			
			var stickyH = $('#Top_bar.is-sticky').innerHeight();
			var item = $(this).closest('.portfolio-item').next();
			
			if( item.length ){
				$('html, body').animate({ 
					scrollTop: item.offset().top - stickyH
				}, 500);
			}
		});
		
		$('.portfolio_prev_js').click(function(e){
			e.preventDefault();
			
			var stickyH = $('#Top_bar.is-sticky').innerHeight();
			var item = $(this).closest('.portfolio-item').prev();
			
			if( item.length ){
				$('html, body').animate({ 
					scrollTop: item.offset().top - stickyH
				}, 500);
			}
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Tabs
		 * --------------------------------------------------------------------------- */
		$(".jq-tabs").tabs();

		
		/* ---------------------------------------------------------------------------
		 * Anchor Fix for Sticky header + Smooth scroll
		 * --------------------------------------------------------------------------- */
		var hash = window.location.hash;
		if( hash && $(hash).length ){	
			
			var stickyH = $('.sticky-header #Top_bar').innerHeight();
			var tabsHeaderH = $(hash).siblings('.ui-tabs-nav').innerHeight();
			
			$('html, body').animate({ 
				scrollTop: $(hash).offset().top - stickyH - tabsHeaderH
			}, 500);
		}

		$('#menu li.scroll > a, a.scroll').click(function(){
			var url = $(this).attr('href');
			var hash = '#' + url.split('#')[1];
			
			var stickyH = $('.sticky-header #Top_bar').innerHeight();
			var tabsHeaderH = $(hash).siblings('.ui-tabs-nav').innerHeight();
			
			if( hash && $(hash).length ){
				$('html, body').animate({ 
					scrollTop: $(hash).offset().top - stickyH - tabsHeaderH
				}, 500);
			}
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Muffin Accordion & FAQ
		 * --------------------------------------------------------------------------- */
		$(".mfn-acc.open1st .question:first-child")
			.addClass("active")
			.children(".answer")
				.show();

		$(".mfn-acc .question > .title").click(function(){		
			if($(this).parent().hasClass("active")) {
				$(this).parent().removeClass("active").children(".answer").slideToggle(200);
			}
			else
			{
				if( ! $(this).closest('.mfn-acc').hasClass('toggle') ){
					$(this).parents(".mfn-acc").children().each(function() {
						if($(this).hasClass("active")) {
							$(this).removeClass("active").children(".answer").slideToggle(200);
						}
					});
				}
				$(this).parent().addClass("active");
				$(this).next(".answer").slideToggle(200);
			}
		});

		
		/* ---------------------------------------------------------------------------
		 * jPlayer
		 * --------------------------------------------------------------------------- */
		$('.mfn-jplayer').each(function(){
			var m4v = $(this).attr('data-m4v');
			var poster = $(this).attr('data-img');
			var swfPath = $(this).attr('data-swf');
			var cssSelectorAncestor = '#' + $(this).closest('.mfn-jcontainer').attr('id');
			
			$(this).jPlayer({
				ready	: function () {
					$(this).jPlayer('setMedia', {
						m4v		: m4v,
						poster	: poster
					});
				},
				play	: function () { // To avoid both jPlayers playing together.
					$(this).jPlayer('pauseOthers');
				},
				size: {
					cssClass	: 'jp-video-360p',
					width		: '100%',
					height		: '360px'
				},
				swfPath				: swfPath,
				supplied			: 'm4v',
				cssSelectorAncestor	: cssSelectorAncestor,
				wmode				: 'opaque'
			});
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Love
		 * --------------------------------------------------------------------------- */
		$('.mfn-love').click(function() {
			var el = $(this);
			if( el.hasClass('loved') ) return false;
			
			var post = {
				action: 'mfn_love',
				post_id: el.attr('data-id')
			};
			
			$.post(window.mfn_ajax, post, function(data){
				el.find('.label').html(data);
				el.addClass('loved');
			});

			return false;
		});	
		
		
		/* ---------------------------------------------------------------------------
		 * Go to top
		 * --------------------------------------------------------------------------- */	
		$('#back_to_top').click(function(){
			$('body,html').animate({
				scrollTop: 0
			}, 500);
			return false;
		});		
		
		
		/* ---------------------------------------------------------------------------
		 * WooCommerce
		 * --------------------------------------------------------------------------- */	
		function addToCart() {
			$('body').on('click', '.add_to_cart_button', function(){
				$(this)
					.closest('.product')
						.addClass('adding-to-cart')
						.removeClass('added-to-cart');
			});

			$('body').bind('added_to_cart', function() {
				$('.adding-to-cart')
					.removeClass('adding-to-cart')
					.addClass('added-to-cart');
			});
		}
		addToCart();
		
		
		/* ---------------------------------------------------------------------------
		 * Iframe height
		 * --------------------------------------------------------------------------- */		
		function iframeHeight( item, ratio ){
			var itemW = item.width();
			var itemH = itemW * ratio;
			if( itemH < 147 ) itemH = 147;
			item.height(itemH);
		}
		
		function iframesHeight(){
			iframeHeight($(".blog_wrapper .post-photo-wrapper .mfn-jplayer, .blog_wrapper .post-photo-wrapper iframe, .post-related .mfn-jplayer, .post-related iframe, .blog_slider_ul .mfn-jplayer, .blog_slider_ul iframe"), 0.78);	// blog - list			
			iframeHeight($(".single-post .single-photo-wrapper .mfn-jplayer, .single-post .single-photo-wrapper iframe" ), 0.4);	// blog - single
			
			iframeHeight($(".section-portfolio-header .mfn-jplayer, .section-portfolio-header iframe" ), 0.4);	// portfolio - single
		}
		iframesHeight();

		
		/* ---------------------------------------------------------------------------
		 * Debouncedresize
		 * --------------------------------------------------------------------------- */
		$(window).bind("debouncedresize", function() {
			
			iframesHeight();	
			$('.masonry.isotope').isotope();
			
			// carouFredSel wrapper Height set
			mfn_carouFredSel_height();
			
			// Sidebar Height
			mfn_sidebar();
			
			// Header Width
			mfn_header();
			
			// Full Screen Section
			mfn_sectionH();
		});
		
		/* ---------------------------------------------------------------------------
		 * isotope
		 * --------------------------------------------------------------------------- */
		function isotopeFilter( domEl, isoWrapper ){
			var filter = domEl.attr('data-rel');
			isoWrapper.isotope({ filter: filter });
		}
		
		$('.isotope-filters .filters_wrapper').find('li:not(.close) a').click(function(e){
			e.preventDefault();
			isotopeFilter( $(this), $('.isotope') );
		});
		$('.isotope-filters .filters_buttons').find('li.reset a').click(function(e){
			e.preventDefault();
			isotopeFilter( $(this), $('.isotope') );
		});
		
		// carouFredSel wrapper Height set
		mfn_carouFredSel_height();
		
		// Sidebar Height
		mfn_sidebar();
		
		// Header Width
		mfn_header();

		// Full Screen Section
		mfn_sectionH();
	});
	
	
	/* --------------------------------------------------------------------------------------------------------------------------
	 * $(window).scroll
	 * ----------------------------------------------------------------------------------------------------------------------- */
	$(window).scroll(function(){
		mfn_sticky();
	});
	
	
	/* --------------------------------------------------------------------------------------------------------------------------
	 * $(window).load
	 * ----------------------------------------------------------------------------------------------------------------------- */
	$(window).load(function(){

		/* ---------------------------------------------------------------------------
		 * Isotope
		 * --------------------------------------------------------------------------- */
		// Portfolio - Isotope
		$('.portfolio_wrapper  .isotope:not(.masonry-flat)').isotope({
			itemSelector	: '.portfolio-item',
			layoutMode		: 'fitRows',
			resizable		: true
		});
		
		// Portfolio - Masonry Flat
		$('.portfolio_wrapper .masonry-flat').isotope({
			itemSelector	: '.portfolio-item',
			masonry			: {
			      columnWidth: 1
		    },
			resizable		: true
		});

		// Blog & Portfolio - Masonry
		$('.masonry.isotope').isotope({
			itemSelector	: '.isotope-item',
			layoutMode		: 'masonry',
			resizable		: true
		});

		
		/* ---------------------------------------------------------------------------
		 * Chart
		 * --------------------------------------------------------------------------- */
		$('.chart').waypoint({
			offset		: '100%',
			triggerOnce	: true,
			handler		: function(){
				var color = $(this).attr('data-color');
				$(this).easyPieChart({
					animate		: 1000,
					barColor	: color,
					lineCap		: 'circle',
					lineWidth	: 8,
					size		: 140,
					scaleColor	: false,
					trackColor	: '#f8f8f8'
				});
			}
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Skills
		 * --------------------------------------------------------------------------- */
		$('.bars_list').waypoint({
			offset		: '100%',
			triggerOnce	: true,
			handler		: function(){
				$(this).addClass('hover');
			}
		});
		
		
		/* ---------------------------------------------------------------------------
		 * Animate Math [counter, quick_fact, etc.]
		 * --------------------------------------------------------------------------- */
		$('.animate-math .number').waypoint({
			offset		: '100%',
			triggerOnce	: true,
			handler		: function(){
				var el			= $(this);
				var duration	= Math.floor((Math.random()*1000)+1000);
				var to			= el.attr('data-to');

				$({property:0}).animate({property:to}, {
					duration	: duration,
					easing		:'linear',
					step		: function() {
						el.text(Math.floor(this.property));
					},
					complete	: function() {
						el.text(this.property);
					}
				});
			}
		});
		
		
		// carouFredSel wrapper Height set
		mfn_carouFredSel_height();
		
		// Sidebar Height
		mfn_sidebar();
		
		// Header Width
		mfn_header();

		// Full Screen Section
		mfn_sectionH();
	});
	

	/* --------------------------------------------------------------------------------------------------------------------------
	 * $(document).mouseup
	 * ----------------------------------------------------------------------------------------------------------------------- */
	$(document).mouseup(function(e){
		
		// search
		if( $("#searchform").has(e.target).length === 0 ){
			if( $("#searchform").hasClass('focus') ){
				$(this).find('.icon_close').click();
			}
		}
		
	});
	
	
	/* ---------------------------------------------------------------------------
	 * Sliders configuration
	 * --------------------------------------------------------------------------- */
	
	// carouFredSel wrapper Height set -------------------------------------------
	function mfn_carouFredSel_height(){
		$('.caroufredsel_wrapper > ul').each(function(){
			var el = $(this);
			var maxH = 0;
			el.children('li').each(function(){				
				if( $(this).innerHeight() > maxH ){
					maxH = $(this).innerHeight();
				}
			});
//			console.log(maxH);
			el.closest('.caroufredsel_wrapper').height( maxH );
		});
		
	}
	
	// --- Slider ----------------------------------------------------------------
	function mfnSliderContent(){	
		$('.content_slider_ul').each(function(){

			// Init carouFredSel
			$('.content_slider_ul').carouFredSel({
				circular	: true,
				responsive	: true,
				items		: {
					visible	: 1,
					width	: 100
				},
				scroll		: {
					duration	: 500,
					easing		: 'swing'
				},
				prev        : {
					button		: function(){
						return $(this).closest('.content_slider').find('.slider_prev');
					}
				},
				next        : {
					button		: function(){
						return $(this).closest('.content_slider').find('.slider_next');
					}
				},
				pagination	: {
					container	: function(){
						return $(this).closest('.content_slider').find('.slider_pagination');
					}
				},
				auto		: {
					play			: true,
					timeoutDuration	: 6000
				},
				swipe		: {
					onTouch		: true,
					onMouse		: true,
					onBefore	: function(){
						$(this).find('a').addClass('disable');
						$(this).find('li').trigger('mouseleave');
					},
					onAfter		: function(){
						$(this).find('a').removeClass('disable');
					}
				}
			});
			
			// Disable accidental clicks while swiping
			$(this).on('click', 'a.disable', function() {
				return false; 
			});
		});
	}
	
	
	// --- Testimonials ----------------------------------------------------------------
	function mfnSliderTestimonials(){	
		$('.testimonials_slider_ul').each(function(){
			
			// Init carouFredSel
			$(this).carouFredSel({
				circular	: true,
				responsive	: true,
				items		: {
					visible	: 1,
					width	: 100
				},
				scroll		: {
					duration	: 500,
					easing		: 'swing'
				},
				prev        : {
					button		: function(){
						return $(this).closest('.testimonials_slider').find('.slider_prev');
					}
				},
				next        : {
					button		: function(){
						return $(this).closest('.testimonials_slider').find('.slider_next');
					}
				},
				pagination	: {
					container	: function(){
						return $(this).closest('.testimonials_slider').find('.slider_images');
					},
					anchorBuilder : false
				},
				auto		: {
					play			: true,
					timeoutDuration	: 7000
				},
				swipe		: {
					onTouch		: true,
					onMouse		: true,
					onBefore	: function(){
						$(this).find('a').addClass('disable');
						$(this).find('li').trigger('mouseleave');
					},
					onAfter		: function(){
						$(this).find('a').removeClass('disable');
					}
				}
			});
			
			// Disable accidental clicks while swiping
			$(this).on('click', 'a.disable', function() {
				return false; 
			});
		});
	}
	
	
	// --- Offer -----------------------------------------------------------------
	function mfnSliderOffer(){	
		$('.offer_ul').each(function(){
			
			// Init carouFredSel
			$(this).carouFredSel({
				circular	: true,
				responsive	: true,
				items		: {
					visible	: 1,
					width	: 100
				},
				scroll		: {
					duration	: 500,
					easing		: 'swing',
					onAfter		: function(){
						$(this).closest('.offer').find('.current').text($(this).triggerHandler("currentPosition")+1);
					}
				},
				prev        : {
					button		: function(){
						return $(this).closest('.offer').find('.slider_prev');
					}
				},
				next        : {
					button		: function(){
						return $(this).closest('.offer').find('.slider_next');
					}
				},
				auto		: {
					play			: true,
					timeoutDuration	: 10000
				},
				swipe		: {
					onTouch		: true,
					onMouse		: true,
					onBefore	: function(){
						$(this).find('a').addClass('disable');
						$(this).find('li').trigger('mouseleave');
					},
					onAfter		: function(){
						$(this).find('a').removeClass('disable');
						$(this).closest('.offer').find('.current').text($(this).triggerHandler("currentPosition")+1);
					}
				}
			});
			
			// Disable accidental clicks while swiping
			$(this).on('click', 'a.disable', function() {
				return false; 
			});
			
			// Items count
			var count = $(this).children('.offer_li').length;
			$(this).closest('.offer').find('.count').text(count);
		});
	}
	
	
	// --- Blog ------------------------------------------------------------------	
	function mfnSliderBlog(){	
		$('.blog_slider_ul').each(function(){
			
			// Init carouFredSel
			$(this).carouFredSel({
				circular	: true,
				responsive	: true,
				items		: {
					width : 380,
					visible	: {
						min		: 1,
						max		: 4
					}
				},
				scroll		: {
					duration	: 500,
					easing		: 'swing'
				},
				prev        : {
					button		: function(){
						return $(this).closest('.blog_slider').find('.slider_prev');
					}
				},
				next        : {
					button		: function(){
						return $(this).closest('.blog_slider').find('.slider_next');
					}
				},
				pagination	: {
					container	: function(){
						return $(this).closest('.blog_slider').find('.slider_pagination');
					}
				},
				auto		: {
					play			: false
				},
				swipe		: {
					onTouch		: true,
					onMouse		: true,
					onBefore	: function(){
						$(this).find('a').addClass('disable');
						$(this).find('li').trigger('mouseleave');
					},
					onAfter		: function(){
						$(this).find('a').removeClass('disable');
					}
				}
			});
			
			// Disable accidental clicks while swiping
			$(this).on('click', 'a.disable', function() {
				return false; 
			});
		});
	}
	
	
	// --- Clients ------------------------------------------------------------------	
	function mfnSliderClients(){	
		$('.clients_slider_ul').each(function(){
			
			// Init carouFredSel
			$(this).carouFredSel({
				circular	: true,
				responsive	: true,
				items		: {
					width : 380,
					visible	: {
						min		: 1,
						max		: 4
					}
				},
				scroll		: {
					duration	: 500,
					easing		: 'swing'
				},
				prev        : {
					button		: function(){
						return $(this).closest('.clients_slider').find('.slider_prev');
					}
				},
				next        : {
					button		: function(){
						return $(this).closest('.clients_slider').find('.slider_next');
					}
				},
				pagination	: {
					container	: function(){
						return $(this).closest('.clients_slider').find('.slider_pagination');
					}
				},
				auto		: {
					play			: false
				},
				swipe		: {
					onTouch		: true,
					onMouse		: true,
					onBefore	: function(){
						$(this).find('a').addClass('disable');
						$(this).find('li').trigger('mouseleave');
					},
					onAfter		: function(){
						$(this).find('a').removeClass('disable');
					}
				}
			});
			
			// Disable accidental clicks while swiping
			$(this).on('click', 'a.disable', function() {
				return false; 
			});
		});
	}
	
	
	// --- Shop ------------------------------------------------------------------	
	function mfnSliderShop(){	
		$('.shop_slider_ul').each(function(){
			
			// Init carouFredSel
			$(this).carouFredSel({
				circular	: true,
				responsive	: true,
				items		: {
					width : 380,
					visible	: {
						min		: 1,
						max		: 4
					}
				},
				scroll		: {
					duration	: 500,
					easing		: 'swing'
				},
				prev        : {
					button		: function(){
						return $(this).closest('.shop_slider').find('.slider_prev');
					}
				},
				next        : {
					button		: function(){
						return $(this).closest('.shop_slider').find('.slider_next');
					}
				},
				pagination	: {
					container	: function(){
						return $(this).closest('.shop_slider').find('.slider_pagination');
					}
				},
				auto		: {
					play			: false
				},
				swipe		: {
					onTouch		: true,
					onMouse		: true,
					onBefore	: function(){
						$(this).find('a').addClass('disable');
						$(this).find('li').trigger('mouseleave');
					},
					onAfter		: function(){
						$(this).find('a').removeClass('disable');
					}
				}
			});
			
			// Disable accidental clicks while swiping
			$(this).on('click', 'a.disable', function() {
				return false; 
			});
		});
	}
	
	
	// --- Portfolio -------------------------------------------------------------
	function mfnSliderPortfolio(){	
		$('.portfolio_slider_ul').each(function(){
			
			// Init carouFredSel
			$(this).carouFredSel({
				circular	: true,
				responsive	: true,
				items		: {
					width : 380,
					visible	: {
						min		: 1,
						max		: 5
					}
				},
				scroll		: {
					duration	: 600,
					easing		: 'swing'
				},
				auto		: {
					play		: false
				},
				swipe		: {
					onTouch		: true,
					onMouse		: true,
					onBefore	: function(){
						$(this).find('a').addClass('disable');
						$(this).find('li').trigger('mouseleave');
					},
					onAfter		: function(){
						$(this).find('a').removeClass('disable');
					}
				}
			});
			
			// Disable accidental clicks while swiping
			$(this).on('click', 'a.disable', function() {
				return false; 
			});
		});
	}

})(jQuery);
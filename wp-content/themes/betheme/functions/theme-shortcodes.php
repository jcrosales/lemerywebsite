<?php
/**
 * Shortcodes.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */


/* ---------------------------------------------------------------------------
 * Column One [one] [/one]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_one' ) )
{
	function sc_one( $attr, $content = null )
	{
		$output  = '<div class="column one">';
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Column One Second [one_second] [/one_second]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_one_second' ) )
{
	function sc_one_second( $attr, $content = null )
	{
		$output  = '<div class="column one-second">';
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Column One Third [one_third] [/one_third]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_one_third' ) )
{
	function sc_one_third( $attr, $content = null )
	{
		$output  = '<div class="column one-third">';
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Column Two Third [two_third] [/two_third]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_two_third' ) )
{
	function sc_two_third( $attr, $content = null )
	{
		$output  = '<div class="column two-third">';
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Column One Fourth [one_fourth] [/one_fourth]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_one_fourth' ) )
{
	function sc_one_fourth( $attr, $content = null )
	{
		$output  = '<div class="column one-fourth">';
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Column Two Fourth [two_fourth] [/two_fourth]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_two_fourth' ) )
{
	function sc_two_fourth( $attr, $content = null )
	{
		$output  = '<div class="column two-fourth">';
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Column Three Fourth [three_fourth] [/three_fourth]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_three_fourth' ) )
{
	function sc_three_fourth( $attr, $content = null )
	{
		$output  = '<div class="column three-fourth">';
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Code [code] [/code]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_code' ) )
{
	function sc_code( $attr, $content = null )
	{
		$output  = '<pre>';
			$output .= do_shortcode(htmlspecialchars($content));
		$output .= '</pre>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Article Box [article_box] [/article_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_article_box' ) )
{
	function sc_article_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image' 	=> '',
			'slogan' 	=> '',
			'title' 	=> '',
			'link' 		=> '',
			'target' 	=> '',
			'animate' 	=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}	
		
		$output = '<div class="article_box">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';
				
					$output .= '<div class="photo_wrapper">';
						$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
					$output .= '</div>';
					
					$output .= '<div class="desc_wrapper">';
						if( $slogan ) $output .= '<p>'. $slogan .'</p>';
						if( $title ) $output .= '<h4>'. $title .'</h4>';
						$output .= '<i class="icon-right-open themecolor"></i>';
					$output .= '</div>';
					
				if( $link ) $output .= '</a>';
			if( $animate ) $output .= '</div>'."\n";
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Photo Box [photo_box] [/photo_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_photo_box' ) )
{
	function sc_photo_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image' 	=> '',
			'title' 	=> '',
			'link' 		=> '',
			'target' 	=> '',
			'animate' 	=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}

		$output = '<div class="photo_box">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				if( $title ) $output .= '<h4>'. $title .'</h4>';
				
				if( $image ){
					$output .= '<div class="image_frame">';
						$output .= '<div class="image_wrapper">';
							if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';;
								$output .= '<div class="mask"></div>';
								$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
							if( $link ) $output .= '</a>';
						$output .= '</div>';
					$output .= '</div>';
				}
				
				$output .= '<div class="desc">'. do_shortcode($content) .'</div>';	
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Sliding Box [sliding_box] [/sliding_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_sliding_box' ) )
{
	function sc_sliding_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image' 	=> '',
			'title' 	=> '',
			'link' 		=> '',
			'target' 	=> '',
			'animate' 	=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}	
		
		$output = '<div class="sliding_box">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';
				
					$output .= '<div class="photo_wrapper">';
						$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
					$output .= '</div>';
					
					$output .= '<div class="desc_wrapper">';
						if( $title ) $output .= '<h4>'. $title .'</h4>';
					$output .= '</div>';
					
				if( $link ) $output .= '</a>';
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Trailer Box [trailer_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_trailer_box' ) )
{
	function sc_trailer_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image' 	=> '',
			'slogan' 	=> '',
			'title' 	=> '',
			'link' 		=> '',
			'target' 	=> '',
			'animate' 	=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}	
		
		$output = '<div class="trailer_box">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';
				
					$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
					$output .= '<div class="desc">';
						if( $slogan ) $output .= '<div class="subtitle">'. $slogan .'</div>';
						if( $title )  $output .= '<h2>'. $title .'</h2>';
						$output .= '<div class="line"></div>';
					$output .= '</div>';
					
				if( $link ) $output .= '</a>';
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Promo Box [promo_box] [/promo_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_promo_box' ) )
{
	function sc_promo_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image' 	=> '',
			'title' 	=> '',
			'btn_text' 	=> '',
			'btn_link' 	=> '',
			'position' 	=> 'left',
			'border' 	=> '',
			'target' 	=> '',
			'animate' 	=> '',
		), $attr));
		
		// border
		if( $border ){
			$border = 'has_border';
		} else {
			$border = 'no_border';
		}
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
				
		$output = '<div class="promo_box '. $border .'">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				$output .= '<div class="promo_box_wrapper promo_box_'. $position .'">';
	
					$output .= '<div class="photo_wrapper">';
						if( $image ) $output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'">';
					$output .= '</div>';
					
					$output .= '<div class="desc_wrapper">';
						if( $title )$output .= '<h2>'. $title .'</h2>';
						if( $content ) $output .= '<div class="desc">'. do_shortcode($content) .'</div>';
						if( $btn_link ) $output .= '<a href="'. $btn_link .'" class="button button_left button_theme button_js" '. $target .'><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">'. $btn_text .'</span></a>';
					$output .= '</div>';
					
				$output .= '</div>';
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Share Box [share_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_share_box' ) )
{
	function sc_share_box( $attr, $content = null )
	{
		$output = '<div class="share_wrapper share_item">';
		
			$output .= '<span class="st_facebook_vcount" displayText="Facebook"></span>';
			$output .= '<span class="st_twitter_vcount" displayText="Tweet"></span>';
			$output .= '<span class="st_pinterest_vcount" displayText="Pinterest"></span>';
			
			$output .= '<script src="http'. mfn_ssl() .'://w'. mfn_ssl() .'.sharethis.com/button/buttons.js"></script>';
			$output .= '<script>stLight.options({publisher: "1390eb48-c3c3-409a-903a-ca202d50de91", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>';
			
		$output .= '</div>';

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * How It Works [how_it_works] [/how_it_works]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_how_it_works' ) )
{
	function sc_how_it_works( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image' 	=> '',
			'number' 	=> '',
			'title' 	=> '',
			'border' 	=> '',
			'link' 		=> '',
			'target' 	=> '',
			'animate' 	=> '',
		), $attr));
		
		// border
		if( $border ){
			$border = 'has_border';
		} else {
			$border = 'no_border';
		}
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
				
		$output = '<div class="how_it_works '. $border .'">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			
					if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';
						$output .= '<div class="image">';
							$output .= '<img src="'. $image .'" class="scale-with-grid" alt="'. $title .'">';
							if( $number ) $output .= '<span class="number">'. $number .'</span>';
						$output .= '</div>';
					if( $link ) $output .= '</a>';
					
					if( $title ) $output .= '<h4>'. $title .'</h4>';
					$output .= '<div class="desc">'. do_shortcode($content) .'</div>';
				
			if( $animate ) $output .= '</div>'."\n";
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Blog [blog]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_blog' ) )
{
	function sc_blog( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'count'				=> 2,
			'category'			=> '',
			'category_multi'	=> '',
			'style'				=> 'classic',
			'more'				=> '',
			'pagination'		=> '',
		), $attr));

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
		$args = array(
			'posts_per_page'		=> intval($count),
			'paged' 				=> $paged,
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1
		);

		// categories
		if( $category_multi ){
			$args['category_name'] = trim( $category_multi );
		} elseif( $category ){
			$args['category_name'] = $category;
		}
		
		// classes
		$classes = $style;
		if( $style == 'masonry' ) $classes .= ' isotope';
		if( ! $more ) $classes .= ' hide-more'; 

		$query_blog = new WP_Query( $args );

		$output = '<div class="blog_wrapper isotope_wrapper">';
		
			$output .= '<div class="posts_group '. $classes .'">';				
					$output .= mfn_content_post($query_blog, $style);					
			$output .= '</div>';
			
			if( $pagination ) $output .= mfn_pagination($query_blog);

		$output .= '</div>'."\n";
		
		wp_reset_postdata();

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Blog Slider [blog_slider]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_blog_slider' ) )
{
	function sc_blog_slider( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'				=> '',
			'count'				=> 5,
			'category'			=> '',
			'category_multi'	=> '',
			'more'				=> '',
		), $attr));

		$translate['readmore'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-readmore','Read more') : __('Read more','betheme');
		
		// classes
		$classes = '';
		if( ! $more ) $classes .= ' hide-more';
		
		$args = array(
			'posts_per_page'		=> intval($count),
			'no_found_rows'			=> 1,
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1
		);
		
		// categories
		if( $category_multi ){
			$args['category_name'] = trim( $category_multi );
		} elseif( $category ){
			$args['category_name'] = $category;
		}

		$query_blog = new WP_Query( $args );

		$output = '<div class="blog_slider '. $classes .'">';
		
			$output .= '<div class="blog_slider_header">';
				if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
				$output .= '<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>';
				$output .= '<a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>';
			$output .= '</div>';
			
			$output .= '<ul class="blog_slider_ul">';				
				while ( $query_blog->have_posts() ){
					$query_blog->the_post();
	
					$output .= '<li class="'. implode(' ',get_post_class()).'">';
						$output .= '<div class="item_wrapper">';
					
							if( get_post_format() == 'quote'){
								$output .= '<blockquote>';
									$output .= '<a href="'. get_permalink() .'">';
										$output .= get_the_title();
									$output .= '</a>';
								$output .= '</blockquote>';
							} else {
								$output .= '<div class="image_frame scale-with-grid">';
									$output .= '<div class="image_wrapper">';
										$output .= get_the_post_thumbnail( get_the_ID(), 'blog', array('class'=>'scale-with-grid' ) );
									$output .= '</div>';
								$output .= '</div>';	
							}
							
							$output .= '<div class="date_label">'. get_the_date() .'</div>';
							
							$output .= '<div class="desc">';
								if( get_post_format() != 'quote') $output .= '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
								$output .= '<hr class="hr_color" />';
								$output .= '<a href="'. get_permalink() .'" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">'. $translate['readmore'] .'</span></a>';
							$output .= '</div>';
							
						$output .= '</div>';
					$output .= '</li>';
				}
				wp_reset_postdata();					
			$output .= '</ul>';
			
			$output .= '<div class="slider_pagination"></div>';

		$output .= '</div>'."\n";
		
		wp_reset_postdata();

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Shop Slider [shop_slider]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_shop_slider' ) )
{
	function sc_shop_slider( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'			=> '',
			'count'			=> 5,
			'category'		=> '',
			'orderby' 		=> 'date',
			'order' 		=> 'DESC',
		), $attr));

		$args = array(
			'post_type' 			=> 'product',
			'posts_per_page' 		=> intval($count),
			'paged' 				=> -1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts'	=> 1
		);
		if( $category ) $args['product_cat'] = $category;			

		$query_shop = new WP_Query();
		$query_shop->query( $args );
		
		$output = '<div class="shop_slider">';
		
			$output .= '<div class="blog_slider_header">';
				if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
				$output .= '<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>';
				$output .= '<a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>';
			$output .= '</div>';
				
			$output .= '<ul class="shop_slider_ul">';				
				while ( $query_shop->have_posts() ){
					$query_shop->the_post();
					global $product;
					
					$output .= '<li class="'. implode(' ',get_post_class()).'">';
						$output .= '<div class="item_wrapper">';
		
							$output .= '<div class="image_frame scale-with-grid product-loop-thumb" ontouchstart="this.classList.toggle(\'hover\');">';
								$output .= '<div class="image_wrapper">';
								
									$output .= '<a href="'. get_the_permalink() .'">';
										$output .= '<div class="mask"></div>';
										$output .= get_the_post_thumbnail( null, 'shop_catalog', array('class'=>'scale-with-grid' ) );
									$output .= '</a>';
									
									$output .= '<div class="image_links">';
										$output .= '<a class="link" href="'. get_the_permalink() .'"><i class="icon-link"></i></a>';
									$output .= '</div>';
									
								$output .= '</div>';
								if ($product->is_on_sale()) $output .= '<span class="onsale"><i class="icon-star"></i></span>';
							$output .= '</div>';
							
							$output .= '<div class="desc">';
								$output .= '<h4><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></h4>';
								if ( $price_html = $product->get_price_html() ) $output .= '<span class="price">'. $price_html .'</span>';
							$output .= '</div>';
					
						$output .= '</div>';
					$output .= '</li>';
				}
				wp_reset_postdata();					
			$output .= '</ul>';
			
			$output .= '<div class="slider_pagination"></div>';

		$output .= '</div>'."\n";
		
		wp_reset_postdata();

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Contact Box [contact_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_contact_box' ) )
{
	function sc_contact_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'			=> '',
			'address' 		=> '',
			'telephone'		=> '',
			'email' 		=> '',
			'www' 			=> '',
			'image' 		=> '',
			'animate' 		=> '',
		), $attr));
		
		// background
		if( $image ) $image = 'style="background-image:url('. $image .');"';
		
		$output = '';
		if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			$output .= '<div class="get_in_touch" '. $image .'>';

				if( $title ) $output .= '<h3>'. $title .'</h3>';
				$output .= '<div class="get_in_touch_wrapper">';
					$output .= '<ul>';
						if( $address ){
							$output .= '<li class="address">';
								$output .= '<span class="icon"><i class="icon-location"></i></span>';
								$output .= '<span class="address_wrapper">'. $address .'</span>';
							$output .= '</li>';
						}
						if( $telephone ){
							$output .= '<li class="phone">';
								$output .= '<span class="icon"><i class="icon-phone"></i></span>';
								$output .= '<p><a href="tel:'. $telephone .'">'. $telephone .'</a></p>';
							$output .= '</li>';
						}
						if( $email ){
							$output .= '<li class="mail">';
								$output .= '<span class="icon"><i class="icon-mail"></i></span>';
								$output .= '<p><a href="mailto:'. $email .'">'. $email .'</a></p>';
							$output .= '</li>';
						}
						if( $www ){
							$output .= '<li class="www">';
								$output .= '<span class="icon"><i class="icon-link"></i></span>';
								$output .= '<p><a target="_blank" href="http'. mfn_ssl() .'://'. $www .'">'. $www .'</a></p>';
							$output .= '</li>';
						}
					$output .= '</ul>';
				$output .= '</div>';				
			
			$output .= '</div>'."\n";
		if( $animate ) $output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Popup [popup][/popup]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_popup' ) )
{
	function sc_popup( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'			=> '',
			'padding'		=> '',
			'button' 		=> '',
			'uid'			=> 'popup-'. uniqid(),
		), $attr));

		// padding
		if( $padding ){
			$padding = 'style="padding:'. $padding .'px;"';
		} else {
			$padding = false;
		}
		
		$output = '';

		if( $button ){
			$output .= '<a href="#'. $uid .'" rel="prettyPhoto" class="popup-link button button_js"><span class="button_label">'. $title .'</span></a>';
		} else {
			$output .= '<a href="#'. $uid .'" rel="prettyPhoto" class="popup-link">'. $title .'</a>';
		}
		
		$output .= '<div id="'. $uid .'" class="popup-content">';
			$output .= '<div class="popup-inner" '. $padding .'>'. do_shortcode($content) .'</div>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Info Box [info_box]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_info_box' ) )
{
	function sc_info_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'			=> '',
			'image' 		=> '',
			'animate' 		=> '',
		), $attr));
		
		// background
		if( $image ) $image = 'style="background-image:url('. $image .');"';
		
		$output = '';
		if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			$output .= '<div class="infobox" '. $image .'>';

				if( $title ) $output .= '<h3>'. $title .'</h3>';
				$output .= '<div class="infobox_wrapper">';
					$output .= do_shortcode($content);
				$output .= '</div>';
					
			$output .= '</div>'."\n";
		if( $animate ) $output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Opening hours [opening_hours]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_opening_hours' ) )
{
	function sc_opening_hours( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'			=> '',
			'image' 		=> '',
			'animate' 		=> '',
		), $attr));
		
		// background
		if( $image ) $image = 'style="background-image:url('. $image .');"';
		
		$output = '';
		if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			$output .= '<div class="opening_hours" '. $image .'>';
			
		
				if( $title ) $output .= '<h3>'. $title .'</h3>';
				$output .= '<div class="opening_hours_wrapper">';
					$output .= do_shortcode($content);
				$output .= '</div>';

			$output .= '</div>'."\n";
		if( $animate ) $output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Divider [divider]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_divider' ) )
{
	function sc_divider( $attr, $content = null )
	{
	    extract(shortcode_atts(array(
		    'height' 		=> 0,
		    'style' 		=> '',		// default, dots, zigzag
		    'line'			=> '',		// default, narrow, wide, 0 = no_line
		    'themecolor'	=> '',
	    ), $attr));
	    
	    // classes
	    $class = '';
	    if( $themecolor ) 	$class .= ' hr_color';
	    
		// height
		if( $height ){
			$inlinecss = 'style="margin: 0 auto '. intval( $height ) .'px;"';
		} else {
			$inlinecss = '';
		}
	    
	    switch( $style ){
	    	case 'dots':
	    		$output = '<div class="hr_dots" '. $inlinecss .'><span></span><span></span><span></span></div>'."\n";
	    		break;
	    	case 'zigzag':
	    		$output = '<div class="hr_zigzag" '. $inlinecss .'><i class="icon-down-open"></i><i class="icon-down-open"></i><i class="icon-down-open"></i></div>'."\n";
	    		break;
	    	default:
	    		if( $line == 'narrow' ){
	    			$output = '<hr class="hr_narrow '. $class .'" '. $inlinecss .'/>'."\n";
	    		} elseif( $line == 'wide' ) {
	    			$output = '<div class="hr_wide '. $class .'" '. $inlinecss .'><hr /></div>'."\n";
	    		} elseif( $line ) {
	    			$output = '<hr class="'. $class .'" '. $inlinecss .'/>'."\n";
	    		} else {
	    			$output = '<hr class="no_line" '. $inlinecss .'/>'."\n";
	    		}
	    }
	    
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Google Font [google_font]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_google_font' ) )
{
	function sc_google_font( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'font' 		=> '',
			'subset' 	=> '',
			'size' 		=> '25',
		), $attr));
		
		$font_slug	= str_replace(' ', '+', $font);
		
		// subset
		if( $subset ){
			$subset	= '&amp;subset='. str_replace(' ', '', $subset);
		} else {
			$subset = false;	
		}	
	
		$output = '<link type="text/css" rel="stylesheet" href="http'. mfn_ssl() .'://fonts.googleapis.com/css?family='. $font_slug .':400'. $subset .'">'."\n";
		$output .= '<div class="google_font" style="font-family:\''. $font .'\'; font-size:'. $size .'px; line-height:'. $size .'px;">'. do_shortcode($content) .'</div>'."\n";
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Sidebar Widget [sidebar_widget]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_sidebar_widget' ) )
{
	function sc_sidebar_widget( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'sidebar' 		=> '',
		), $attr));
		
		$output = '';
		
		if( $sidebar !== '' && $sidebar !== false ){
			
			$sidebars = mfn_opts_get( 'sidebars' );
			$sidebar = $sidebars[$sidebar];
			
			ob_start();
			dynamic_sidebar( $sidebar );
			$output = ob_get_clean();
		}
		
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Pricing Item [pricing_item] [/pricing_item]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_pricing_item' ) )
{
	function sc_pricing_item( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image'			=> '',
			'title'			=> '',
			'currency' 		=> '',
			'price' 		=> '',
			'period' 		=> '',
			'subtitle' 		=> '',
			'link_title'	=> '',
			'link' 			=> '',
			'featured' 		=> '',
			'style' 		=> 'box',
			'animate' 		=> '',
		), $attr));
		
		// classes
		$classes = '';
		if( $featured ) $classes .= ' pricing-box-featured';
		if( $style ) 	$classes .= ' pricing-box-'. $style;
	
		$output = '<div class="pricing-box '. $classes .'">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			
				$output .= '<div class="plan-header">';
				
					if( $image ){
						$output .= '<div class="image">';
							$output .= '<img src="'. $image .'" alt="'. $title .'" />';
						$output .= '</div>';
					}
				
					if( $title ) $output .= '<h2>'. $title .'</h2>';	
					if( $price ){ 
						$output .= '<div class="price">';
							$output .= '<sup class="currency">'. $currency .'</sup>';
							$output .= '<span>'. $price .'</span>';
							$output .= '<sup class="period">'. $period .'</sup>';
						$output .= '</div>';
						$output .= '<hr class="hr_color" />';
						if( $subtitle ) $output .= '<p class="subtitle"><big>'. $subtitle .'</big></p>';
					}
				$output .= '</div>';
				
				if( $content ){
					$output .= '<div class="plan-inside">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				}
				
				if( $link ){
					$output .= '<div class="plan-footer">';
						$output .= '<a href="'. $link .'" class="button  button_left button_theme button_js"><span class="button_icon"><i class="icon-basket"></i></span><span class="button_label">'. $link_title .'</span></a>';
					$output .= '</div>';
				}
			
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";
			
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Call to Action [call_to_action] [/call_to_action]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_call_to_action' ) )
{
	function sc_call_to_action( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' 		=> '',
			'icon' 			=> '',
			'link' 			=> '',
			'button_title'	=> '',
			'class' 		=> '',
			'target' 		=> '',
			'animate' 		=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		$output = '<div class="call_to_action">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			
				$output .= '<div class="call_left">';
					$output .= '<h3>'. $title .'</h3>';
				$output .= '</div>';
				
				$output .= '<div class="call_center">';
				
					if( $button_title ){
						// Button
						if( $link ) $output .= '<a href="'. $link .'" class="button button_js '. $class .'" '. $target .'>';
							if( $icon ) $output .= '<span class="button_icon"><i class="'. $icon .'"></i></span>';
							$output .= '<span class="button_label">'. $button_title .'</span>';
						if( $link ) $output .= '</a>';
					} else {
						// Big Icon Link
						if( $link ) $output .= '<a href="'. $link .'" class="'. $class .'" '. $target .'>';
							$output .= '<span class="icon_wrapper"><i class="'. $icon .'"></i></span>';
						if( $link ) $output .= '</a>';
					}

				$output .= '</div>';
				
				$output .= '<div class="call_right">';
					$output .= '<div class="desc">'. do_shortcode($content) .'</div>';
				$output .= '</div>';
			
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Chart [chart]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_chart' ) )
{
	function sc_chart( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'percent' 		=> '',
			'label' 		=> '',
			'icon'	 		=> '',
			'image'	 		=> '',
			'title' 		=> '',
		), $attr));
		
		// color
		if( $_GET && key_exists('mfn-c', $_GET) ){
			$color = '#D69942';
		} else {
			$color =  mfn_opts_get( 'color-counter', '#2991D6' );
		}
		
		$output = '<div class="chart_box">';
			$output .= '<div class="chart" data-percent="'. intval($percent) .'" data-color="'.  $color .'">';
				if( $image ){
					$output .= '<div class="image"><img src="'. $image .'" alt="'. $percent .'" class="scale-with-grid" /></div>';
				} elseif( $icon ){
					$output .= '<div class="icon"><i class="'. $icon .'"></i></div>';
				} else {
					$output .= '<div class="num">'. $label .'</div>';
				}
			$output .= '</div>';
			$output .= '<p><big>'. $title .'</big></p>';
		$output .= '</div>'."\n";
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Countdown [countdown]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_countdown' ) )
{
	function sc_countdown( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'date' 			=> '12/30/2014 12:00:00',
			'timezone'	 	=> '0',
		), $attr));
		
		$output = '<div class="downcount" data-date="'. $date .'" data-offset="'. $timezone .'">';
		
			$output .= '<div class="column one-fourth column_quick_fact">';
				$output .= '<div class="quick_fact">';
					$output .= '<div data-anim-type="zoomIn" class="animate zoomIn">';
						$output .= '<div class="number days">00</div>';
						$output .= '<h3 class="title">'. __('days','betheme') .'</h3>';
						$output .= '<hr class="hr_narrow">';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			$output .= '<div class="column one-fourth column_quick_fact">';
				$output .= '<div class="quick_fact">';
					$output .= '<div data-anim-type="zoomIn" class="animate zoomIn">';
						$output .= '<div class="number hours">00</div>';
						$output .= '<h3 class="title">'. __('hours','betheme') .'</h3>';
						$output .= '<hr class="hr_narrow">';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			$output .= '<div class="column one-fourth column_quick_fact">';
				$output .= '<div class="quick_fact">';
					$output .= '<div data-anim-type="zoomIn" class="animate zoomIn">';
						$output .= '<div class="number minutes">00</div>';
						$output .= '<h3 class="title">'. __('minutes','betheme') .'</h3>';
						$output .= '<hr class="hr_narrow">';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			$output .= '<div class="column one-fourth column_quick_fact">';
				$output .= '<div class="quick_fact">';
					$output .= '<div data-anim-type="zoomIn" class="animate zoomIn">';
						$output .= '<div class="number seconds">00</div>';
						$output .= '<h3 class="title">'. __('seconds','betheme') .'</h3>';
						$output .= '<hr class="hr_narrow">';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Counter [counter]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_counter' ) )
{
	function sc_counter( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'icon' 			=> '',
			'color' 		=> '',
			'image' 		=> '',
			'number' 		=> '',
			'title' 		=> '',
			'type'	 		=> 'vertical',
			'animate'	 	=> '',
		), $attr));
		
		// color
		if( $color ){
			$color = 'style="color:'. $color .';"';
		} else {
			$color = false;
		}
		
		$output = '<div class="counter animate-math counter_'. $type .'">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			
				$output .= '<div class="icon_wrapper">';
					if( $image ){
						$output .= '<img src="'. $image .'" alt="'. $title .'" />';
					} elseif( $icon ){
						$output .= '<i class="'. $icon .'" '. $color .'></i>';
					}
				$output .= '</div>';
				
				$output .= '<div class="desc_wrapper">';
					if( $number ) $output .= '<div class="number" data-to="'. $number .'">0</div>';
					if( $title )  $output .= '<p class="title">'. $title .'</p>';
				$output .= '</div>';
			
			if( $animate ) $output .= '</div>'."\n";
		$output .= '</div>'."\n";
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Icon [icon]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_icon' ) )
{
	function sc_icon( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'type' => '',
		), $attr));
		
		$output = '<i class="'. $type .'"></i>';
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Icon Block [icon_block]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_icon_block' ) )
{
	function sc_icon_block( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'icon'	=> '',
			'align'	=> '',
			'color'	=> '',
			'size'	=> 25,
		), $attr));

		// classes
		$class = '';
		if( $align ) $class .= ' icon_'. $align;
		if( $color ){
			$color = ' color:'. $color .';';
		} else {
			$class .= ' themecolor';
		}
			
		$output = '<span class="single_icon '. $class .'">';
			$output .= '<i style="font-size: '. $size .'px; line-height: '. $size .'px; '. $color .'" class="'. $icon .'"></i>';
		$output .= '</span>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Image [image]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_image' ) )
{
	function sc_image( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'src'			=> '',
			'border'			=> '',
			'alt'			=> '',
			'caption'		=> '',
			'margin'		=> '',
			'align'			=> 'none',
			'link'			=> '',
			'link_image'	=> '',
			'target'		=> '',
			'animate'		=> '',
		), $attr));
		
		// align
		if( $align ) $align = ' align'. $align;
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		// margin
		if( $margin ){
			$margin = 'style="margin-top:'. intval( $margin ) .'px"';
		} else {
			$margin = false;
		}
		
		// border
		if( $border ){
			$border = ' has_border';
		} else {
			$border = ' no_border';
		}

		// hoover icon
		if( $link_image ){
			$class	= 'zoom prettyphoto';
			$target = false;
			$icon	= 'icon-search';
		} else {
			$class 	= 'link';
			$icon	= 'icon-link';
		}
		
		// link
		if( $link_image ) $link = $link_image;
		
		$output = '';
		if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
		
			if( $link ) {

				$output .= '<div class="image_frame scale-with-grid'. $border . $align .'" '. $margin .'>';
					$output .= '<div class="image_wrapper">';
						$output .= '<a href="'. $link .'" class="'. $class .'" '. $target .'>';
							$output .= '<div class="mask"></div>';
							$output .= '<img class="scale-with-grid" src="'. $src .'" alt="'. $alt .'" />';
						$output .= '</a>';
						$output .= '<div class="image_links">';
							$output .= '<a href="'. $link .'" class="'. $class .'" '. $target .'><i class="'. $icon .'"></i></a>';
						$output .= '</div>';
					$output .= '</div>';
					if( $caption ) $output .= '<p class="wp-caption-text">'. $caption .'</p>';					
				$output .= '</div>'."\n";

			} else {
				
				$output .= '<div class="image_frame no_link scale-with-grid'. $border . $align .'" '. $margin .'>';
					$output .= '<div class="image_wrapper">';
						$output .= '<img class="scale-with-grid" src="'. $src .'" alt="'. $alt .'" />';
					$output .= '</div>';
					if( $caption ) $output .= '<p class="wp-caption-text">'. $caption .'</p>';
				$output .= '</div>'."\n";
				
			}
			
		if( $animate ) $output .= '</div>'."\n";
	
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Quick Fact [quick_fact]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_quick_fact' ) )
{
	function sc_quick_fact( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'heading' 	=> '',
			'number' 	=> '',
			'title' 	=> '',
			'animate' 	=> '',
		), $attr));

		$output = '<div class="quick_fact animate-math">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			
				if( $heading ) $output .= '<h4 class="title">'. $heading .'</h4>';
				if( $number ) $output .= '<div class="number" data-to="'. $number .'">0</div>';
				if( $title ) $output .= '<h3 class="title">'. $title .'</h3>';
				$output .= '<hr class="hr_narrow" />';
				$output .= '<div class="desc">'. do_shortcode($content) .'</div>';
			
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Button [button]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_button' ) )
{
	function sc_button( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' 		=> 'Read more',
			'icon' 			=> '',
			'icon_position' => 'left',
			'link' 			=> '',
			'target' 		=> '',
			'color' 		=> '',
			'font_color'	=> '',
			'large' 		=> '',
			'class' 		=> '',
			'download' 		=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		// download
		if( $download ){
			$download = 'download="'. $download .'"';
		} else {
			$download = false;
		}
		
		// icon_position
		if( $icon_position != 'left' ){
			$icon_position = 'right';
		}
		
		// class
		if( $icon )		$class .= ' button_'. $icon_position;
		if( $large ) 	$class .= ' button_large';
		
		// custom color
		$style = '';
		if( $color ){
			if( strpos($color, '#') === 0 ){
				$style .= ' background-color:'. $color .' !important;';
			} else {
				$class .= ' button_'. $color;
			}
		}
		if( $font_color ){
			$style .= ' color:'. $font_color .';';
		}
		if( $style ){
			$style = ' style="'. $style .'"';
		}
		
		$output = '<a class="button '. $class .' button_js" href="'. $link .'" '. $target .' '. $style .' '. $download .'>';
			if( $icon )	$output .= '<span class="button_icon"><i class="'. $icon .'"></i></span>';
			if( $title ) $output .= '<span class="button_label">'. $title .'</span>';
		$output .= '</a>'."\n";
	
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Icon Bar [icon_bar]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_icon_bar' ) )
{
	function sc_icon_bar( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'icon' 			=> 'icon-lamp',
			'link' 			=> '',
			'target' 		=> '',
			'size' 			=> '',
			'social' 		=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		// class
		$class = '';
		if( $social ) 	$class .= ' icon_bar_'. $social;
		if( $size ) 	$class .= ' icon_bar_'. $size;
		
		$output = '<a href="'. $link .'" class="icon_bar '. $class .'" '. $target .'>';
			$output .= '<span class="t"><i class="'. $icon .'"></i>';
			$output .= '</span><span class="b"><i class="'. $icon .'"></i></span>';
		$output .= '</a>'."\n";
	
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Alert [alert] [/alert]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_alert' ) )
{
	function sc_alert( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'style'		=> 'warning',
		), $attr));

		switch( $style ){
			case 'error':
				$icon = 'icon-alert';
				break;
			case 'info':
				$icon = 'icon-help';
				break;
			case 'success':
				$icon = 'icon-check';
				break;
			default:
				$icon = 'icon-lamp';
				break;
		}
			
		$output  = '<div class="alert alert_'. $style .'">';
			$output  .= '<div class="alert_icon">';
				$output .= '<i class="'. $icon .'"></i>';
			$output .= '</div>';
			$output .= '<div class="alert_wrapper">';
				$output .= do_shortcode( $content );
			$output .= '</div>';
			$output .= '<a href="#" class="close"><i class="icon-cancel"></i></a>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Idea [idea] [/idea]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_idea' ) )
{
	function sc_idea( $attr, $content = null )
	{			
		$output  = '<div class="idea_box">';
			$output  .= '<div class="icon"><i class="icon-lamp"></i></div>';
			$output  .= '<div class="desc">'. do_shortcode( $content ) .'</div>';
		$output .= '</div>'."\n";		

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Dropcap [dropcap] [/dropcap]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_dropcap' ) )
{
	function sc_dropcap( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'background' 	=> '',
			'color' 		=> '',
			'circle' 		=> '',
		), $attr));

		// circle
		if( $circle ){
			$class = ' dropcap_circle';
		} else {
			$class = false;
		}

		$style = '';
		if( $background ) $style .= 'background-color:'. $background .';';
		if( $color ) $style .= ' color:'. $color .';';
		if( $style ) $style = 'style="'. $style .'"';
			
		$output  = '<span class="dropcap'. $class .'" '. $style .'>';
			$output .= do_shortcode( $content );
		$output .= '</span>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Highlight [highlight] [/highlight]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_highlight' ) )
{
	function sc_highlight( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'background' 	=> '',
			'color' 		=> '',
		), $attr));

		// style
		$style = '';
		if( $background ) $style .= 'background-color:'. $background .';';
		if( $color ) $style .= ' color:'. $color .';';
		if( $style ) $style = 'style="'. $style .'"';
							
		$output  = '<span class="highlight" '. $style .'>';
			$output .= do_shortcode($content);
		$output .= '</span>'."\n";
	
	    return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Tooltip [tooltip] [/tooltip]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_tooltip' ) )
{
	function sc_tooltip( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'hint' 			=> '',
		), $attr));

		$output = '';
		if( $hint ){
			$output .= '<span class="tooltip" data-tooltip="'. $hint .'" ontouchstart="this.classList.toggle(\'hover\');">';
				$output .= do_shortcode( $content );
			$output .= '</span>'."\n";
		}

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Content Link [content_link]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_content_link' ) )
{
	function sc_content_link( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' 	=> '',
			'icon' 		=> '',
			'link' 		=> '',
			'target' 	=> '',
			'class' 	=> '',
			'download' 	=> '',
		), $attr));

		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		// download
		if( $download ){
			$download = 'download="'. $download .'"';
		} else {
			$download = false;
		}

		$output = '<a class="content_link '. $class .'" href="'. $link .'" '. $target .' '. $download .'>';
			if( $icon )	$output .= '<span class="icon"><i class="'. $icon .'"></i></span>';
			if( $title ) $output .= '<span class="title">'. $title .'</span>';
		$output .= '</a>';
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Blockquote [blockquote] [/blockquote]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_blockquote' ) )
{
	function sc_blockquote( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'author'	=> '',
			'link'		=> '',
			'target'	=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		$output = '<div class="blockquote">';
			$output .= '<blockquote>'. do_shortcode( $content ) .'</blockquote>';
			if( $author ){
				$output .= '<p class="author">';
					$output .= '<i class="icon-user"></i>';
					if( $link ){ 
						$output .= '<a href="'. $link .'" '. $target .'>'. $author .'</a>';
					} else {
						$output .= '<span>'. $author .'</span>';
					}
				$output .= '</p>';
			}
		$output .= '</div>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Clients [clients]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_clients' ) )
{
	function sc_clients( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'in_row' 	=> 6,
			'category' 	=> '',
			'style' 	=> '',
		), $attr));
		
		// style
		if( $style ){
			$style = 'clients_tiles';
		} else {
			$style = false;
		}
	
		if( ! intval( $in_row ) ) $in_row = 6;
	
		$args = array(
			'post_type' 		=> 'client',
			'posts_per_page'	=> -1,
			'orderby' 			=> 'menu_order',
			'order' 			=> 'ASC',
		);
		if( $category ) $args['client-types'] = $category;
	
		$clients_query = new WP_Query();
		$clients_query->query( $args );
	
		$output  = '<ul class="clients '. $style .'">';
		if ($clients_query->have_posts())
		{
			$i = 1;
			$width = round( (100 / $in_row), 3 );

			while ($clients_query->have_posts())
			{

				$clients_query->the_post();
				$output .= '<li style="width:'. $width .'%">';
					$output .= '<div class="client_wrapper">';
						$link = get_post_meta(get_the_ID(), 'mfn-post-link', true);
						if( $link ) $output .= '<a target="_blank" href="'. $link .'" title="'. the_title(false, false, false) .'">';
							$output .= get_the_post_thumbnail( null, 'clients-slider', array('class'=>'scale-with-grid') );
						if( $link ) $output .= '</a>';
					$output .= '</div>';
				$output .= '</li>';
	
				$i++;
			}
		}
		wp_reset_query();
		$output .= '</ul>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Clients slider [clients_slider]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_clients_slider' ) )
{
	function sc_clients_slider( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' 	=> '',
			'category' 	=> '',
		), $attr));
		
		$args = array(
			'post_type' 		=> 'client',
			'posts_per_page'	=> -1,
			'orderby' 			=> 'menu_order',
			'order' 			=> 'ASC',
		);
		if( $category ) $args['client-types'] = $category;
	
		$clients_query = new WP_Query();
		$clients_query->query( $args );

		if ($clients_query->have_posts())
		{
			$output  = '<div class="clients_slider">';
				
				$output .= '<div class="clients_slider_header">';
					if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
					$output .= '<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>';
					$output .= '<a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>';
				$output .= '</div>';
			
				$output .= '<ul class="clients clients_slider_ul">';
				while ($clients_query->have_posts())
				{
					$clients_query->the_post();
			
					$output .= '<li>';
						$output .= '<div class="client_wrapper">';
							$link = get_post_meta(get_the_ID(), 'mfn-post-link', true);
							if( $link ) $output .= '<a target="_blank" href="'. $link .'" title="'. the_title(false, false, false) .'">';
								$output .= get_the_post_thumbnail( null, 'clients-slider', array('class'=>'scale-with-grid') );
							if( $link ) $output .= '</a>';
						$output .= '</div>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				
			$output .= '</div>'."\n";
		}
		wp_reset_query();
		$output .= '</ul>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Fancy Heading [fancy_heading] [/fancy_heading]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'fancy_heading' ) )
{
	function sc_fancy_heading( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'		=> '',
			'h1'		=> '',
			'icon' 		=> '',
			'slogan' 	=> '',
			'style' 	=> 'icon',	// icon, line, arrows
			'animate' 	=> '',
		), $attr));
	
		$output = '<div class="fancy_heading fancy_heading_'. $style.'">';	
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				
				if( $icon && $style == 'icon' ) $output .= '<span class="icon_top"><i class="'. $icon .'"></i></span>';
				if( $slogan && $style == 'line' ) $output .= '<span class="slogan">'. $slogan .'</span>';
				if( $style =='arrows' ) $title = '<i class="icon-right-dir"></i>'. $title .'<i class="icon-left-dir"></i>';
				if( $title ){
					if( $h1 ){
						$output .= '<h1 class="title">'. $title .'</h1>';
					} else {
						$output .= '<h2 class="title">'. $title .'</h2>';
					}
				}
				if( $content ) $output .= '<div class="inside">'. do_shortcode( $content ) .'</div>';
			
			if( $animate ) $output .= '</div>';
		$output .= '</div>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Icon Box [icon_box] [/icon_box]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_icon_box' ) )
{
	function sc_icon_box( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'			=> '',
			'icon'			=> '',
			'image'			=> '',
			'icon_position'	=> 'top',
			'border'		=> '',
			'link'			=> '',
			'target'		=> '',
			'animate'		=> '',
			'class'			=> '',
		), $attr));
	
		// border
		if( $border ){
			$border = 'has_border';
		} else {
			$border = 'no_border';
		}
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		$output = '';
		if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			$output .= '<div class="icon_box icon_position_'. $icon_position .' '. $border .'">';
				if( $link ) $output .= '<a class="'. $class .'" href="'. $link .'" '. $target .'>';
				
					if( $image ){
						$output .= '<div class="image_wrapper">';
							$output .= '<img src="'. $image .'" alt="'. $title .'" class="scale-with-grid" />';
						$output .= '</div>';
					} else {
						$output .= '<div class="icon_wrapper">';
							$output .= '<div class="icon">';
								$output .= '<i class="'. $icon .'"></i>';
							$output .= '</div>';
						$output .= '</div>';
					}		
					
					$output .= '<div class="desc_wrapper">';
						if( $title ) $output .= '<h4>'. $title .'</h4>';
						if( $content )$output .= '<div class="desc">'. do_shortcode($content) .'</div>';
					$output .= '</div>';
					
				if( $link ) $output .= '</a>';
			$output .= '</div>'."\n";
		if( $animate ) $output .= '</div>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Our Team [our_team]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_our_team' ) )
{
	function sc_our_team( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'heading' 		=> '',	
			'image' 		=> '',	
			'title' 		=> '',
			'subtitle'		=> '',
			'email' 		=> '',
			'phone' 		=> '',
			'facebook' 		=> '',
			'twitter'		=> '',
			'linkedin'		=> '',
			'style' 		=> 'vertical',
			'animate' 		=> '',
		), $attr));
		
		$output = '<div class="team team_'. $style .'">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
		
				if( $heading ) $output .= '<h4 class="title">'. $heading .'</h4>';
			
				$output  .= '<div class="image_frame no_link scale-with-grid">';
					$output .= '<div class="image_wrapper">';
						$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
					$output .= '</div>';
				$output .= '</div>';
				
				$output .= '<div class="desc_wrapper">';
					if( $title ) $output .= '<h4>'. $title .'</h4>';
					if( $subtitle ) $output .= '<p class="subtitle">'. $subtitle .'</p>';
					if( $phone ) 	$output .= '<p class="phone"><i class="icon-phone"></i> <a href="tel:'. $phone .'">'. $phone .'</a></p>';
					$output .= '<hr class="hr_color" />';
					
					$output .= '<div class="desc">'. do_shortcode($content) .'</div>';
					
					if( $email || $phone || $facebook || $twitter || $linkedin ){
						$output .= '<div class="links">';
							if( $email ) 	$output .= '<a href="mailto:'. $email .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-mail"></i></span><span class="b"><i class="icon-mail"></i></span></a>';
							if( $facebook ) $output .= '<a target="_blank" href="'. $facebook .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a>';
							if( $twitter ) 	$output .= '<a target="_blank" href="'. $twitter .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a>';
							if( $linkedin ) $output .= '<a target="_blank" href="'. $linkedin .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-linkedin"></i></span><span class="b"><i class="icon-linkedin"></i></span></a>';
						$output .= '</div>';
					}
				$output .= '</div>';

			if( $animate )  $output .= '</div>';	
		$output .= '</div>'."\n";	
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Our Team List [our_team_list]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_our_team_list' ) )
{
	function sc_our_team_list( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'image' 		=> '',	
			'title' 		=> '',
			'subtitle'		=> '',
			'blockquote'	=> '',
			'email' 		=> '',
			'phone' 		=> '',
			'facebook' 		=> '',
			'twitter'		=> '',
			'linkedin'		=> '',
		), $attr));
		
		$output = '<div class="team team_list">';
		
			$output .= '<div class="column one-fourth">';
				$output .= '<div class="image_frame no_link scale-with-grid">';
					$output .= '<div class="image_wrapper">';
						$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			$output .= '<div class="column one-second">';
				$output .= '<div class="desc_wrapper">';
					if( $title ) $output .= '<h4>'. $title .'</h4>';
					if( $subtitle ) $output .= '<p class="subtitle">'. $subtitle .'</p>';
					if( $phone ) 	$output .= '<p class="phone"><i class="icon-phone"></i> <a href="tel:'. $phone .'">'. $phone .'</a></p>';
					$output .= '<hr class="hr_color" />';
					
					$output .= '<div class="desc">'. do_shortcode($content) .'</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			$output .= '<div class="column one-fourth">';
				$output .= '<div class="bq_wrapper">';
					if( $blockquote ) $output .= '<blockquote>'. $blockquote .'</blockquote>';
					
					if( $email || $phone || $facebook || $twitter || $linkedin ){
						$output .= '<div class="links">';
							if( $email ) 	$output .= '<a href="mailto:'. $email .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-mail"></i></span><span class="b"><i class="icon-mail"></i></span></a>';
							if( $facebook ) $output .= '<a target="_blank" href="'. $facebook .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a>';
							if( $twitter ) 	$output .= '<a target="_blank" href="'. $twitter .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a>';
							if( $linkedin ) $output .= '<a target="_blank" href="'. $linkedin .'" class="icon_bar icon_bar_small"><span class="t"><i class="icon-linkedin"></i></span><span class="b"><i class="icon-linkedin"></i></span></a>';
						$output .= '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';

		$output .= '</div>'."\n";	
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Portfolio [portfolio]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_portfolio' ) )
{
	function sc_portfolio( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'count' 			=> '2',
			'category' 			=> '',
			'category_multi'	=> '',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
			'style'				=> 'one',
			'pagination'		=> '',
		), $attr));
		
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
		$args = array(
			'post_type' 			=> 'portfolio',
			'posts_per_page' 		=> intval($count),
			'paged' 				=> $paged,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts' 	=> 1,
		);
		
		// categories
		if( $category_multi ){
			$args['portfolio-types'] = trim( $category_multi );
		} elseif( $category ){
			$args['portfolio-types'] = $category;
		}

		$query_portfolio = new WP_Query( $args );
		
		$output = '<div class="portfolio_wrapper isotope_wrapper">';
		
			$output .= '<ul class="portfolio_group isotope '. $style .'">';
				$output .= mfn_content_portfolio( $query_portfolio, $style );
			$output .= '</ul>';
			
			if( $pagination ) $output .= mfn_pagination( $query_portfolio );
		
		$output .= '</div>'."\n";
		
		wp_reset_postdata();

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Portfolio Grid [portfolio_grid]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_portfolio_grid' ) )
{
	function sc_portfolio_grid( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'count' 			=> '4',
			'category' 			=> '',
			'category_multi' 	=> '',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
		), $attr));

		$args = array(
			'post_type' 			=> 'portfolio',
			'posts_per_page' 		=> intval($count),
			'paged' 				=> -1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts' 	=> 1,
		);
		
		// categories
		if( $category_multi ){
			$args['portfolio-types'] = trim( $category_multi );
		} elseif( $category ){
			$args['portfolio-types'] = $category;
		}

		$query = new WP_Query();
		$query->query( $args );
		$post_count = $query->post_count;

		if ($query->have_posts())
		{
			$output  = '<ul class="portfolio_grid">';
				while ($query->have_posts())
				{
					$query->the_post();
	
					$output .= '<li>';
						$output .= '<div class="image_frame scale-with-grid">';
							$output .= '<div class="image_wrapper">';
								$output .= mfn_post_thumbnail( get_the_ID(), 'portfolio' );
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</li>';
				}
			$output .= '</ul>'."\n";
		}
		wp_reset_query();

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Portfolio Slider [portfolio_slider]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_portfolio_slider' ) )
{
	function sc_portfolio_slider( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'count' 			=> '5',
			'category' 			=> '',
			'category_multi' 	=> '',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
		), $attr));

		$args = array(
			'post_type' 			=> 'portfolio',
			'posts_per_page' 		=> intval($count),
			'paged' 				=> -1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts' 	=> 1,
		);
		
		// categories
		if( $category_multi ){
			$args['portfolio-types'] = trim( $category_multi );
		} elseif( $category ){
			$args['portfolio-types'] = $category;
		}

		$query = new WP_Query();
		$query->query( $args );

		if ($query->have_posts())
		{
			$output  = '<div class="portfolio_slider">';
				$output .= '<ul class="portfolio_slider_ul">';
				while ($query->have_posts())
				{
					$query->the_post();
	
					$output .= '<li>';
						$output .= '<div class="image_frame scale-with-grid">';
							$output .= '<div class="image_wrapper">';
								$output .= mfn_post_thumbnail( get_the_ID(), 'portfolio' );
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</li>';
				}
				$output .= '</ul>';
			$output .= '</div>'."\n";
		}
		wp_reset_query();

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Slides [slides]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_slider' ) )
{
	function sc_slider( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'category' 	=> '',
			'orderby' 	=> 'date',
			'order' 	=> 'DESC',
		), $attr));

		$args = array(
			'post_type' 			=> 'slide',
			'posts_per_page' 		=> 0,
			'paged' 				=> -1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts' 	=> 1,
		);
		if( $category ) $args['slide-types'] = $category;

		$query = new WP_Query();
		$query->query( $args );
		$post_count = $query->post_count;

		$output = '';
		if ($query->have_posts())
		{
			$output .= '<div class="content_slider">';
				$output .= '<ul class="content_slider_ul">';
					$i = 0;
					while ($query->have_posts())
					{
						$query->the_post();
						$i++;
		
						$output .= '<li class="content_slider_li_'. $i .'">';
							
							$link = get_post_meta(get_the_ID(), 'mfn-post-link', true);
							if( get_post_meta(get_the_ID(), 'mfn-post-target', true) ){
								$target = ' target="_blank"';
							} else {
								$target = false;
							}
								
							if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';
								$output .= get_the_post_thumbnail( null, 'slider-content', array('class'=>'scale-with-grid' ) );
							if( $link ) $output .= '</a>';
							
						$output .= '</li>';
					}
				$output .= '</ul>';
				
				$output .= '<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>';
				$output .= '<a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>';
				$output .= '<div class="slider_pagination"></div>';
				
			$output .= '</div>'."\n";
		}
		wp_reset_query();

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Offer [offer]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_offer' ) )
{
	function sc_offer( $attr = false, $content = null )
	{
		extract(shortcode_atts(array(
			'category' 	=> '',
		), $attr));
		
		$args = array(
			'post_type'				=> 'offer',
			'posts_per_page'		=> -1,
			'orderby'				=> 'menu_order',
			'order'					=> 'ASC',
			'ignore_sticky_posts'	=> 1,
		);
		if( $category ) $args['offer-types'] = $category;

		$offer_query = new WP_Query();
		$offer_query->query( $args );
		
		$output = '';
		if ($offer_query->have_posts())
		{
			$output .= '<div class="offer">';
				$output .= '<ul class="offer_ul">';

					while ($offer_query->have_posts())
					{
						$offer_query->the_post();
						$output .= '<li class="offer_li">';
						
							$link = get_post_meta( get_the_ID(), 'mfn-post-link', true);
							if( get_post_meta( get_the_ID(), 'mfn-post-target', true) ){
								$target = 'target="_blank"';
							} else {
								$target = false;
							}
						
							$output .= '<div class="image_wrapper">';
								$output .= get_the_post_thumbnail( get_the_ID(), 'full', array('class'=>'scale-with-grid' ) );
							$output .= '</div>';
							
							$output .= '<div class="desc_wrapper">';
							
								$output .= '<div class="title">';
									$output .= '<h3>'. get_the_title() .'</h3>';
									if( $link ) $output .= '<a href="'. $link .'" class="button button_js" '. $target .'><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">'. get_post_meta( get_the_ID(), 'mfn-post-link_title', true) .'</span></a>';
								$output .= '</div>';
								
								$output .= '<div class="desc">';
									$output .=  apply_filters( 'the_content', get_the_content() );
								$output .= '</div>';
								
							$output .= '</div>';
		
						$output .= '</li>';
					}

				$output .= '</ul>';
				$output .= '<a class="button button_large button_js slider_prev" href="#"><span class="button_icon"><i class="icon-up-open-big"></i></span></a>';
				$output .= '<div class="slider_pagination"><span class="current">1</span> / <span class="count">1</span></div>';
				$output .= '<a class="button button_large button_js slider_next" href="#"><span class="button_icon"><i class="icon-down-open-big"></i></span></a>';	
			$output .= '</div>'."\n";
		}
		wp_reset_query();
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Map [map]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_map' ) )
{
	function sc_map( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'lat' 		=> '',
			'lng' 		=> '',
			'zoom' 		=> 13,
			'height' 	=> 200,
			'title'		=> '',
			'uid' 		=> uniqid(),
		), $attr));
		
		wp_enqueue_script( 'google-maps', 'http'. mfn_ssl() .'://maps.google.com/maps/api/js?sensor=false', false, THEME_VERSION, true );
	
		$output = '<script>';
			//<![CDATA[
			$output .= 'function google_maps_'. $uid .'(){';
				$output .= 'var latlng = new google.maps.LatLng('. $lat .','. $lng .');';
				$output .= 'var myOptions = {';
					$output .= 'zoom				: '. intval($zoom) .',';
					$output .= 'center				: latlng,';
					$output .= 'zoomControl			: true,';
					$output .= 'mapTypeControl		: false,';
					$output .= 'streetViewControl	: false,';
					$output .= 'scrollwheel			: false,';       
					$output .= 'mapTypeId			: google.maps.MapTypeId.ROADMAP';
				$output .= '};';
		
				$output .= 'var map = new google.maps.Map(document.getElementById("google-map-area-'. $uid .'"), myOptions);';
// 				$output .= 'var image = "'. THEME_URI .'/images/pin.png";';
				$output .= 'var marker = new google.maps.Marker({';
					$output .= 'position			: latlng,';
// 					$output .= 'icon				: image,';
					$output .= 'map					: map';
				$output .= '});';
			
			$output .= '}';
		
			$output .= 'jQuery(document).ready(function($){';
				$output .= 'google_maps_'. $uid .'();';
			$output .= '});';	
			//]]>
		$output .= '</script>'."\n";
	
		$output .= '<div class="google-map-wrapper">';	
			
			if( $title || $content ){
				$output .= '<div class="google-map-contact-wrapper">';	
					$output .= '<div class="get_in_touch">';
						if( $title ) $output .= '<h3>'. $title .'</h3>';
						$output .= '<div class="get_in_touch_wrapper">';
							$output .= '<ul>';
								$output .= '<li class="address">';
									$output .= '<span class="icon"><i class="icon-location"></i></span>';
									$output .= '<span class="address_wrapper">'. do_shortcode($content) .'</span>';
								$output .= '</li>';
							$output .= '</ul>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			}	
			
			$output .= '<div class="google-map" id="google-map-area-'. $uid .'" style="width:100%; height:'. intval($height) .'px;">&nbsp;</div>';	
		
		$output .= '</div>'."\n";
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Tabs [tabs]
 * --------------------------------------------------------------------------- */
global $tabs_array, $tabs_count;
if( ! function_exists( 'sc_tabs' ) )
{
	function sc_tabs( $attr, $content = null )
	{
		global $tabs_array, $tabs_count;
		
		extract(shortcode_atts(array(
			'title'	=> '',
			'uid'	=> 'tab-'. uniqid(),
			'tabs'	=> '',
			'type'	=> '',
		), $attr));	
		do_shortcode( $content );
		
		// content builder
		if( $tabs ){
			$tabs_array = $tabs;
		}
		
		$output = '';
		if( is_array( $tabs_array ) )
		{
			if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
			$output .= '<div class="jq-tabs tabs_wrapper tabs_'. $type .'">';
				
				// contant
				$output .= '<ul>';
					$i = 1;
					$output_tabs = '';
					foreach( $tabs_array as $tab )
					{
						$output .= '<li><a href="#'. $uid .'-'. $i .'">'. $tab['title'] .'</a></li>';
						$output_tabs .= '<div id="'. $uid .'-'. $i .'">'. do_shortcode( $tab['content'] ) .'</div>';
						$i++;
					}
				$output .= '</ul>';
				
				// titles
				$output .= $output_tabs;
				
			$output .= '</div>';
			
			$tabs_array = '';
			$tabs_count = 0;	
		}
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * _Tab [tab] _private
 * --------------------------------------------------------------------------- */
$tabs_count = 0;
if( ! function_exists( 'sc_tab' ) )
{
	function sc_tab( $attr, $content = null )
	{
		global $tabs_array, $tabs_count;
		
		extract(shortcode_atts(array(
			'title' => 'Tab title',
		), $attr));
		
		$tabs_array[] = array(
			'title' => $title,
			'content' => do_shortcode( $content )
		);	
		$tabs_count++;
	
		return true;
	}
}


/* ---------------------------------------------------------------------------
 * Accordion [accordion]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_accordion' ) )
{
	function sc_accordion( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' 	=> '',
			'tabs' 		=> '',
			'open1st' 	=> '',
			'style' 	=> 'accordion',
		), $attr));
		
		// class
		$class = false;	
		if( $open1st ) $class = 'open1st';
		if( $style == 'toggle' ) $class = 'toggle';
		
		$output  = '';
		
		$output .= '<div class="accordion">';
			if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
			$output .= '<div class="mfn-acc accordion_wrapper '. $class .'">';
						
				if( is_array( $tabs ) ){
					// content builder
					foreach( $tabs as $tab ){
						$output .= '<div class="question">';
							$output .= '<div class="title"><i class="icon-plus acc-icon-plus"></i><i class="icon-minus acc-icon-minus"></i>'. $tab['title'] .'</div>';
							$output .= '<div class="answer">';
								$output .= do_shortcode($tab['content']);	
							$output .= '</div>';
						$output .= '</div>'."\n";
					}
				} else {
					// shortcode
					$output .= do_shortcode($content);	
				}
				
			$output .= '</div>';
		$output .= '</div>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * FAQ [faq]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_faq' ) )
{
	function sc_faq( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' 	=> '',
			'tabs' 		=> '',
			'open1st' 	=> '',
		), $attr));
		
		// class
		$class = false;	
		if( $open1st ) $class = 'open1st';
		
		$output  = '';
		
		$output .= '<div class="faq">';
			if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
			$output .= '<div class="mfn-acc faq_wrapper '. $class .'">';
						
				if( is_array( $tabs ) ){
					// content builder
					$i = 0;
					foreach( $tabs as $tab ){
						$i++;
						$output .= '<div class="question">';
							$output .= '<div class="title"><span class="num">'. $i .'</span><i class="icon-plus acc-icon-plus"></i><i class="icon-minus acc-icon-minus"></i>'. $tab['title'] .'</div>';
							$output .= '<div class="answer">';
								$output .= do_shortcode($tab['content']);	
							$output .= '</div>';
						$output .= '</div>'."\n";
					}
				} else {
					// shortcode
					$output .= do_shortcode($content);	
				}
				
			$output .= '</div>';
		$output .= '</div>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Progress Bars [progress_bars][bar][/progress_bars]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_progress_bars' ) )
{
	function sc_progress_bars( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' => '',
		), $attr));
	
		$output = '<div class="progress_bars">';
			if( $title ) $output .= '<h4 class="title">'. $title .'</h4>';
			$output .= '<ul class="bars_list">';
				$output .= do_shortcode( $content );
			$output .= '</ul>';
		$output .= '</div>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * _Bar [bar]
* --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_bar' ) )
{
	function sc_bar( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title' => '',
			'value' => 0,
		), $attr));
	
		$value = intval( $value );
	
		$output  = '<li>';
		
			$output .= '<h6>';
				$output .= $title;
				$output .= '<span class="label">'. $value .'%</span>';
			$output .= '</h6>';
			
			$output .= '<div class="bar">';
				$output .= '<span class="progress" style="width:'. $value .'%"></span>';
			$output .= '</div>';
			
		$output .= '</li>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Timeline [timeline] [/timeline]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_timeline' ) )
{
	function sc_timeline( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'count' => '',
			'tabs' => '',
		), $attr));
		
		$output  = '<ul class="timeline_items">';
		
		if( is_array( $tabs ) ){
			// content builder
			foreach( $tabs as $tab ){
				$output .= '<li>';
					$output .= '<h3>'. $tab['title'] .'</h3>';
					if( $tab['content'] ){
						$output .= '<div class="desc">';
							$output .= do_shortcode($tab['content']);
						$output .= '</div>';
					}
				$output .= '</li>';
			}
		} else {
			// shortcode
			$output .= do_shortcode($content);
		}
		
		$output .= '</ul>'."\n";
	
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Testimonials [testimonials]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_testimonials' ) )
{
	function sc_testimonials( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'category' 	=> '',
			'orderby' 	=> 'menu_order',
			'order' 	=> 'ASC',
		), $attr));
		
		$args = array(
			'post_type' 			=> 'testimonial',
			'posts_per_page' 		=> -1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts' 	=>1,
		);
		if( $category ) $args['testimonial-types'] = $category;
		
		$query_tm = new WP_Query();
		$query_tm->query( $args );
		
		$output = '';
		if ($query_tm->have_posts())
		{
			$output .= '<div class="testimonials_slider">';
			
				// photos | pagination
				$output .= '<ul class="slider_images">';
					while ($query_tm->have_posts())
					{
						$query_tm->the_post();
						$output .= '<a href="#">';
							if( has_post_thumbnail() ){
								$output .= get_the_post_thumbnail( null, 'testimonials', array('class'=>'scale-with-grid' ) );
							} else {
								$output .= '<img class="scale-with-grid" src="'. THEME_URI .'/images/testimonials-placeholder.png" alt="'. get_post_meta(get_the_ID(), 'mfn-post-author', true) .'" />';
							}
						$output .= '</a>';
					}
					wp_reset_query();
				$output .= '</ul>';
			
				// testimonials | contant
				$output .= '<ul class="testimonials_slider_ul">';
					while ($query_tm->have_posts())
					{
						$query_tm->the_post();
						$output .= '<li>';
							$output .= '<div class="bq_wrapper">';	
								$output .= '<blockquote>'. get_the_content() .'</blockquote>';	
							$output .= '</div>';	
							$output .= '<div class="hr_dots"><span></span><span></span><span></span></div>';	
							$output .= '<div class="author">';
								$output .= '<h5>';
									if( $link = get_post_meta(get_the_ID(), 'mfn-post-link', true) ) $output .= '<a target="_blank" href="'. $link .'">';
										$output .= get_post_meta(get_the_ID(), 'mfn-post-author', true);
									if( $link ) $output .= '</a>';
								$output .= '</h5>';
								$output .= '<span class="company">'. get_post_meta(get_the_ID(), 'mfn-post-company', true) .'</span>';
							$output .= '</div>';
						$output .= '</li>';
					}
					wp_reset_query();
				$output .= '</ul>';
	
				// navigation
				$output .= '<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>';
				$output .= '<a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>';
				
			$output .= '</div>'."\n";
		}
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Vimeo [video]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_video' ) )
{
	function sc_video( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'video' 		=> '',
			'mp4' 			=> '',
			'ogv'	 		=> '',
			'placeholder' 	=> '',
			'width' 		=> '700',
			'height' 		=> '400',
		), $attr));
		
		$output  = '<div class="content_video">';
		
			if( $video ){
				
				// Embed
				if( is_numeric($video) ){
					// Vimeo
					$output .= '<iframe class="scale-with-grid" width="'. $width .'" height="'. $height .'" src="http'. mfn_ssl() .'://player.vimeo.com/video/'. $video .'" allowFullScreen></iframe>'."\n";
				} else {
					// YouTube
					$output .= '<iframe class="scale-with-grid" width="'. $width .'" height="'. $height .'" src="http'. mfn_ssl() .'://www.youtube.com/embed/'. $video .'?wmode=opaque" allowfullscreen></iframe>'."\n";
				}
				
			} elseif( $mp4 ){
				
				// HTML5
				$output .= '<div class="section_video">';
				
					$output .= '<div class="mask"></div>';
					$poster = ( $placeholder ) ? $placeholder : false;
					
					$output .= '<video poster="'. $poster .'" controls="controls" muted="muted" preload="auto" loop="true" autoplay="true" style="max-width:100%;">';
						
						$output .= '<source type="video/mp4" src="'. $mp4 .'" />';	
						if( $ogv ) $output .= '<source type="video/ogg" src="'. $ogv .'" />';
								
						$output .= '<object width="1900" height="1060" type="application/x-shockwave-flash" data="'. THEME_URI .'/js/flashmediaelement.swf">';
							$output .= '<param name="movie" value="'. THEME_URI .'/js/flashmediaelement.swf" />';
							$output .= '<param name="flashvars" value="controls=true&file='. $mp4 .'" />';
							$output .= '<img src="'. $poster .'" title="No video playback capabilities" class="scale-with-grid" />';
						$output .= '</object>';
						
					$output .= '</video>';
					
				$output .= '</div>';
				
			}
			
		$output .= '</div>'."\n";
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * _Item [item]								[feature_list][item][/feature_list]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_item' ) )
{
	function sc_item( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'title'		=> '',
			'link'		=> '',
			'icon'		=> 'icon-picture',
			'animate'	=> '',
		), $attr));

		$output  = '<li>';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				if( $link ) $output .= '<a href="'. $link .'">';
			
					$output .= '<span class="icon">';
						$output .= '<i class="'. $icon .'"></i>';
					$output .= '</span>';
					$output .= '<p>'. $title .'</p>';
					
				if( $link ) $output .= '</a>';
			if( $animate )  $output .= '</div>';
		$output .= '</li>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Feature List [feature_list]				[feature_list][item][/feature_list]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_feature_list' ) )
{
	function sc_feature_list( $attr, $content = null )
	{
		$output = '<div class="feature_list">';
			$output .= '<ul>';
				$output .= do_shortcode( $content );	// [item]
			$output .= '</ul>';
		$output .= '</div>'."\n";

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * List [list][/list]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_list' ) )
{
	function sc_list( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'icon'		=> 'icon-picture',
			'image'		=> '',
			'title'		=> '',
			'link'		=> '',
			'target'	=> '',
			'style'		=> 1,
			'animate'	=> '',
		), $attr));
		
		// target
		if( $target ){
			$target = 'target="_blank"';
		} else {
			$target = false;
		}
		
		$output = '<div class="list_item lists_'. $style .'">';
			if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
				if( $link ) $output .= '<a href="'. $link .'" '. $target .'>';
			
					if( $style == 4 ){
						$output .= '<div class="circle">'. $title .'</div>';
					} elseif( $image ){
						$output .= '<div class="list_left list_image">';
							$output .= '<img src="'. $image .'" alt="'. $title .'" class="scale-with-grid" />';
						$output .= '</div>';
					} else {
						$output .= '<div class="list_left list_icon">';
							$output .= '<i class="'. $icon .'"></i>';
						$output .= '</div>';
					}
					$output .= '<div class="list_right">';
						if( $title && $style != 4 ) $output .= '<h4>'. $title .'</h4>';
						$output .= '<div class="desc">'. do_shortcode( $content ) .'</div>';
					$output .= '</div>';
	
				if( $link ) $output .= '</a>';			
			if( $animate )  $output .= '</div>';
		$output .= '</div>'."\n";

		return $output;
	}
}


// column shortcodes -----------------------
add_shortcode( 'one', 'sc_one' );
add_shortcode( 'one_second', 'sc_one_second' );
add_shortcode( 'one_third', 'sc_one_third' );
add_shortcode( 'two_third', 'sc_two_third' );
add_shortcode( 'one_fourth', 'sc_one_fourth' );
add_shortcode( 'two_fourth', 'sc_two_fourth' );
add_shortcode( 'three_fourth', 'sc_three_fourth' );

// content shortcodes ----------------------
add_shortcode( 'alert', 'sc_alert' );
add_shortcode( 'blockquote', 'sc_blockquote' );
add_shortcode( 'button', 'sc_button' );
add_shortcode( 'code', 'sc_code' );
add_shortcode( 'content_link', 'sc_content_link' );
add_shortcode( 'divider', 'sc_divider' );
add_shortcode( 'dropcap', 'sc_dropcap' );
add_shortcode( 'google_font', 'sc_google_font' );
add_shortcode( 'highlight', 'sc_highlight' );
add_shortcode( 'hr', 'sc_divider' );				// do not change, alias for [divider] shortcode
add_shortcode( 'icon', 'sc_icon' );
add_shortcode( 'icon_bar', 'sc_icon_bar' );
add_shortcode( 'icon_block', 'sc_icon_block' );
add_shortcode( 'idea', 'sc_idea' );
add_shortcode( 'image', 'sc_image' );
add_shortcode( 'popup', 'sc_popup' );
add_shortcode( 'share_box', 'sc_share_box' );
add_shortcode( 'tooltip', 'sc_tooltip' );
add_shortcode( 'video_embed', 'sc_video' ); 		// WordPress has default [video] shortcode

// builder shortcodes ----------------------
add_shortcode( 'article_box', 'sc_article_box' );
add_shortcode( 'blog', 'sc_blog' );
add_shortcode( 'call_to_action', 'sc_call_to_action' );
add_shortcode( 'chart', 'sc_chart' );
add_shortcode( 'clients', 'sc_clients' );
add_shortcode( 'contact_box', 'sc_contact_box' );
add_shortcode( 'countdown', 'sc_countdown' );
add_shortcode( 'counter', 'sc_counter' );
add_shortcode( 'fancy_heading', 'sc_fancy_heading' );
add_shortcode( 'feature_list', 'sc_feature_list' );
add_shortcode( 'how_it_works', 'sc_how_it_works' );
add_shortcode( 'icon_box', 'sc_icon_box' );
add_shortcode( 'info_box', 'sc_info_box' );
add_shortcode( 'list', 'sc_list' );
add_shortcode( 'map', 'sc_map' );
add_shortcode( 'offer', 'sc_offer' );
add_shortcode( 'opening_hours', 'sc_opening_hours' );
add_shortcode( 'our_team', 'sc_our_team' );
add_shortcode( 'our_team_list', 'sc_our_team_list' );
add_shortcode( 'photo_box', 'sc_photo_box' );
add_shortcode( 'portfolio', 'sc_portfolio' );
add_shortcode( 'pricing_item', 'sc_pricing_item' );
add_shortcode( 'progress_bars', 'sc_progress_bars' );
add_shortcode( 'promo_box', 'sc_promo_box' );
add_shortcode( 'quick_fact', 'sc_quick_fact' );
add_shortcode( 'slider', 'sc_slider' );
add_shortcode( 'sliding_box', 'sc_sliding_box' );
add_shortcode( 'testimonials', 'sc_testimonials' );
add_shortcode( 'trailer_box', 'sc_trailer_box' );

// private shortcodes ----------------------
add_shortcode( 'bar', 'sc_bar' );
add_shortcode( 'item', 'sc_item' );

?>
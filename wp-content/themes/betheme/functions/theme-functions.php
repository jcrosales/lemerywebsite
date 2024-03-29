<?php
/**
 * Theme functions.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */


/* ---------------------------------------------------------------------------
 * Theme support
 * --------------------------------------------------------------------------- */
if( false ) add_editor_style( '/css/style-editor.css' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array('image','video','quote','link'));


/* ---------------------------------------------------------------------------
 * Post Thumbnails
 * --------------------------------------------------------------------------- */
if ( function_exists( 'add_theme_support' ) ) {
	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 			260,  146,  false ); 	// admin - featured image
	add_image_size( '50x50', 			50,   50,   false ); 	// admin - lists
	
	add_image_size( 'slider-content', 	890,  470,  true  ); 	// slider - content
	
	add_image_size( 'blog', 			576,  450,  true  ); 	// blog - list
	add_image_size( 'blog-vertical', 	576,  1200, false ); 	// blog - vertical
	add_image_size( 'blog-single', 		1200, 480,  true  ); 	// blog - single
	add_image_size( 'blog-navi', 		80,   80,   true  ); 	// blog - sticky navigation, widget
	
	add_image_size( 'portfolio', 		576,  450,  true  ); 	// portfolio
	add_image_size( 'portfolio-list', 	1160, 450,  true  ); 	// portfolio - list
	add_image_size( 'portfolio-mf', 	960,  750,  true  ); 	// portfolio - masonry flat
	add_image_size( 'portfolio-mf-w',   960,  375,  true  ); 	// portfolio - masonry flat wide
	add_image_size( 'portfolio-mf-t',   480,  750,  true  ); 	// portfolio - masonry flat tall
	
	add_image_size( 'testimonials', 	85,   85,   true  ); 	// testimonials
}


/* ---------------------------------------------------------------------------
 * Excerpt length
 * --------------------------------------------------------------------------- */
function mfn_excerpt_length( $length ) {
	return 26;
}
add_filter( 'excerpt_length', 'mfn_excerpt_length', 999 );


/* ---------------------------------------------------------------------------
 * Excerpt
 * --------------------------------------------------------------------------- */
function mfn_excerpt($post, $length = 55, $tags_to_keep = '<a><b><h1><h2><h3><h4><h5><h6><strong>', $extra = ' [...]') {
		
	if(is_int($post)) {
		$post = get_post($post);
	} elseif(!is_object($post)) {
		return false;
	}

	if(has_excerpt($post->ID)) {
		$the_excerpt = $post->post_excerpt;
		return apply_filters('the_content', $the_excerpt);
	} else {
		$the_excerpt = $post->post_content;
	}
	
	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt, $tags_to_keep));
	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
	$excerpt_waste = array_pop($the_excerpt);
	$the_excerpt = implode($the_excerpt);
	if( $excerpt_waste ) $the_excerpt .= $extra;
	
	return apply_filters('the_content', $the_excerpt);
}


/* ---------------------------------------------------------------------------
 * Get Comment Excerpt
 * --------------------------------------------------------------------------- */
function mfn_get_comment_excerpt($comment_ID = 0, $num_words = 20) {
	$comment = get_comment( $comment_ID );
	$comment_text = strip_tags($comment->comment_content);
	$blah = explode(' ', $comment_text);
	if (count($blah) > $num_words) {
		$k = $num_words;
		$use_dotdotdot = 1;
	} else {
		$k = count($blah);
		$use_dotdotdot = 0;
	}
	$excerpt = '';
	for ($i=0; $i<$k; $i++) {
		$excerpt .= $blah[$i] . ' ';
	}
	$excerpt .= ($use_dotdotdot) ? '[...]' : '';
	return apply_filters('get_comment_excerpt', $excerpt);
}


/* ---------------------------------------------------------------------------
 * SSL check
 * --------------------------------------------------------------------------- */
function mfn_ssl( $echo = false ){
	$ssl = '';
	if( is_ssl() ) $ssl = 's';
	if( $echo ){
		echo $ssl;
	}
	return $ssl;
}


/* ---------------------------------------------------------------------------
 * Get Real Post ID
 * --------------------------------------------------------------------------- */
function mfn_ID(){
	global $post;
	$postID = false;

	if( ! is_404() ){
		
		if( is_tax() ){
			
			// taxonomy-portfolio-types.php
			$postID = mfn_opts_get( 'portfolio-page' );
			
		} elseif( get_post_type()=='post' && ! is_singular() ){
			
			// index.php
			if( get_option( 'page_for_posts' ) ){
				$postID = get_option( 'page_for_posts' );	// Setings / Reading
			} elseif( mfn_opts_get( 'blog-page' ) ){
				$postID = mfn_opts_get( 'blog-page' );		// Theme Options / Getting Started / Blog
			}
			
		} else {
			
			// default
			$postID = get_the_ID();
			
		}
	}

	return $postID;
}


/* ---------------------------------------------------------------------------
 * Get slider key
 * --------------------------------------------------------------------------- */
function mfn_slider( $id = false ){
	
	$slider = false;

	if( $id || is_home() || get_post_type()=='page' || ( get_post_type() == 'portfolio' && get_post_meta( mfn_ID(), 'mfn-post-slider-header', true ) ) ){
			
		if( ! $id ) $id = mfn_ID(); // do NOT move it before IF
		
		if( $slider_key = get_post_meta( $id, 'mfn-post-slider', true ) ){
			
			// Revolution Slider
			$slider = '<div class="mfn-main-slider" id="mfn-rev-slider">';
				$slider .= do_shortcode('[rev_slider '. $slider_key .']');
			$slider .= '</div>';
			
		} elseif( $slider_key = get_post_meta( $id, 'mfn-post-slider-layer', true ) ) {
			
			// Layer Slider
			$slider = '<div class="mfn-main-slider" id="mfn-layer-slider">';
				$slider .= do_shortcode('[layerslider id="'. $slider_key .'"]');
			$slider .= '</div>';
			
		}
		
	}
	
	return $slider;
}


/* ---------------------------------------------------------------------------
 * Pagination for Blog and Portfolio
 * --------------------------------------------------------------------------- */
function mfn_pagination( $query = false ){
	global $wp_query;	
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

	// default $wp_query
	if( ! $query ) $query = $wp_query;
	
	$translate['prev'] = mfn_opts_get('translate') ? mfn_opts_get('translate-prev','&lsaquo; Prev page') : __('Prev page','betheme');
	$translate['next'] = mfn_opts_get('translate') ? mfn_opts_get('translate-next','Next page &rsaquo;') : __('Next page','betheme');
	
	$query->query_vars['paged'] > 1 ? $current = $query->query_vars['paged'] : $current = 1;  
	
	if( empty( $paged ) ) $paged = 1;
	$prev = $paged - 1;							
	$next = $paged + 1;
	
	$end_size = 1;
	$mid_size = 2;
	$show_all = mfn_opts_get('pagination-show-all');
	$dots = false;	

	if( ! $total = $query->max_num_pages ) $total = 1;
	
	$output = '';
	if( $total > 1 )
	{
		$output .= '<div class="column one pager_wrapper">';
			$output .= '<div class="pager">';
				
				if( $paged >1 ){
					$output .= '<a class="prev_page" href="'. previous_posts(false) .'"><i class="icon-left-open"></i>'. $translate['prev'] .'</a>';
				}
		
				$output .= '<div class="pages">';
					for( $i=1; $i <= $total; $i++ ){
						if ( $i == $current ){
							$output .= '<a href="'. get_pagenum_link($i) .'" class="page active">'. $i .'</a>';
							$dots = true;
						} else {
							if ( $show_all || ( $i <= $end_size || ( $current && $i >= $current - $mid_size && $i <= $current + $mid_size ) || $i > $total - $end_size ) ){
								$output .= '<a href="'. get_pagenum_link($i) .'" class="page">'. $i .'</a>';
								$dots = true;
							} elseif ( $dots && ! $show_all ) {
								$output .= '<span class="page">...</span>';
								$dots = false;
							}
						}
					}
				$output .= '</div>';
				
				if( $paged < $total ){
					$output .= '<a class="next_page" href="'. next_posts(0,false) .'">'. $translate['next'] .'<i class="icon-right-open"></i></a>';
				}
				
			$output .= '</div>';
		$output .= '</div>'."\n";
	}
	return $output;
}


/* ---------------------------------------------------------------------------
 * No sidebar message for themes with sidebar 
 * --------------------------------------------------------------------------- */
function mfn_nosidebar(){
	echo 'This template supports the sidebar\'s widgets. <a href="'. home_url() .'/wp-admin/widgets.php">Add one</a> or use Full Width layout.';	
}


/* ---------------------------------------------------------------------------
 * New Walker Category for categories menu
 * --------------------------------------------------------------------------- */
class New_Walker_Category extends Walker_Category {
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);

		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = '<a href="' . esc_attr( get_term_link($category) ) . '" ';
		if ( $use_desc_for_title == 0 || empty($category->description) )
			$link .= 'title="' . esc_attr( sprintf(__('View all posts filed under %s','betheme'), $cat_name) ) . '"';
		else
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		$link .= '>';
		$link .= $cat_name;

		if ( !empty($show_count) )
			$link .= ' <span>(' . intval($category->count) . ')</span>';
			
		$link .= '</a>';

		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-item cat-item-' . $category->term_id;
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' current-cat';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' current-cat-parent';
			}
			$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link\n";
		}
	}
}


/* ---------------------------------------------------------------------------
 * Current page URL
 * --------------------------------------------------------------------------- */
function curPageURL(){
	$pageURL = 'http';
	if( is_ssl() ) $pageURL .= "s";
	$pageURL .= "://";
	if( $_SERVER["SERVER_PORT"] != "80" ) {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


/* ---------------------------------------------------------------------------
 * Page Title
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'mfn_page_title' ) ){
	function mfn_page_title( $echo = false ){
		
		$title = false;
		
		if( is_home() ){
			
			// Blog ---------------------------------------
			$title = get_the_title( mfn_ID() );
			
		} elseif( is_tag() ){
			
			// Blog | Tag ---------------------------------
			$title = single_tag_title('', false);
			
		} elseif( is_category() ){
			
			// Blog | Category ----------------------------
			$title = single_cat_title('', false);
			
		} elseif( is_author() ){
			
			// Blog | Author ------------------------------
			$title = get_the_author();
		
		} elseif( is_day() ){
		
			// Blog | Day ---------------------------------
			$title = get_the_time('d');
		
		} elseif( is_month() ){
		
			// Blog | Month -------------------------------
			$title = get_the_time('F');

		} elseif( is_year() ){
		
			// Blog | Year --------------------------------
			$title = get_the_time('Y');
			
		} elseif( is_single() ){
			
			// Single -------------------------------------
			$title = get_the_title( mfn_ID() );
			
		} elseif( get_post_taxonomies() ){
			
			// Taxonomy -----------------------------------
			$title = single_cat_title('', false);
			
		} else {
			
			// Default ------------------------------------
			$title = get_the_title( mfn_ID() );		
		}
		
		if( $echo ) echo $title;
		return $title;
	}
}


/* ---------------------------------------------------------------------------
 * Breadcrumbs
 * --------------------------------------------------------------------------- */
function mfn_breadcrumbs(){
	global $post;
	
	$translate['home'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-home','Home') : __('Home','betheme');
	
	$homeLink = home_url();
	$separator = ' <span><i class="icon-right-open"></i></span>';
	
	
	// Plugin | bbPress -----------------------------------
	if( function_exists('is_bbpress') && is_bbpress() ){
		bbp_breadcrumb( array(
			'before' 		=> '<ul class="breadcrumbs">',
			'after' 		=> '</ul>',
			'sep' 			=> '<i class="icon-right-open"></i>',
			'crumb_before' 	=> '<li>',
			'crumb_after' 	=> '</li>',
			'home_text' 	=> $translate['home'],
		) );
		return true;
	} // end: bbPress -------------------------------------
	

	// Default breadcrumbs --------------------------------
	$breadcrumbs = array();

	// Home prefix --------------------------------
	$breadcrumbs[] =  '<a href="'. $homeLink .'">'. $translate['home'] .'</a>';

	// Blog -------------------------------------------
	if( get_post_type() == 'post' ){
		
		$blogID = false;
		if( get_option( 'page_for_posts' ) ){
			$blogID = get_option( 'page_for_posts' );	// Setings / Reading
		} elseif( mfn_opts_get( 'blog-page' ) ){
			$blogID = mfn_opts_get( 'blog-page' );		// Theme Options / Getting Started / Blog
		}

		$breadcrumbs[] = '<a href="'. get_permalink( $blogID ) .'">'. get_the_title( $blogID ) .'</a>';
	}
	
	// Blog -------------------------------------------
	if( is_home() ){
		
		// do nothing
		
	// Blog | Tag -------------------------------------
	} elseif( is_tag() ){
		
		$breadcrumbs[] = '<a href="'. curPageURL() .'">' . single_tag_title('', false) . '</a>';
		
	// Blog | Category --------------------------------
	} elseif( is_category() ){
		
		$breadcrumbs[] = '<a href="'. curPageURL() .'">' . single_cat_title('', false) . '</a>';
		
	// Blog | Author ----------------------------------
	} elseif( is_author() ){
		
		$breadcrumbs[] = '<a href="'. curPageURL() .'">' . get_the_author() . '</a>';
		
	// Blog | Day -------------------------------------
	} elseif( is_day() ){
		
		$breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) . '">'. get_the_time('Y') .'</a>';
		$breadcrumbs[] = '<a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
		$breadcrumbs[] = '<a href="'. curPageURL() .'">'. get_the_time('d') .'</a>';

	// Blog | Month -----------------------------------
	} elseif( is_month() ){

		$breadcrumbs[] = '<a href="' . get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a>';
		$breadcrumbs[] = '<a href="'. curPageURL() .'">'. get_the_time('F') .'</a>';
		
	// Blog | Year ------------------------------------
	} elseif( is_year() ){

		$breadcrumbs[] = '<a href="'. curPageURL() .'">'. get_the_time('Y') .'</a>';
		
	// Single -----------------------------------------
	} elseif( is_single() && ! is_attachment() ){
		
		// Custom Post Type -----------------
		if( get_post_type() != 'post' ){
			
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
		
			// Parents ------------
			if( $slug['slug'] == mfn_opts_get( 'portfolio-slug', 'portfolio-item' ) && $portfolio_page_id = mfn_opts_get('portfolio-page') ){
					
				// Portfolio
				$breadcrumbs[] = '<a href="' . get_page_link( $portfolio_page_id ) . '">'. get_the_title( $portfolio_page_id ) .'</a>';
		
			} elseif( function_exists('tribe_is_month') && ( tribe_is_month() || tribe_is_event() || tribe_is_day() || tribe_is_venue() ) ) {
					
				// Plugin | Events Calendar
				if( function_exists('tribe_get_events_link') ){
					$breadcrumbs[] = '<a href="'. tribe_get_events_link() .'">'. tribe_get_events_title() .'</a>';
				}
					
			}
		
			// Single Item --------
			$breadcrumbs[] = '<a href="' . curPageURL() . '">'. get_the_title().'</a>';

		// Blog | Single --------------------
		} else {
			
			$cat = get_the_category(); 
			$cat = $cat[0];	
			$breadcrumbs[] = get_category_parents( $cat, true, $separator );
		
			$breadcrumbs[] = '<a href="' . curPageURL() . '">'. get_the_title() .'</a>';
			
		}
		
	// Taxonomy ---------------------------------------
	} elseif( get_post_taxonomies() ){
			
		// Portfolio ------------------------
		$post_type = get_post_type_object( get_post_type() );
		if( $post_type->name == 'portfolio' && $portfolio_page_id = mfn_opts_get('portfolio-page') ) {
			$breadcrumbs[] = '<a href="' . get_page_link( $portfolio_page_id ) . '">'. get_the_title( $portfolio_page_id ) .'</a>';
		}
	
		$breadcrumbs[] = '<a href="' . curPageURL() . '">' . single_cat_title('', false) . '</a>';
		
	// Page with parent -------------------------------
	} elseif( is_page() && $post->post_parent ){
		
		$parent_id  = $post->post_parent;
		$parents = array();
			
		while( $parent_id ) {
			$page = get_page( $parent_id );
			$parents[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
			$parent_id  = $page->post_parent;
		}
		$parents = array_reverse( $parents );
		$breadcrumbs = array_merge_recursive($breadcrumbs, $parents);
			
		$breadcrumbs[] = '<a href="' . curPageURL() . '">'. get_the_title( mfn_ID() ) .'</a>';
	
	// Default ----------------------------------------
	} else {
		
		$breadcrumbs[] = '<a href="' . curPageURL() . '">'. get_the_title( mfn_ID() ) .'</a>';
		
	}
	
	
	// PRINT ------------------------------------------------------------------
	echo '<ul class="breadcrumbs">';
		
		$count = count( $breadcrumbs );
		$i = 1;
		
		foreach( $breadcrumbs as $bk => $bc ){

			if( strpos( $bc , $separator ) ){
				
				// Category parents fix
				echo '<li>'. $bc .'</li>';
				
			} else {
				
				if( $i == $count ) $separator = '';
				echo '<li>'. $bc . $separator .'</li>';
				
			}
			
			$i++;
			
		}
		
	echo '</ul>';

}


/* ---------------------------------------------------------------------------
 * Hex 2 rgba
 * --------------------------------------------------------------------------- */
function hex2rgba( $hex, $alpha = 1, $echo = false ) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	
	$rgba = 'rgba('. $r.', '. $g .', '. $b .', '. $alpha .')';

	if( $echo ){
		echo $rgba;
		return true;
	}
	
	return $rgba;
}


/* ---------------------------------------------------------------------------
 * jPlayer HTML
 * --------------------------------------------------------------------------- */
function mfn_jplayer_html( $video_m4v, $poster = false ){
	$player_id 	= mt_rand( 0, 999 );
	
	$output = '<div id="jp_container_'. $player_id .'" class="jp-video mfn-jcontainer">';
		$output .= '<div class="jp-type-single">';
			$output .= '<div id="jquery_jplayer_'. $player_id .'" class="jp-jplayer mfn-jplayer" data-m4v="'. $video_m4v .'" data-img="'. $poster .'" data-swf="'. THEME_URI .'/js"></div>';
			$output .= '<div class="jp-gui">';
				$output .= '<div class="jp-video-play">';
					$output .= '<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>';
				$output .= '</div>';
				$output .= '<div class="jp-interface">';
					$output .= '<div class="jp-progress">';
						$output .= '<div class="jp-seek-bar">';
							$output .= '<div class="jp-play-bar"></div>';
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="jp-current-time"></div>';
					$output .= '<div class="jp-duration"></div>';
					$output .= '<div class="jp-controls-holder">';
						$output .= '<ul class="jp-controls">';
							$output .= '<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>';
						$output .= '</ul>';
						$output .= '<div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div>';
						$output .= '<ul class="jp-toggles">';
							$output .= '<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>';
						$output .= '</ul>';
					$output .= '</div>';
					$output .= '<div class="jp-title"><ul><li>jPlayer Video Title</li></ul></div>';
				$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="jp-no-solution"><span>Update Required</span>To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a></div>';
		$output .= '</div>';
	$output .= '</div>'."\n";
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * jPlayer
 * --------------------------------------------------------------------------- */
function mfn_jplayer( $postID, $sizeH = 'large' ){
	
	// masonry square video fix
	if($sizeH == 'blog-masonry') $sizeH = 'blog-square';
	
	$video_m4v	= get_post_meta( $postID, 'mfn-post-video-mp4', true );
	$poster		= wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), $sizeH );		
	$poster		= $poster[0];
	
	return mfn_jplayer_html( $video_m4v, $poster );
}


/* ---------------------------------------------------------------------------
 * Post Format
* --------------------------------------------------------------------------- */
function mfn_post_format( $postID ){
	
	if( get_post_type( $postID ) == 'portfolio' && is_single( $postID ) ){	
		
		// portfolio
		if ( get_post_meta( get_the_ID(), 'mfn-post-video', true ) ){
			// Video - embed
			$format = 'video';
		} elseif( get_post_meta( get_the_ID(), 'mfn-post-video-mp4', true ) ){
			// Video - HTML5
			$format = 'video';
		} else {
			// Image
			$format = false;
		}
		
	} else {
		
		// blog
		$format = get_post_format( $postID );
		
	}

	return $format;
}


/* ---------------------------------------------------------------------------
 * Post Thumbnails
 * --------------------------------------------------------------------------- */
function mfn_post_thumbnail( $postID, $type = false, $style = false ){
	$output = '';

	// image size -------------------------------------------------
	if( $type == 'portfolio' ){
		
		// portfolio ----------------------------
		if( $style == 'list' ){
			
			// list -------------------
			$sizeH = 'portfolio-list';
			
		} elseif( $style == 'masonry-flat' ) {
			
			// masonry flat -----------
			$size = get_post_meta( $postID, 'mfn-post-size', true );
			if( $size == 'wide' ){
				$sizeH = 'portfolio-mf-w';
			} elseif( $size == 'tall' ) {
				$sizeH = 'portfolio-mf-t';
			} else {
				$sizeH = 'portfolio-mf';
			}
			
		} else {
			
			// default ----------------
			$sizeH = 'portfolio';
			
		}	
		
	} elseif( is_single( $postID ) ){
		
		// single post --------------------------
		$sizeH = 'blog-single';
		$sizeV = 'blog-vertical';
		
	} else {
		
		// default ------------------------------
		$sizeH = 'blog';
		$sizeV = 'blog-vertical';
		
	}

	// link wrap --------------------------------------------------
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'large' );
	
	if( is_single( $postID ) ){
		
		$link_before = '<a href="'. $large_image_url[0] .'" rel="prettyphoto">';
			$link_before .= '<div class="mask"></div>';
					
		$link_after = '</a>';
		$link_after .= '<div class="image_links">';
			$link_after .= '<a href="'. $large_image_url[0] .'" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a>';
		$link_after .= '</div>';
		
	} elseif( $type == 'portfolio' ) {
		
		// external link to project page
		if( $image_links = ( get_post_meta( get_the_ID(), 'mfn-post-link', true ) ) ){
			$image_links_class = 'triple';
		} else {
			$image_links_class = 'double';
		}
		
		$link_before = '<a href="'. get_permalink() .'">';
			$link_before .= '<div class="mask"></div>';

		$link_after = '</a>';
		
		$link_after .= '<div class="image_links '. $image_links_class .'">';
			$link_after .= '<a href="'. $large_image_url[0] .'" class="zoom" rel="prettyphoto[blog]"><i class="icon-search"></i></a>';
			if( $image_links ) $link_after .= '<a target="_blank" href="'. $image_links .'" class="external"><i class="icon-forward"></i></a>';
			$link_after .= '<a href="'. get_permalink() .'" class="link"><i class="icon-link"></i></a>';
		$link_after .= '</div>';
		
	} else {
		
		$link_before = '<a href="'. get_permalink() .'">';
			$link_before .= '<div class="mask"></div>';

		$link_after = '</a>';
		$link_after .= '<div class="image_links double">';
			$link_after .= '<a href="'. $large_image_url[0] .'" class="zoom" rel="prettyphoto[blog]"><i class="icon-search"></i></a>';
			$link_after .= '<a href="'. get_permalink() .'" class="link"><i class="icon-link"></i></a>';
		$link_after .= '</div>';
		
	}
	
	// post format -------------------------------------------------	
	switch( mfn_post_format( $postID ) ){
		
		case 'quote':
		case 'link':
			// quote - Quote - without image
			return false;
			break;
			
		case 'image': 
			// image - Vertical Image
			if( has_post_thumbnail() ){
				$output .= $link_before;
					$output .= get_the_post_thumbnail( $postID, $sizeV, array( 'class' => 'scale-with-grid' ) );
				$output .= $link_after;
			}
			break;
			
		case 'video':
			// video - Video
			if( $video = get_post_meta( $postID, 'mfn-post-video', true ) ){
				if( is_numeric($video) ){
					// Vimeo
					$output .= '<iframe class="scale-with-grid" src="http'. mfn_ssl() .'://player.vimeo.com/video/'. $video .'" allowFullScreen></iframe>'."\n";
				} else {
					// YouTube
					$output .= '<iframe class="scale-with-grid" src="http'. mfn_ssl() .'://www.youtube.com/embed/'. $video .'?wmode=opaque" allowfullscreen></iframe>'."\n";
				}
			} elseif( get_post_meta( $postID, 'mfn-post-video-mp4', true ) ){
				$output .= mfn_jplayer( $postID, $sizeH );		
			}
			break;
			
		default:
			// standard - Text, Horizontal Image, Slider

			if( $type != 'portfolio' && ( ($rev_slider = get_post_meta( $postID, 'mfn-post-slider', true )) || ($lay_slider = get_post_meta( $postID, 'mfn-post-slider-layer', true )) ) ) {
					
				if( $rev_slider ){
					// Revolution Slider
					$output .= do_shortcode('[rev_slider '. $rev_slider .']');
				} elseif( $lay_slider ){
					// Layer Slider
					$output .= do_shortcode('[layerslider id="'. $lay_slider .'"]');
				}
				
			} elseif( has_post_thumbnail() ){
				
				// Image
				$output .= $link_before;
					$output .= get_the_post_thumbnail( $postID, $sizeH, array( 'class' => 'scale-with-grid' ) );
				$output .= $link_after;
				
			}
	}
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Sticky post navigation
 * --------------------------------------------------------------------------- */
function mfn_post_navigation( $post, $next_prev, $icon ){
	$output = '';

	if( is_object( $post ) ){
		// move this DOM element with JS
		$output .= '<a class="fixed-nav fixed-nav-'. $next_prev .' format-'. get_post_format( $post ) .'" href="'. get_permalink( $post ) .'">';
			
			$output .= '<span class="arrow"><i class="'. $icon .'"></i></span>';
			
			$output .= '<div class="photo">';
				$output .= get_the_post_thumbnail( $post->ID, 'blog-navi' );
			$output .= '</div>';
			
			$output .= '<div class="desc">';
				$output .= '<h6>'. get_the_title( $post ) .'</h6>';
				$output .= '<span class="date"><i class="icon-clock"></i>'. date(get_option('date_format'), strtotime($post->post_date)) .'</span>';
			$output .= '</div>';
			
		$output .= '</a>';
	}

	return $output;
}


/* ---------------------------------------------------------------------------
 * Posts per page & pagination fix
 * --------------------------------------------------------------------------- */
function mfn_option_posts_per_page( $value ) {
	if ( is_tax( 'portfolio-types' ) ) {
        $posts_per_page = mfn_opts_get( 'portfolio-posts', 6, true );
    } else {
        $posts_per_page = mfn_opts_get( 'blog-posts', 5, true );
    }
    return $posts_per_page;
}

function mfn_posts_per_page() {
    add_filter( 'option_posts_per_page', 'mfn_option_posts_per_page' ); 
}
add_action( 'init', 'mfn_posts_per_page', 0 );


/* ---------------------------------------------------------------------------
 *	Comments number with text
 * --------------------------------------------------------------------------- */
function mfn_comments_number() {
	$translate['comment'] = mfn_opts_get('translate') ? mfn_opts_get('translate-comment','comment') : __('comment','betheme');
	$translate['comments'] = mfn_opts_get('translate') ? mfn_opts_get('translate-comments','comments') : __('comments','betheme');
	$translate['comments-off'] = mfn_opts_get('translate') ? mfn_opts_get('translate-comments-off','comments off') : __('comments off','betheme');
	
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	
	if ( comments_open() ) {
		if ( $num_comments != 1 ) {
			$comments = '<a href="' . get_comments_link() .'">'. $num_comments.'</a> '. $translate['comments'];
		} else {
			$comments = '<a href="' . get_comments_link() .'">1</a> '. $translate['comment'];
		}
	} else {
		$comments = $translate['comments-off'];
	}
	return $comments;
}


/* ---------------------------------------------------------------------------
 *	Menu title in selected location
 * --------------------------------------------------------------------------- */
function mfn_get_menu_name($location){
	
	if( ! has_nav_menu($location) ){
		return false;
	}
	
	$menus = get_nav_menu_locations();
	$menu_title = wp_get_nav_menu_object($menus[$location])->name;
	
	return $menu_title;
}


/* ---------------------------------------------------------------------------
 *	Under Construction
 * --------------------------------------------------------------------------- */
if( ! function_exists('mfn_under_construction') ){
	function mfn_under_construction(){
		if( mfn_opts_get('construction') 
			&& ! is_user_logged_in() 
			&& ! is_admin() 
			&& basename( $_SERVER['PHP_SELF']) != 'wp-login.php'
			&& basename( $_SERVER['PHP_SELF']) != 'style.php'
			&& basename( $_SERVER['PHP_SELF']) != 'style-one.php'
			&& basename( $_SERVER['PHP_SELF']) != 'style-colors.php' ){
			get_template_part('under-construction');
			exit();
		}
	}
}
add_action('init', 'mfn_under_construction', 30);


/* ---------------------------------------------------------------------------
 *	Set Max Content Width
 * --------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) $content_width = 1200;


/* ---------------------------------------------------------------------------
 *	WPML - Date Format
* --------------------------------------------------------------------------- */
function translate_date_format($format) {
	if (function_exists('icl_translate'))
		$format = icl_translate('Formats', $format, $format);
	return $format;
}
add_filter('option_date_format', 'translate_date_format');


/* ---------------------------------------------------------------------------
 *	TGM Plugin Activation
 * --------------------------------------------------------------------------- */
add_action( 'tgmpa_register', 'mfn_register_required_plugins' );
function mfn_register_required_plugins() {

	$plugins = array(
			
		// required -----------------------------	
		
		array(
			'name'     				=> 'Slider Revolution', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> LIBS_DIR .'/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
// 			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
// 			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
// 			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
// 			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Contact Form 7',
			'slug'     				=> 'contact-form-7',
			'source'   				=> LIBS_DIR .'/plugins/contact-form-7.zip',
			'required' 				=> true,
		),
			
		// recommended -----------------------------
		
		array(
			'name'     				=> 'bbPress',
			'slug'     				=> 'bbpress',
			'required' 				=> false,
			'external_url'			=> 'https://wordpress.org/plugins/bbpress/',
		),
		
		array(
			'name'     				=> 'Duplicate Post',
			'slug'     				=> 'duplicate-post',
			'required' 				=> false,
			'external_url'			=> 'https://wordpress.org/plugins/duplicate-post/',
		),
		
		array(
			'name'     				=> 'Envato WordPress Toolkit',
			'slug'     				=> 'envato-wordpress-toolkit',
			'source'   				=> LIBS_DIR .'/plugins/envato-wordpress-toolkit.zip',
			'required' 				=> false,
		),
			
		array(
			'name'     				=> 'Layer Slider',
			'slug'     				=> 'layerslider',
			'source'   				=> LIBS_DIR .'/plugins/layerslider.zip',
			'required' 				=> false,
			'version' 				=> '5.1.0',
			'force_activation'		=> true,
			'force_deactivation'	=> true,
		),
		
		array(
			'name'     				=> 'Recent Tweets',
			'slug'     				=> 'recent-tweets-widget',
			'required' 				=> false,
			'external_url'			=> 'https://wordpress.org/plugins/recent-tweets-widget/',
		),
			
		array(
			'name'     				=> 'Force Regenerate Thumbnails',
			'slug'     				=> 'force-regenerate-thumbnails',
			'required' 				=> false,
			'external_url'			=> 'https://wordpress.org/plugins/force-regenerate-thumbnails/',
		),
			
		array(
			'name'     				=> 'The Events Calendar',
			'slug'     				=> 'the-events-calendar',
			'required' 				=> false,
			'external_url'			=> 'https://wordpress.org/plugins/the-events-calendar/',
		),
			
		array(
			'name'     				=> 'WooCommerce',
			'slug'     				=> 'woocommerce',
			'required' 				=> false,
			'external_url'			=> 'http://wordpress.org/plugins/woocommerce/',
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$config = array(
		'domain'       		=> 'betheme',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'betheme' ),
			'menu_title'                       			=> __( 'Install Plugins', 'betheme' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'betheme' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'betheme' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'betheme' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'betheme' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'betheme' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa( $plugins, $config );
}

?>
<?php
/**
 * The template for displaying content in the single-portfolio.php template
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

// prev & next post -------------------
$in_same_term = mfn_opts_get( 'portfolio-in-same-term' ) ? true : false;
$post_prev = get_adjacent_post( $in_same_term, '', true, 'portfolio-types' );
$post_next = get_adjacent_post( $in_same_term, '', false, 'portfolio-types' );
$portfolio_page_id = mfn_opts_get( 'portfolio-page' );

// categories -------------------------
$categories 	= '';
$aCategories 	= '';

$terms = get_the_terms( get_the_ID(), 'portfolio-types' );
if( is_array( $terms ) ){
	foreach( $terms as $term ){
		$categories		.= '<li><a href="'. site_url() .'/portfolio-types/'. $term->slug .'">'. $term->name .'</a></li>';
		$aCategories[]	= $term->term_id;  
	}
}

// post classes -----------------------
$classes = array();
if( ! mfn_opts_get( 'share' ) ) $classes[] = 'no-share';
if( get_post_meta(get_the_ID(), 'mfn-post-slider-header', true) ) $classes[] = 'no-img';

$translate['published'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-published','Published by') : __('Published by','betheme');
$translate['at'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-at','at') : __('at','betheme');
$translate['categories'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-categories','Categories') : __('Categories','betheme');
$translate['all'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-all','Show all') : __('Show all','betheme');
$translate['related'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-related','Related posts') : __('Related posts','betheme');
$translate['readmore'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-readmore','Read more') : __('Read more','betheme');
$translate['client'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-client','Client') : __('Client','betheme');
$translate['date'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-date','Date') : __('Date','betheme');
$translate['website'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-website','Website') : __('Website','betheme');
$translate['view'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-view','View website') : __('View website','betheme');
$translate['task'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-task','Task') : __('Task','betheme');
?>

<div id="portfolio-item-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<div class="section section-portfolio-header">
		<div class="section_wrapper clearfix">
	
			
			<div class="column one post-nav">
				
				<?php 
					// prev & next post navigation
					echo mfn_post_navigation( $post_prev, 'prev', 'icon-left-open-big' ); 
					echo mfn_post_navigation( $post_next, 'next', 'icon-right-open-big' ); 
				?>
				
				<ul class="next-prev-nav">
					<?php if( $post_prev ): ?>
						<li class="prev"><a class="button button_js" href="<?php echo get_permalink( $post_prev ); ?>"><span class="button_icon"><i class="icon-left-open"></i></span></a></li>
					<?php endif; ?>
					<?php if( $post_next ): ?>
						<li class="next"><a class="button button_js" href="<?php echo get_permalink( $post_next ); ?>"><span class="button_icon"><i class="icon-right-open"></i></span></a></li>
					<?php endif; ?>
				</ul>
				
				<?php if( $portfolio_page_id ): ?>
					<a class="list-nav" href="<?php echo get_permalink( $portfolio_page_id ); ?>"><i class="icon-layout"></i><?php echo $translate['all']; ?></a>
				<?php endif; ?>
				
			</div>
		
			<div class="column one post-header">
			
				<div class="button-love"><?php echo mfn_love() ?></div>
				
				<div class="title_wrapper">
					<h1><?php the_title(); ?></h1>
					
					<div class="post-meta clearfix">
						<div class="author-date">
							<span class="author"><?php echo $translate['published']; ?> <i class="icon-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span> 
							<span class="date"><?php echo $translate['at']; ?> <i class="icon-clock"></i><?php echo get_the_date(); ?></span>
						</div>
						<div class="category">
							<span class="cat-btn"><?php echo $translate['categories']; ?> <i class="icon-down-dir"></i></span>
							<div class="cat-wrapper"><ul><?php echo $categories ?></ul></div>
						</div>
					</div>
				</div>
				
			</div>
	
			<div class="column one single-photo-wrapper">
				
				<?php if( mfn_opts_get( 'share' ) ): ?>
				<div class="share_wrapper">
					<span class='st_facebook_vcount' displayText='Facebook'></span>
					<span class='st_twitter_vcount' displayText='Tweet'></span>
					<span class='st_pinterest_vcount' displayText='Pinterest'></span>
					
					<script src="http<?php mfn_ssl(1); ?>://w<?php mfn_ssl(1); ?>.sharethis.com/button/buttons.js"></script>
					<script>stLight.options({publisher: "1390eb48-c3c3-409a-903a-ca202d50de91", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
				</div>
				<?php endif; ?>
				
				<?php if( ! get_post_meta(get_the_ID(), 'mfn-post-slider-header', true) ): ?>
				<div class="image_frame scale-with-grid">
					<div class="image_wrapper">
						<?php echo mfn_post_thumbnail( get_the_ID() ); ?>
					</div>
				</div>
				<?php endif; ?>
				
			</div>
			
			<div class="column one project-description">
				<ul>
					<?php 
						if( $client = get_post_meta( get_the_ID(), 'mfn-post-client', true ) ){
							echo '<li class="one-third"><span class="label">'. $translate['client'] .'</span>'. $client .'</li>';
						}
						echo '<li class="one-third"><span class="label">'. $translate['date'] .'</span>'. get_the_date() .'</li>';
						if( $link = get_post_meta( get_the_ID(), 'mfn-post-link', true ) ){
							echo '<li class="one-third"><span class="label">'. $translate['website'] .'</span><a target="_blank" href="'. $link .'"><i class="icon-forward"></i>'. $translate['view'] .'</a></li>';
						}
						if( $task = get_post_meta( get_the_ID(), 'mfn-post-task', true ) ){
							echo '<li><span class="label">'. $translate['task'] .'</span>'. $task .'</li>';
						}
					?>
				</ul>
			</div>
			
		</div>
	</div>
	
	<?php
		// Content Builder & WordPress Editor Content
		mfn_builder_print( get_the_ID() );
	?>
	
	<div class="section section-post-footer">
		<div class="section_wrapper clearfix">
		
			<div class="column one post-pager">
				<?php
					// List of pages
					wp_link_pages(array(
						'before'			=> '<div class="pager-single">',
						'after'				=> '</div>',
						'link_before'		=> '<span>',
						'link_after'		=> '</span>',
						'next_or_number'	=> 'number'
					));
				?>
			</div>
			
		</div>
	</div>
	
	<div class="section section-post-related">
		<div class="section_wrapper clearfix">
			
			<?php
				if( mfn_opts_get( 'portfolio-related' ) && $aCategories ){
					$args = array(
						'post_type' 			=> 'portfolio',
						'tax_query' => array(
							array(
								'taxonomy'	=> 'portfolio-types',
								'terms'		=> $aCategories
							),
						),
						'post__not_in'			=> array( get_the_ID() ),
						'posts_per_page'		=> 3,
						'post_status'			=> 'publish',
						'no_found_rows'			=> true,
						'ignore_sticky_posts'	=> true,
					);

					$query_related_posts = new WP_Query( $args );
					if ( $query_related_posts->have_posts() ){

						echo '<div class="section-related-adjustment">';
							echo '<h4>'. $translate['related'] .'</h4>';
							
							while ( $query_related_posts->have_posts() ){
								$query_related_posts->the_post();
								
								echo '<div class="column one-third post-related '. implode(' ',get_post_class()).'">';	
									
									echo '<div class="image_frame scale-with-grid">';
										echo '<div class="image_wrapper">';
											echo mfn_post_thumbnail( get_the_ID() );
										echo '</div>';
									echo '</div>';
									
									echo '<div class="date_label">'. get_the_date() .'</div>';
								
									echo '<div class="desc">';
										echo '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
										echo '<hr class="hr_color" />';
										echo '<a href="'. get_permalink() .'" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">'. $translate['readmore'] .'</span></a>';
									echo '</div>';
									
								echo '</div>';
							}
							
						echo '</div>';
					}	
					wp_reset_postdata();
				}	
			?>
			
		</div>
	</div>
	
</div>
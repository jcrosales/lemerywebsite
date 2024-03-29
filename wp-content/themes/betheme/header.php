<?php
/**
 * The Header for our theme.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */
?><!DOCTYPE html>
<?php 
	if( $_GET && key_exists('mfn-rtl', $_GET) ):
		echo '<html class="no-js" lang="ar" dir="rtl">';
	else:
?>
<html class="no-js" <?php language_attributes(); ?>>
<?php endif; ?>

<!-- head -->
<head>

<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if( mfn_opts_get('responsive') ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'; ?>

<title><?php
if( mfn_title() ){
	echo mfn_title();
} else {
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'betheme' ), max( $paged, $page ) );
}
?></title>

<?php do_action('wp_seo'); ?>

<link rel="shortcut icon" href="<?php mfn_opts_show('favicon-img',THEME_URI .'/images/favicon.ico'); ?>" type="image/x-icon" />	

<!-- wp_head() -->
<?php wp_head(); ?>
</head>

<!-- body -->
<body <?php body_class(); ?>>
	
	<?php get_template_part( 'includes/header', 'sliding-area' ); ?>
	
	<?php if( mfn_header_style() == 'header-creative' ) get_template_part( 'includes/header', 'creative' ); ?>
	
	<!-- #Wrapper -->
	<div id="Wrapper">
	
		<?php 
			// Header Featured Image -----------
			$header_style = false;
			if( mfn_ID() && ! is_search() ){
				if( ( ( mfn_ID() == get_option( 'page_for_posts' ) ) || ( get_post_type() == 'page' ) ) && has_post_thumbnail( mfn_ID() ) ){
					$subheader_image = wp_get_attachment_image_src( get_post_thumbnail_id( mfn_ID() ), 'full' );
					$header_style = 'style="background-image:url('. $subheader_image[0] .');"';
				}
			}
		?>
		
		<?php if( mfn_header_style() == 'header-below' ) echo mfn_slider(); ?>
	
		<!-- #Header_bg -->
		<div id="Header_wrapper" <?php echo $header_style; ?>>
	
			<!-- #Header -->
			<header id="Header">
				<?php if( mfn_header_style() != 'header-creative' ) get_template_part( 'includes/header', 'top-area' ); ?>	
				<?php if( mfn_header_style() != 'header-below' ) echo mfn_slider(); ?>
			</header>
				
			<?php 
				if( is_search() ){
					
					// Page title -------------------------
					echo '<div id="Subheader">';
						echo '<div class="container">';
							echo '<div class="column one">';
							
								global $wp_query;
								$total_results = $wp_query->found_posts;
								echo '<h1 class="title">'. $total_results .' '. __('results found for:','betheme') .' '. get_search_query() .'</h1>';
								
							echo '</div>';
						echo '</div>';
					echo '</div>';
					
				} elseif( ! is_front_page() && ! mfn_slider() ){
	
					// Page title -------------------------
					echo '<div id="Subheader">';
						echo '<div class="container">';
							echo '<div class="column one">';
								
								// Title
								echo '<h1 class="title">'. mfn_page_title() .'</h1>';
								
								// Breadcrumbs
								if( mfn_opts_get('show-breadcrumbs') ) mfn_breadcrumbs();
								
							echo '</div>';
						echo '</div>';
					echo '</div>';
					
				}
			?>
		
		</div>
<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp . '/wp-load.php' );

if ( ! current_user_can('edit_pages') && ! current_user_can('edit_posts') ) 
{
	wp_die(__("You don't have permissions","mfn-opts"));
}
	
global $wpdb;
?>
<html>
<head>
<title><?php _e("Shortcode Panel","mfn-opts"); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php echo get_option( 'blog_charset' ); ?>" />
	<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script type="text/javascript" src="<?php echo PLUGIN_URI ?>tinymce.js"></script>
	<base target="_self" />
	<style>
		body, select { font-size:12px;}
	</style>
</head>

<body onLoad="tinyMCEPopup.executeOnLoad('init();'); document.body.style.display='';">

	<form name="shortcodes" action="#" >

		<div style="height:100px;">
			<p>Insert content shortcodes.<br />For more advanced shortcodes please use <b>Muffin Builder</b>.</p>
			<?php _e("Shortcode","mfn-opts"); ?>
			<select id="shortcode" name="shortcode" style="width: 200px">
                <option value="0">-- <?php _e("select","mfn-opts"); ?> --</option>
				<?php
				
					$mfn_shortcodes = array();
				
					$mfn_shortcodes['column'] = array(
						'one' 				=> '1/1',
						'one_second' 		=> '1/2',
						'one_third' 		=> '1/3',
						'two_third' 		=> '2/3',
						'one_fourth' 		=> '1/4',
						'two_fourth' 		=> '2/4',
						'three_fourth'		=> '3/4',
					);

					$mfn_shortcodes['content'] = array(
						'alert' 			=> 'Alert',
						'blockquote' 		=> 'Blockquote',
						'button' 			=> 'Button',
						'code' 				=> 'Code',
						'content_link' 		=> 'Content Link',
						'divider' 			=> 'Divider',
						'dropcap' 			=> 'Dropcap',
						'google_font' 		=> 'Google Font',
						'highlight'			=> 'Highlight',
						'hr'				=> 'Hr',
						'icon' 				=> 'Icon',
						'icon_bar' 			=> 'Icon Bar',
						'icon_block' 		=> 'Icon Block',
						'idea' 				=> 'Idea',
						'image' 			=> 'Image',
						'table' 			=> 'Table',
						'tooltip' 			=> 'Tooltip',
						'video_embed' 		=> 'Video',
					);

					$mfn_shortcodes['builder'] = array(
						'article_box' 		=> 'Article Box',
						'blog'			 	=> 'Blog',
						'call_to_action'	=> 'Call to Action',
						'chart'			 	=> 'Chart',
						'clients'		 	=> 'Clients',
						'contact_box'	 	=> 'Contact Box',
						'counter'	 		=> 'Counter',
						'fancy_heading'		=> 'Fancy Heading',
						'feature_list'		=> 'Feature List',
						'how_it_works'		=> 'How It Works',
						'icon_box'	 		=> 'Icon Box',
						'info_box'	 		=> 'Info Box',
						'list'	 			=> 'List',
						'map'	 			=> 'Map',
						'opening_hours'	 	=> 'Opening Hours',
						'our_team'	 		=> 'Our Team',
						'our_team_list'	 	=> 'Our Team List',
						'photo_box'	 		=> 'Photo Box',
						'portfolio'	 		=> 'Portfolio',
						'pricing_item'	 	=> 'Pricing Item',
						'progress_bars'	 	=> 'Progress Bars',
						'promo_box'	 		=> 'Promo Box',
						'quick_fact'	 	=> 'Quick Fact',
						'slider'	 		=> 'Slider',
						'sliding_box'	 	=> 'Sliding Box',
						'testimonials'	 	=> 'Testimonials',
						'trailer_box'		=> 'Trailer Box',
					);
					
					foreach( $mfn_shortcodes as $k_sc_group => $sc_group ){
						echo '<option value="0">---------- '. $k_sc_group .' shortcodes ----------</option>';
						
						foreach( $sc_group as $key => $value ) {
							echo '<option value="'. $key .'" >'. $value .'</option>'."\n";
						}
					
					}
						
				?>
            </select>
		</div>

		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel","mfn-opts"); ?>" onClick="tinyMCEPopup.close();" />
			</div>
	
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="<?php _e("Insert","mfn-opts"); ?>" onClick="mfn_mce_submit();" />
			</div>
		</div>
	
	</form>
</body>
</html>
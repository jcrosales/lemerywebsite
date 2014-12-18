<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/** ---------------------------------------------------------------------------
 * Import Demo Data
 * @author Muffin Group
 * @version 1.0
 * ---------------------------------------------------------------------------- */
class mfnImport {

	public $error	= '';
	
	/** ---------------------------------------------------------------------------
	 * Constructor
	 * ---------------------------------------------------------------------------- */
	function __construct() {
		add_action( 'admin_menu', array( &$this, 'init' ) );
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Add theme Page
	 * ---------------------------------------------------------------------------- */
	function init() {
		add_theme_page(
			'BeTheme Import Demo Data',
			'BeTheme Demo Data',
			'edit_theme_options',
			'mfn_import',
			array( &$this, 'import' )
		);
		
		wp_enqueue_style( 'mfn.import', LIBS_URI. '/importer/import.css', false, time(), 'all');
		wp_enqueue_script( 'mfn.import', LIBS_URI. '/importer/import.js', false, time(), true );
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Import | Content
	 * ---------------------------------------------------------------------------- */
	function import_content( $file = 'all.xml.gz' ){
		$import = new WP_Import();
		$xml = LIBS_DIR . '/importer/demo/'. $file;
// 		print_r($xml);
		
		$import->fetch_attachments = ( $_POST && key_exists('attachments', $_POST) && $_POST['attachments'] ) ? true : false;
		
		ob_start();
		$import->import( $xml );	
		ob_end_clean();
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Import | Menu - Locations 
	 * ---------------------------------------------------------------------------- */
	function import_menu_location(){
		$file_path 	= LIBS_URI . '/importer/demo/menu.txt';
		$file_data 	= wp_remote_get( $file_path );
		$data 		= unserialize( base64_decode( $file_data['body']));
		$menus 		= wp_get_nav_menus();
			
		foreach( $data as $key => $val ){
			foreach( $menus as $menu ){
				if( $menu->slug == $val ){
					$data[$key] = absint( $menu->term_id );
				}
			}
		}
// 		print_r($data);
		
		set_theme_mod( 'nav_menu_locations', $data );
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Import | Theme Options
	 * ---------------------------------------------------------------------------- */
	function import_options(){
		$file_path 	= LIBS_URI . '/importer/demo/options.txt';
		$file_data 	= wp_remote_get( $file_path );
		$data 		= unserialize( base64_decode( $file_data['body']));
// 		print_r($data);

		update_option( THEME_NAME, $data );
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Import | Widgets
	 * ---------------------------------------------------------------------------- */
	function import_widget(){
		$file_path 	= LIBS_URI . '/importer/demo/widget_data.json';
		$file_data 	= wp_remote_get( $file_path );
		$data 		= $file_data['body'];
// 		print_r($data);
	
		$this->import_widget_data( $data );
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Import
	 * ---------------------------------------------------------------------------- */
	function import(){
		global $wpdb;
		
		if( key_exists( 'mfn_import_nonce',$_POST ) ){
			if ( wp_verify_nonce( $_POST['mfn_import_nonce'], basename(__FILE__) ) ){
				
// 				print_r($_POST);
	
				// Importer classes
				if( ! defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true );
				
				if( ! class_exists( 'WP_Importer' ) ){
					require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				}
				
				if( ! class_exists( 'WP_Import' ) ){
					require_once LIBS_DIR . '/importer/wordpress-importer.php';
				}
				
				if( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ){
					
					switch( $_POST['import'] ) {
						
						case 'all':
							// Full Demo Data ---------------------------------
							$this->import_content();
							$this->import_menu_location();
							$this->import_options();
							$this->import_widget();
							
							// set home & blog page
							$home = get_page_by_title( 'Home' );
							$blog = get_page_by_title( 'Blog' );
							if( $home->ID && $blog->ID ) {
								update_option('show_on_front', 'page');
								update_option('page_on_front', $home->ID); // Front Page
								update_option('page_for_posts', $blog->ID); // Blog Page
							}
							break;
						
						case 'content':
							if( $_POST['content'] ){
								$_POST['content'] = htmlspecialchars( stripslashes( $_POST['content'] ) );
								$file = 'content/'. $_POST['content'] .'.xml.gz';
								$this->import_content( $file );
							} else {
								$this->import_content();
							}
							break;
							
						case 'homepage':
							// Homepage ---------------------------------------
							$_POST['homepage'] = htmlspecialchars( stripslashes( $_POST['homepage'] ) );
							$file = 'homepage/'. $_POST['homepage'] .'.xml.gz';
							$this->import_content( $file );
							break;
							
						case 'menu':
							// Menu -------------------------------------------
							$this->import_content( 'menu.xml.gz' );
							$this->import_menu_location();
							break;
							
						case 'options':
							// Theme Options ----------------------------------
							$this->import_options();
							break;
							
						case 'widgets':
							// Widgets ----------------------------------------
							$this->import_widget();
							break;
							
						default:
							// Empty select.import
							$this->error = __('Please select data to import.','mfn-opts');	
							break;
					}
					
					// message box
					if( $this->error ){
						echo '<div class="error settings-error">';
							echo '<p><strong>'. $this->error .'</strong></p>';
						echo '</div>';
					} else {
						echo '<div class="updated settings-error">';
							echo '<p><strong>'. __('All done. Have fun!','mfn-opts') .'</strong></p>';
						echo '</div>';
					}

				}
	
			}
		}

		?>
		<div id="mfn-wrapper" class="mfn-import wrap">
		
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			
			<p><strong>Notice:</strong></p>
			<p>
				Before starting the import, you need to install all required/recommended plugins.<br />
				If you are planning to use the shop, please also remember about WooCommerce plugin.
			</p>
	
			<form action="" method="post">
				
				<input type="hidden" name="mfn_import_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
				
				<table class="form-table">
				
					<tr class="row-import">
						<th scope="row">
							<label for="import">Import</label>
						</th>
						<td>
							<select name="import" class="import">
								<option value="">-- Select --</option>
								<option value="all">All</option>
								<option value="content">Content</option>
								<option value="homepage">Homepage</option>
								<!-- <option value="menu">Menu</option> -->
								<option value="options">Options</option>
								<option value="widgets">Widgets</option>
							</select>
						</td>
					</tr>
					
					<tr class="row-content hide">
						<th scope="row">
							<label for="content">Content</label>
						</th>
						<td>
							<select name="content">
								<option value="">-- All --</option>
								<option value="pages">Pages</option>
								<option value="posts">Posts</option>
								<option value="contact">Contact</option>
								<option value="clients">Clients</option>
								<option value="offer">Offer</option>
								<option value="portfolio">Portfolio</option>
								<option value="slides">Slides</option>
								<option value="testimonials">Testimonials</option>
							</select>
						</td>
					</tr>
					
					<tr class="row-homepage hide">
						<th scope="row">
							<label for="homepage">Homepage</label>
						</th>
						<td>
							<select name="homepage">
								<option value="home">Home (default)</option>
								<option value="agency">Agency</option>
								<option value="beauty">Beauty</option>
								<option value="blogger">Blogger</option>
								<option value="business">Bussiness</option>
								<option value="church">Church</option>
								<option value="creative">Creative</option>
								<option value="design">Design</option>
								<option value="estate">Estate</option>
								<option value="gym">Gym</option>
								<option value="hotel">Hotel</option>
								<option value="hosting">Hosting</option>
								<option value="landing">Landing Page</option>
								<option value="lawyer">Lawyer</option>
								<option value="marketing">Marketing</option>
								<option value="mechanic">Mechanic</option>
								<option value="medic">Medic</option>
								<option value="onepage">One Page</option>
								<option value="parallax">Parrallax</option>
								<option value="photo">Photo</option>
								<option value="portfolio">Portfolio</option>
								<option value="press">Press</option>
								<option value="renovate">Renovate</option>
								<option value="restaurant">Restaurant</option>
								<option value="resume">Resume</option>
								<option value="school">School</option>
								<option value="shop">Shop</option>
								<option value="transport">Transport</option>
								<option value="travel">Travel</option>
								<option value="wedding">Wedding</option>
							</select>
						</td>
					</tr>
					
					<tr class="row-attachments hide">
						<th scope="row">Attachments</th>
						<td>
							<fieldset>
								<label for="attachments"><input type="checkbox" value="1" id="attachments" name="attachments">Import attachments</label>
								<p class="description">Download all attachments from the demo may take a while. Please be patient.</p>
							</fieldset>
						</td>
					</tr>
				
				</table>
	
				<input type="submit" name="submit" class="button button-primary" value="Import demo data" />
					
			</form>
	
		</div>	
		<?php	
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Parse JSON import file
	 * http://wordpress.org/plugins/widget-settings-importexport/
	 * ---------------------------------------------------------------------------- */
	function import_widget_data( $json_data ) {
	
		$json_data 		= json_decode( $json_data, true );
		$sidebar_data 	= $json_data[0];
		$widget_data 	= $json_data[1];	
// 		print_r($json_data);
	
		// prepare widgets table
		$widgets = array();
		foreach( $widget_data as $k_w => $widget_type ){
			if( $k_w ){
				$widgets[ $k_w ] = array();
				foreach( $widget_type as $k_wt => $widget ){
					if( is_int( $k_wt ) ) $widgets[$k_w][$k_wt] = 1;
				}
			}
		}
// 		print_r($widgets);

		// sidebars
		foreach ( $sidebar_data as $title => $sidebar ) {
			$count = count( $sidebar );
			for ( $i = 0; $i < $count; $i++ ) {
				$widget = array( );
				$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
				$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
				if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
					unset( $sidebar_data[$title][$i] );
				}
			}
			$sidebar_data[$title] = array_values( $sidebar_data[$title] );
		}
	
		// widgets
		foreach ( $widgets as $widget_title => $widget_value ) {
			foreach ( $widget_value as $widget_key => $widget_value ) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}
// 		print_r($sidebar_data);
		
		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
		$this->parse_import_data( $sidebar_data );
	}
	
	/** ---------------------------------------------------------------------------
	 * Import widgets
	 * http://wordpress.org/plugins/widget-settings-importexport/
	 * ---------------------------------------------------------------------------- */
	function parse_import_data( $import_array ) {
		$sidebars_data 		= $import_array[0];
		$widget_data 		= $import_array[1];
		
		mfn_register_sidebars(); // fix for sidebars added in Theme Options
		$current_sidebars 	= get_option( 'sidebars_widgets' );
		$new_widgets 		= array( );

// 		print_r($sidebars_data);
// 		print_r($current_sidebars);
	
		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :
	
			foreach ( $import_widgets as $import_widget ) :
			
				// if NOT the sidebar exists
				if ( ! isset( $current_sidebars[$import_sidebar] ) ){
					$current_sidebars[$import_sidebar] = array();
				}

				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = $this->get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );
			
				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if ( array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					
					// notice fix
					if( ! key_exists('_multiwidget',$new_widgets[$title]) ) $new_widgets[$title]['_multiwidget'] = '';
					
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					
					// notice fix
					if( ! key_exists('_multiwidget',$current_widget_data) ) $current_widget_data['_multiwidget'] = '';
					
					$current_multiwidget = $current_widget_data['_multiwidget'];
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}
				
			endforeach;
		endforeach;
	
		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );
	
			foreach ( $new_widgets as $title => $content )
				update_option( 'widget_' . $title, $content );
	
			return true;
		}
	
		return false;
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Get new widget name
	 * http://wordpress.org/plugins/widget-settings-importexport/
	 * ---------------------------------------------------------------------------- */
	function get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}
	
}

$mfn_import = new mfnImport;
?>
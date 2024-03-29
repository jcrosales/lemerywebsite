<?php
/**
 * Widget Muffin Menu
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

class Mfn_Menu_Widget extends WP_Widget {

	
	/* ---------------------------------------------------------------------------
	 * Constructor
	 * --------------------------------------------------------------------------- */
	function Mfn_Menu_Widget() {
		$widget_ops = array( 'classname' => 'widget_mfn_menu', 'description' => __( 'Use this widget on pages to display aside menu with children or siblings of the current page', 'mfn-opts' ) );
		$this->WP_Widget( 'widget_mfn_menu', __( 'Muffin Menu', 'mfn-opts' ), $widget_ops );
		$this->alt_option_name = 'widget_mfn_menu';
	}
	
	
	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = null;
		extract( $args, EXTR_SKIP );

		$title = "";
		if( $instance['use_page_title'] ){
			$title = wp_title( '', false );
		} elseif( $instance['title'] ) {
			$title = $instance['title'];
		}

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base);

		echo $before_widget;
		
		if( $title ) echo $before_title . $title . $after_title;

		$parentID = false;
		if( $instance['use_page_sibling']==1 ){
			// sibling
			$aPost = get_post( get_the_ID() );
			if( is_array($aPost->ancestors) && key_exists(0, $aPost->ancestors) ){
				$parentID = $aPost->ancestors[0];
			}
		} else {
			// children
			$parentID = get_the_ID();
		}
		
		$aPages_attr = array(
			'title_li' 		=> '',	
			'depth' 		=> 1,
			'child_of'		=> $parentID,
			'link_before' 	=> '',
			'echo'			=> 0,
		);

		$aPages = wp_list_pages( $aPages_attr );
		
		// if there is no children
		if( ( $instance['use_page_sibling']==2 ) && ( ! $aPages ) ){
			$aPost = get_post( get_the_ID() );
			if( $aPost->ancestors ) $parentID = $aPost->ancestors[0];
			
			$aPages_attr['child_of'] = $parentID;
			$aPages = wp_list_pages( $aPages_attr );
		}
					
		if( $aPages ): ?>
			<ul class="menu">
				<?php echo $aPages; ?>
			</ul>
		<?php endif;
		
		echo $after_widget;
	}


	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['use_page_title'] = (int) $new_instance['use_page_title'];
		$instance['use_page_sibling'] = (int) $new_instance['use_page_sibling'];
		return $instance;
	}

	
	/* ---------------------------------------------------------------------------
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 * --------------------------------------------------------------------------- */
	function form( $instance ) {
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		$use_page_title = isset( $instance['use_page_title'] ) ? absint( $instance['use_page_title'] ) : 0;
		$use_page_sibling = isset( $instance['use_page_sibling'] ) ? absint( $instance['use_page_sibling'] ) : 2;
?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mfn-opts' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'use_page_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'use_page_title' ) ); ?>" type="checkbox" value="1" <?php if( esc_attr( $use_page_title ) ) echo "checked='checked'" ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'use_page_title' ) ); ?>"><?php _e( 'Use current page title', 'mfn-opts' ); ?></label>	
			</p>
			
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'use_page_sibling' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'use_page_sibling' ) ); ?>" type="radio" value="1" <?php if( $use_page_sibling==1  ) echo "checked='checked'" ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'use_page_sibling' ) ); ?>"><?php _e( 'Show page siblings', 'mfn-opts' ); ?></label>	
				<br/>
				<input id="<?php echo esc_attr( $this->get_field_id( 'use_page_childrens' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'use_page_sibling' ) ); ?>" type="radio" value="0" <?php if( ! $use_page_sibling ) echo "checked='checked'" ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'use_page_childrens' ) ); ?>"><?php _e( 'Show page children', 'mfn-opts' ); ?></label>	
				<br/>
				<input id="<?php echo esc_attr( $this->get_field_id( 'use_page_childrens2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'use_page_sibling' ) ); ?>" type="radio" value="2" <?php if( $use_page_sibling==2 ) echo "checked='checked'" ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'use_page_childrens2' ) ); ?>"><?php _e( 'Show page children (if there is no children, show siblings)', 'mfn-opts' ); ?></label>	
			</p>
		<?php
	}
}
?>
<?php
/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function inter_add_page_meta_boxes( $post ){

	add_meta_box( 'page_options', __( 'InterTheme Page Options', 'inter_theme' ), 'inter_page_meta_box_build', array('page', 'post'), 'normal', 'low' );
}

add_action( 'add_meta_boxes', 'inter_add_page_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function inter_page_meta_box_build( $post ){

	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'inter_meta_box_nonce' );

	// retrieve the _food_cholesterol current value
	$current_show_header = get_post_meta( $post->ID, '_show_header', true );

	// retrieve the _cholesterol current value
	$current_show_title = get_post_meta( $post->ID, '_show_title', true );

	// retrieve the _cholesterol current value
	$current_show_breadcrumbs = get_post_meta( $post->ID, '_show_breadcrumbs', true );

	// retrieve the _cholesterol current value
	$current_show_featured_image = get_post_meta( $post->ID, '_show_featured_image', true );

	// retrieve the _cholesterol current value
	$current_page_layout = get_post_meta( $post->ID, '_page_layout', true );

	// retrieve the _cholesterol current value
	$current_show_sidebar = get_post_meta( $post->ID, '_show_sidebar', true );

	// retrieve the _cholesterol current value
	$current_sidebar_position = get_post_meta( $post->ID, '_sidebar_position', true );

	// retrieve the _cholesterol current value
	$current_top_padding = get_post_meta( $post->ID, '_top_padding', true );

	// retrieve the _cholesterol current value
	$current_bottom_padding = get_post_meta( $post->ID, '_bottom_padding', true ); ?>

	<div class='inside inter-page-options'>

		<p class="inter-page-options__header"><?php _e( 'Show Header?', 'inter_theme' ); ?></p>
		<p>
			<input type="radio" name="show_header" value="0" <?php checked( $current_show_header, '0' ); ?> /> No 
			<input type="radio" name="show_header" value="1" <?php checked( $current_show_header, '1' ); ?> /> Yes
		</p>
		<hr>
		<p class="inter-page-options__header"><?php _e( 'Show Title?', 'inter_theme' ); ?></p>
		<p>
			<input type="radio" name="show_title" value="0" <?php checked( $current_show_title, '0' ); ?> /> No 
			<input type="radio" name="show_title" value="1" <?php checked( $current_show_title, '1' ); ?> /> Yes
		</p>
		<hr>
		<p class="inter-page-options__header"><?php _e( 'Show Breadcrumbs?', 'inter_theme' ); ?></p>
		<p>
			<input type="radio" name="show_breadcrumbs" value="0" <?php checked( $current_show_breadcrumbs, '0' ); ?> /> No 
			<input type="radio" name="show_breadcrumbs" value="1" <?php checked( $current_show_breadcrumbs, '1' ); ?> /> Yes
		</p>
		<hr>
		<p class="inter-page-options__header"><?php _e( 'Show Featured Image?', 'inter_theme' ); ?></p>
		<p>
			<input type="radio" name="show_featured_image" value="0" <?php checked( $current_show_featured_image, '0' ); ?> /> No 
			<input type="radio" name="show_featured_image" value="1" <?php checked( $current_show_featured_image, '1' ); ?> /> Yes
		</p>
		<hr>
		<p class="inter-page-options__header"><?php _e( 'Page Layout', 'inter_theme' ); ?></p>
		<p>
			<input type="radio" name="page_layout" value="boxed" <?php checked( $current_page_layout, 'boxed' ); ?> /> Boxed 
			<input type="radio" name="page_layout" value="full-width" <?php checked( $current_page_layout, 'full-width' ); ?> /> Full Width
		</p>
		<hr>
		<p class="inter-page-options__header"><?php _e( 'Show Sidebar?', 'inter_theme' ); ?></p>
		<p>
			<input type="radio" name="show_sidebar" value="0" <?php checked( $current_show_sidebar, '0' ); ?> /> No 
			<input type="radio" name="show_sidebar" value="1" <?php checked( $current_show_sidebar, '1' ); ?> /> Yes
		</p>
		<hr>
		<p class="inter-page-options__header"><?php _e( 'Sidebar position', 'inter_theme' ); ?></p>
		<p>
			<input type="radio" name="sidebar_position" value="left" <?php checked( $current_sidebar_position, 'left' ); ?> /> Left 
			<input type="radio" name="sidebar_position" value="right" <?php checked( $current_sidebar_position, 'right' ); ?> /> Right
		</p>
		<hr>
		<p class="inter-page-options__header"><?php _e( 'Page Padding', 'inter_theme' ); ?></p>
		<p>
			<input <?php if( $current_top_padding != "" ): ?>value="<?php echo $current_top_padding; ?>"<?php endif; ?> type="text" name="top_padding" placeholder="<?php _e('Top Padding (in px)', 'inter_theme')?>" ><br/><br/>
			<input <?php if( $current_bottom_padding != "" ): ?>value="<?php echo $current_bottom_padding; ?>"<?php endif; ?> type="text" name="bottom_padding" placeholder="<?php _e('Bottom Padding (in px)', 'inter_theme')?>" >
		</p>

	</div>
	<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function inter_save_meta_box_data( $post_id ){

	// verify meta box nonce
	if ( !isset( $_POST['inter_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['inter_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
  // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['show_header'] ) ) {
		update_post_meta( $post_id, '_show_header', sanitize_text_field( $_POST['show_header'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['show_title'] ) ) {
		update_post_meta( $post_id, '_show_title', sanitize_text_field( $_POST['show_title'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['show_breadcrumbs'] ) ) {
		update_post_meta( $post_id, '_show_breadcrumbs', sanitize_text_field( $_POST['show_breadcrumbs'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['show_featured_image'] ) ) {
		update_post_meta( $post_id, '_show_featured_image', sanitize_text_field( $_POST['show_featured_image'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['page_layout'] ) ) {
		update_post_meta( $post_id, '_page_layout', sanitize_text_field( $_POST['page_layout'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['show_sidebar'] ) ) {
		update_post_meta( $post_id, '_show_sidebar', sanitize_text_field( $_POST['show_sidebar'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['sidebar_position'] ) ) {
		update_post_meta( $post_id, '_sidebar_position', sanitize_text_field( $_POST['sidebar_position'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['top_padding'] ) ) {
		update_post_meta( $post_id, '_top_padding', sanitize_text_field( $_POST['top_padding'] ) );
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['bottom_padding'] ) ) {
		update_post_meta( $post_id, '_bottom_padding', sanitize_text_field( $_POST['bottom_padding'] ) );
	}

}

add_action( 'save_post', 'inter_save_meta_box_data' );


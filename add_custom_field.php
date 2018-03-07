<?php

/**

 * Adds a box to the main column on the Post and Page edit screens.

 */

function rp_add_meta_box() {



	$screens = array( 'post', 'page' );



	foreach ( $screens as $screen ) {



		add_meta_box(

			'rp_meta_box',

			__( 'Select One to Three Related Posts (Optional)', 'rp_post_id' ),

			'rp_meta_box_callback',

			$screen, 'normal', 'high'

		);

	}

}

add_action( 'add_meta_boxes', 'rp_add_meta_box' );





/**

 * Prints the box content.

 * 

 * @param WP_Post $post The object for the current post/page.

 */

function rp_meta_box_callback( $post ) {



	// Add an nonce field so we can check for it later.

	wp_nonce_field( 'rp_meta_box', 'rp_meta_box_nonce' );



	/*

	 * Use get_post_meta() to retrieve an existing value

	 * from the database and use the value for the form.

	 */

	$post_link_one = get_post_meta( $post->ID, 'post_link_one', true );
	$post_link_two = get_post_meta( $post->ID, 'post_link_two', true );
	$post_link_three = get_post_meta( $post->ID, 'post_link_three', true );

       

	echo '<label for="rp_new_field_one">';

	_e( 'Post One:', 'post_id_one' );

	echo '</label> ';

	echo '<input type="text" id="rp_new_field_one" name="post_id_one" class="rp_post_box" value="' . get_the_title(esc_attr( $post_link_one )) . '" size="55" autocomplete="off" /> &nbsp; Shortcode:&nbsp; <input type="text" value="[related_post_one]" size="18" />';
	
	echo '<input type="hidden" name="post_link_one" value="'.$post_link_one.'" id="post_link_one" />';
		
	echo "<div class='rp_post_result_one' id='rp_post_result_one'></div>";
	
	echo "<br />";

	echo '<label for="rp_new_field_two">';

	_e( 'Post Two:', 'post_id_two' );

	echo '</label> ';

	echo '<input type="text" id="rp_new_field_two" name="post_id_two" class="rp_post_box" value="' . get_the_title(esc_attr( $post_link_two )) . '" size="55" autocomplete="off" /> &nbsp; Shortcode:&nbsp; <input type="text" value="[related_post_two]" size="18" />';
	
	echo '<input type="hidden" name="post_link_two" id="post_link_two" value="'.$post_link_two.'" />';
	
	echo "<div class='rp_post_result_two' id='rp_post_result_two'></div>";

	echo "<br />";

	echo '<label for="rp_new_field_three">';

	_e( 'Post Three:', 'post_id_three' );

	echo '</label> ';

	echo '<input type="text" id="rp_new_field_three" name="post_id_three" class="rp_post_box" value="' . get_the_title(esc_attr( $post_link_three )) . '" size="55" autocomplete="off" /> &nbsp; Shortcode:&nbsp; <input type="text" value="[related_post_three]" size="18" />';
	
	echo '<input type="hidden" name="post_link_three" id="post_link_three" value="'.$post_link_three.'" />';

	echo "<div class='rp_post_result_three' id='rp_post_result_three'></div>";


}



/**

 * When the post is saved, saves our custom data.

 *

 * @param int $post_id The ID of the post being saved.

 */

function rp_save_meta_box_data( $post_id ) {



	/*

	 * We need to verify this came from our screen and with proper authorization,

	 * because the save_post action can be triggered at other times.

	 */



	// Check if our nonce is set.

	if ( ! isset( $_POST['rp_meta_box_nonce'] ) ) {

		return;

	}



	// Verify that the nonce is valid.

	if ( ! wp_verify_nonce( $_POST['rp_meta_box_nonce'], 'rp_meta_box' ) ) {

		return;

	}



	// If this is an autosave, our form has not been submitted, so we don't want to do anything.

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

		return;

	}



	// Check the user's permissions.

	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {



		if ( ! current_user_can( 'edit_page', $post_id ) ) {

			return;

		}



	} else {



		if ( ! current_user_can( 'edit_post', $post_id ) ) {

			return;

		}

	}



	/* OK, it's safe for us to save the data now. */

	

	// Make sure that it is set.

	if ( ! isset( $_POST['post_link_one']) || ! isset( $_POST['post_link_two']) || ! isset( $_POST['post_link_three'])) {

		return;

	}



	// Sanitize user input.

	$post_link_one = sanitize_text_field( $_POST['post_link_one'] );

	$post_link_two = sanitize_text_field( $_POST['post_link_two'] );

	$post_link_three = sanitize_text_field( $_POST['post_link_three'] );



	// Update the meta field in the database.

	update_post_meta( $post_id, 'post_link_one', $post_link_one );

	update_post_meta( $post_id, 'post_link_two', $post_link_two );

	update_post_meta( $post_id, 'post_link_three', $post_link_three );

}

	
	add_action( 'save_post', 'rp_save_meta_box_data' );

?>
<?php

/**

 * Adds a box to the main column on the Post and Page edit screens.

 */

function rlic_tareqanwar_add_meta_box() {



	$screens = array( 'post', 'page' );



	foreach ( $screens as $screen ) {



		add_meta_box(

			'rlic_tareqanwar_meta_box',

			__( 'Select One to Three Related Posts (Optional)', 'rlic_tareqanwar_post_id' ),

			'rlic_tareqanwar_meta_box_callback',

			$screen, 'normal', 'high'

		);

	}

}

add_action( 'add_meta_boxes', 'rlic_tareqanwar_add_meta_box' );





/**

 * Prints the box content.

 * 

 * @param WP_Post $post The object for the current post/page.

 */

function rlic_tareqanwar_meta_box_callback( $post ) {



	// Add an nonce field so we can check for it later.

	wp_nonce_field( 'rlic_tareqanwar_meta_box', 'rlic_tareqanwar_meta_box_nonce' );



	/*

	 * Use get_post_meta() to retrieve an existing value

	 * from the database and use the value for the form.

	 */

	$rlic_tareqanwar_post_link_one = get_post_meta( $post->ID, 'rlic_tareqanwar_post_link_one', true );
	$rlic_tareqanwar_post_link_two = get_post_meta( $post->ID, 'rlic_tareqanwar_post_link_two', true );
	$rlic_tareqanwar_post_link_three = get_post_meta( $post->ID, 'rlic_tareqanwar_post_link_three', true );

       

	echo '<label for="rlic_tareqanwar_new_field_one" class="rlic_tareqanwar_label">';

	_e( 'Post One: &nbsp;&nbsp;', 'rlic_tareqanwar_post_id_one' );

	echo '</label> ';

	echo '<input type="text" id="rlic_tareqanwar_new_field_one" name="rlic_tareqanwar_post_id_one" class="rlic_tareqanwar_post_box" value="' . get_the_title(esc_attr( $rlic_tareqanwar_post_link_one )) . '" size="55" autocomplete="off" /> <label class="rlic_tareqanwar_label">&nbsp;Shortcode:</label> <input type="text" value="[rlic_related_post_one]" size="18" readonly/>';
	
	echo '<input type="hidden" name="rlic_tareqanwar_post_link_one" value="'.$rlic_tareqanwar_post_link_one.'" id="rlic_tareqanwar_post_link_one" />';
		
	echo "<div class='rlic_tareqanwar_post_result_one' id='rlic_tareqanwar_post_result_one'></div>";
	
	echo "<br />";

	echo '<label for="rlic_tareqanwar_new_field_two" class="rlic_tareqanwar_label">';

	_e( 'Post Two: &nbsp;&nbsp;', 'rlic_tareqanwar_post_id_two' );

	echo '</label> ';

	echo '<input type="text" id="rlic_tareqanwar_new_field_two" name="rlic_tareqanwar_post_id_two" class="rlic_tareqanwar_post_box" value="' . get_the_title(esc_attr( $rlic_tareqanwar_post_link_two )) . '" size="55" autocomplete="off" /> <label class="rlic_tareqanwar_label">&nbsp;Shortcode:</label> <input type="text" value="[rlic_related_post_two]" size="18" readonly/>';
	
	echo '<input type="hidden" name="rlic_tareqanwar_post_link_two" id="rlic_tareqanwar_post_link_two" value="'.$rlic_tareqanwar_post_link_two.'" />';
	
	echo "<div class='rlic_tareqanwar_post_result_two' id='rlic_tareqanwar_post_result_two'></div>";

	echo "<br />";

	echo '<label for="rlic_tareqanwar_new_field_three" class="rlic_tareqanwar_label">';

	_e( 'Post Three:', 'rlic_tareqanwar_post_id_three' );

	echo '</label> ';

	echo '<input type="text" id="rlic_tareqanwar_new_field_three" name="rlic_tareqanwar_post_id_three" class="rlic_tareqanwar_post_box" value="' . get_the_title(esc_attr( $rlic_tareqanwar_post_link_three )) . '" size="55" autocomplete="off" /> <label class="rlic_tareqanwar_label">&nbsp;Shortcode:</label> <input type="text" value="[rlic_related_post_three]" size="18" readonly/>';
	
	echo '<input type="hidden" name="rlic_tareqanwar_post_link_three" id="rlic_tareqanwar_post_link_three" value="'.$rlic_tareqanwar_post_link_three.'" />';

	echo "<div class='rlic_tareqanwar_post_result_three' id='rlic_tareqanwar_post_result_three'></div>";


}



/**

 * When the post is saved, saves our custom data.

 *

 * @param int $post_id The ID of the post being saved.

 */

function rlic_tareqanwar_save_meta_box_data( $post_id ) {



	/*

	 * We need to verify this came from our screen and with proper authorization,

	 * because the save_post action can be triggered at other times.

	 */



	// Check if our nonce is set.

	if ( ! isset( $_POST['rlic_tareqanwar_meta_box_nonce'] ) ) {

		return;

	}



	// Verify that the nonce is valid.

	if ( ! wp_verify_nonce( $_POST['rlic_tareqanwar_meta_box_nonce'], 'rlic_tareqanwar_meta_box' ) ) {

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

	if ( ! isset( $_POST['rlic_tareqanwar_post_link_one']) || ! isset( $_POST['rlic_tareqanwar_post_link_two']) || ! isset( $_POST['rlic_tareqanwar_post_link_three'])) {

		return;

	}



	// Sanitize user input.
    
	$rlic_tareqanwar_post_link_one = sanitize_text_field( $_POST['rlic_tareqanwar_post_link_one'] );

	$rlic_tareqanwar_post_link_two = sanitize_text_field( $_POST['rlic_tareqanwar_post_link_two'] );

	$rlic_tareqanwar_post_link_three = sanitize_text_field( $_POST['rlic_tareqanwar_post_link_three'] );



	// Update the meta field in the database. Validte before updating.

	if(is_numeric($rlic_tareqanwar_post_link_one)) update_post_meta( $post_id, 'rlic_tareqanwar_post_link_one', $rlic_tareqanwar_post_link_one );

	if(is_numeric($rlic_tareqanwar_post_link_two)) update_post_meta( $post_id, 'rlic_tareqanwar_post_link_two', $rlic_tareqanwar_post_link_two );

	if(is_numeric($rlic_tareqanwar_post_link_three)) update_post_meta( $post_id, 'rlic_tareqanwar_post_link_three', $rlic_tareqanwar_post_link_three );

}

	
	add_action( 'save_post', 'rlic_tareqanwar_save_meta_box_data' );

?>
<?php

/* Create the meta box on new post */
function awp_gma_create_image_metabox() {
   
   add_meta_box(
       'awp_gma_image_meta',       		// $id
       'Minimo tube settings',          // $title
       'awp_gma_create_image_metabox_cb',// $callback
       'post',                 			// $screen
       'normal',                  		// $context
       'high'                     		// $priority
   );
}
add_action('add_meta_boxes', 'awp_gma_create_image_metabox');

/* Display the metabox on new post */
function awp_gma_create_image_metabox_cb($post) {
    
	// load the metadata is exists
	$awp_gma_image_meta = get_post_meta( $post->ID, '_awp_gma_image_meta', true );

    ?>
    Image
    <input id="awp_gma_image_meta" type="text" size="75" name="awp_gma_image_meta" value="<?php echo esc_url($awp_gma_image_meta) ?>" />
    <input class="button-secondary" id="upload_image_button" type="button" size="75" name="" value="Media Library Image" class="button-secondary"/>
    <br>
    Enter an image URL or use an image from the Media Library

    <?php

}

/* Saving the metabox data */
function awp_gma_save_image_metabox($post_id){

	// verify the meta is set
	if (isset($_POST['awp_gma_image_meta'])){

		// save the metadata
		//update_post_meta( $post_id, $meta_key, $meta_value, $prev_value );
		// esc_url_raw sanitizes the url
		update_post_meta( $post_id, 'awp_gma_image_meta', esc_url_raw( $_POST['awp_gma_image_meta'] ));

	}

}
add_action( 'save_post', 'awp_gma_save_image_metabox' );

// function awp_gma_save_post_class_meta( $post_id, $post ) {

//   /* Verify the nonce before proceeding. */
//   if ( !isset( $_POST['awp_gma_post_class_nonce'] ) || !wp_verify_nonce( $_POST['awp_gma_post_class_nonce'], basename( __FILE__ ) ) )
//     return $post_id;

//   /* Get the post type object. */
//   $post_type = get_post_type_object( $post->post_type );

//   /* Check if the current user has permission to edit the post. */
//   if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
//     return $post_id;

//   /* Get the posted data and sanitize it for use as an HTML class. */
//   $new_meta_value = ( isset( $_POST['awp_gma-post-class'] ) ? sanitize_html_class( $_POST['awp_gma-post-class'] ) : '' );

//   /* Get the meta key. */
//   $meta_key = 'awp_gma_post_class';

//   /* Get the meta value of the custom field key. */
//   $meta_value = get_post_meta( $post_id, $meta_key, true );

//   /* If a new meta value was added and there was no previous value, add it. */
//   if ( $new_meta_value && '' == $meta_value )
//     add_post_meta( $post_id, $meta_key, $new_meta_value, true );

//   /* If the new meta value does not match the old value, update it. */
//   elseif ( $new_meta_value && $new_meta_value != $meta_value )
//     update_post_meta( $post_id, $meta_key, $new_meta_value );

//   /* If there is no new meta value but an old value exists, delete it. */
//   elseif ( '' == $new_meta_value && $meta_value )
//     delete_post_meta( $post_id, $meta_key, $meta_value );
// }
// add_action( 'save_post', 'awp_gma_save_post_class_meta', 10, 2 );

// /* Filter the post class hook with our custom post class function. */
// function awp_gma_post_class( $classes ) {

//   /* Get the current post ID. */
//   $post_id = get_the_ID();

//   /* If we have a post ID, proceed. */
//   if ( !empty( $post_id ) ) {

//     /* Get the custom post class. */
//     $post_class = get_post_meta( $post_id, 'awp_gma_post_class', true );

//     /* If a post class was input, sanitize it and add it to the post class array. */
//     if ( !empty( $post_class ) )
//       $classes[] = sanitize_html_class( $post_class );
//   }

//   return $classes;
// }
// add_filter( 'post_class', 'awp_gma_post_class' );
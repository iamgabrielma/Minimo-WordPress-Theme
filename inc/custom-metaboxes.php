<?php

/* Create the meta box on new post */
function awp_gma_create_image_metabox() {
   
   add_meta_box(
       'awp_gma_image_meta',       		// $id
       'Upload an image',          		// $title
       'awp_gma_create_image_metabox_cb',// $callback
       'post',                 			// $screen
       'normal',                  		// $context
       'high'                     		// $priority
   );
}
add_action('add_meta_boxes', 'awp_gma_create_image_metabox');

function awp_gma_create_link_metabox() {
   
   add_meta_box(
       'awp_gma_link_meta',       		// $id
       'Upload an link',          		// $title
       'awp_gma_create_link_metabox_cb',// $callback
       'post',                 			// $screen
       'normal',                  		// $context
       'high'                     		// $priority
   );
}
add_action('add_meta_boxes', 'awp_gma_create_link_metabox');

/* Display the metabox on new post */
function awp_gma_create_image_metabox_cb($post) {
    
	// load the metadata is exists
	$awp_gma_image_meta = get_post_meta( $post->ID, 'awp_gma_image_meta', true );

    ?>
    Image
    <input id="awp_gma_image_meta" type="text" size="75" name="awp_gma_image_meta" value="<?php echo esc_url($awp_gma_image_meta) ?>" />
    <input class="button-secondary" id="upload_image_button" type="button" size="75" name="" value="Media Library Image" class="button-secondary"/>
    <br>
    Enter an image URL or use an image from the Media Library
    <strong>DEBUG:</strong> P90 - chapter 4 JS functionality

    <?php

}

/* Saving the metabox data */
function awp_gma_save_image_metabox($post_id){

	if (isset($_POST['awp_gma_image_meta'])){

		update_post_meta( $post_id, 'awp_gma_image_meta', esc_url_raw($_POST['awp_gma_image_meta']) );

	}

}
add_action( 'save_post', 'awp_gma_save_image_metabox' );

function awp_gma_create_link_metabox_cb($post) {
    
	// load the metadata is exists
	$awp_gma_link_meta = get_post_meta( $post->ID, 'awp_gma_link_meta', true );

    ?>
    link
    <input id="awp_gma_link_meta" type="text" size="75" name="awp_gma_link_meta" value="<?php echo esc_url($awp_gma_link_meta) ?>" />
    <input class="button-secondary" id="upload_link_button" type="button" size="75" name="" value="Save Link" class="button-secondary"/>
    <br>
    Enter a link, for example http://youtube.com/sdjddkf
    <strong>DEBUG:</strong> P90 - chapter 4 JS functionality

    <?php

}
function awp_gma_save_link_metabox($post_id){

	if (isset($_POST['awp_gma_link_meta'])){

		update_post_meta( $post_id, 'awp_gma_link_meta', esc_url_raw($_POST['awp_gma_link_meta']) );

	}

}
add_action( 'save_post', 'awp_gma_save_link_metabox' );
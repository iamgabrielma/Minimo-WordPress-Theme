<?php

/**
 * Minimo Theme Customizer.
 *
 * @package Minimo
 */

/**
 * Adds metaboxes to post for tube functionalities.
 *
 * 
 */

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

function awp_gma_create_seo_metabox() {
   
   add_meta_box(
       'awp_gma_seo_meta',           // $id
       'Search Engine Optimization',              // $title
       'awp_gma_create_seo_metabox_cb',// $callback
       'post',                      // $screen
       'normal',                      // $context
       'high'                         // $priority
   );
}
add_action('add_meta_boxes', 'awp_gma_create_seo_metabox');

/* Display the metabox on new post */
function awp_gma_create_image_metabox_cb($post) {
    
	// load the metadata is exists
	$awp_gma_image_meta = get_post_meta( $post->ID, 'awp_gma_image_meta', true );

    ?>
    Image Take this <strong>OFF</strong> and create a plugin with it, makes more sense.
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
    link Take this <strong>OFF</strong> and create a plugin with it, makes more sense.
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

function awp_gma_create_seo_metabox_cb($post) {
    
  // load the metadata is exists
  $awp_gma_seo_meta = get_post_meta( $post->ID, 'awp_gma_seo_meta', true );

    ?>
    Title tag
    <input id="awp_gma_seo_meta" type="text" size="75" name="awp_gma_seo_meta" value="<?php echo esc_url($awp_gma_seo_meta) ?>" />
    Meta description
    <input id="awp_gma_seo_meta" type="text" size="75" name="awp_gma_seo_meta" value="<?php echo esc_url($awp_gma_seo_meta) ?>" />
    Google Search Results preview
    $title
    $url
    $description
    Most common keywords
    Keyword Usage
    <input class="button-secondary" id="upload_seo_button" type="button" size="75" name="" value="Save" class="button-secondary"/>
    <br>
    sentence, for example 'This is my store'
    <strong>DEBUG:</strong> P90 - chapter 4 JS functionality

    <?php

}
function awp_gma_save_seo_metabox($post_id){

  if (isset($_POST['awp_gma_seo_meta'])){

    update_post_meta( $post_id, 'awp_gma_seo_meta', esc_url_raw($_POST['awp_gma_seo_meta']) );

  }

}
add_action( 'save_post', 'awp_gma_save_seo_metabox' );
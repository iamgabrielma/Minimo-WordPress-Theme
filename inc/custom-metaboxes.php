<?php

/**
 * Minimo Theme Customizer.
 *
 * @package Minimo
 */


function awp_gma_create_seo_metabox() {
   
   add_meta_box(
       'awp_gma_seo_meta',           // $id
       'Search Engine Optimization',              // $title
       'awp_gma_display_seo_metabox',// $callback
       'post',                      // $screen
       'normal',                      // $context
       'high'                         // $priority
   );
}
add_action('add_meta_boxes', 'awp_gma_create_seo_metabox');

function awp_gma_display_seo_metabox($post) {
    
  // load the metadata is exists
  $awp_gma_seo_meta = get_post_meta( $post->ID, 'awp_gma_seo_meta', true );

    ?>
    <div class="wrap">
      
    </div>
    Title tag: The meta title of your page has a length of 58 characters. Most search engines will truncate meta titles to 70 characters.
    <br>
  <?php echo get_the_title( $post->ID ); ?>
    <br>

    Meta description: The meta description of your page has a length of 58 characters. Most search engines will truncate meta descriptions to 160 characters.
    <?php echo 'description ' . the_excerpt(); ?>
    <br>
    <input id="awp_gma_seo_meta" type="text" size="75" name="awp_gma_seo_meta" value="<?php echo esc_url($awp_gma_seo_meta) ?>" />
    Google Search Results preview
    <?php echo get_the_title( $post->ID ); ?>
    <?php echo get_permalink( $post->ID ); ?>
    <?php echo the_excerpt(); ?>
    
    Most common keywords
    Keyword Usage
    <input class="button-secondary" id="upload_seo_button" type="button" size="75" name="" value="Save" class="button-secondary"/>
    <br>
    
    <strong>DEBUG:</strong> P90 - chapter 4 JS functionality

    <?php

}
function awp_gma_save_seo_metabox($post_id){

  if (isset($_POST['awp_gma_seo_meta'])){

    update_post_meta( $post_id, 'awp_gma_seo_meta', esc_url_raw($_POST['awp_gma_seo_meta']) );

  }

}
add_action( 'save_post', 'awp_gma_save_seo_metabox' );
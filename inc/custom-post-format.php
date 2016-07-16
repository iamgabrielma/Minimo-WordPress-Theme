<?php

// register custom post type 'my_custom_post_type'
/* NOT ALLOWED BY WORDPRESS, YES CUSTOM POST TYPES, NOT CUSTOM POST FORMATS */

function create_my_post_type() {
    
    register_post_type( 'my_custom_post_type',
      array(
        'labels' => array( 'name' => __( 'Products' ) ),
        'public' => true
    )
  );

}
add_action( 'init', 'create_my_post_type' );
//add post-formats to post_type 'my_custom_post_type'
//add_post_type_support( 'my_custom_post_type', 'post-formats' );
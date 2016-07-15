<?php

if (!function_exists('awp_gma_create_tube_post_type')) {


		/**
		* Registers a new post type
		* @uses $wp_post_types Inserts new post type object into the list
		*
		* @param string  Post type key, must not exceed 20 characters
		* @param array|string  See optional args description above.
		* @return object|WP_Error the registered post type object, or an error object
		*/
		function awp_gma_create_tube_post_type() {
		
			$labels = array(
				'name'                => __( 'Plural Name', 'text-domain' ),
				'singular_name'       => __( 'Singular Name', 'text-domain' ),
				'add_new'             => _x( 'Add New Singular Name', 'text-domain', 'text-domain' ),
				'add_new_item'        => __( 'Add New Singular Name', 'text-domain' ),
				'edit_item'           => __( 'Edit Singular Name', 'text-domain' ),
				'new_item'            => __( 'New Singular Name', 'text-domain' ),
				'view_item'           => __( 'View Singular Name', 'text-domain' ),
				'search_items'        => __( 'Search Plural Name', 'text-domain' ),
				'not_found'           => __( 'No Plural Name found', 'text-domain' ),
				'not_found_in_trash'  => __( 'No Plural Name found in Trash', 'text-domain' ),
				'parent_item_colon'   => __( 'Parent Singular Name:', 'text-domain' ),
				'menu_name'           => __( 'Plural Name', 'text-domain' ),
			);
		
			$args = array(
				'labels'              => $labels,
				'hierarchical'        => false,
				'description'         => 'description',
				'taxonomies'          => array(),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => null,
				'menu_icon'           => null,
				'show_in_nav_menus'   => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'has_archive'         => true,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite'             => true,
				'capability_type'     => 'post',
				'supports'            => array(
					'title', 'editor', 'author', 'thumbnail',
					'excerpt','custom-fields', 'trackbacks', 'comments',
					'revisions', 'page-attributes', 'post-formats'
					)
			);
		
			register_post_type( 'awp_tube', $args );
		}
		
		add_action( 'init', 'awp_gma_create_tube_post_type' );

		function awp_gma_add_tube_post_type_metabox(){

			//add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
			add_meta_box( 'tube_metabox', 'Metabox', 'awp_gma_tube_metabox', 'tube', 'normal' );
		}
		// cb
		function awp_gma_tube_metabox(){
			global $post;
		// Noncename needed to verify where the data originated
		echo '<input type="hidden" name="tube_post_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
		// Get the data if its already been entered
		$tube_post_name = get_post_meta($post->ID, '_tube_post_name', true);
		$tube_post_desc = get_post_meta($post->ID, '_tube_post_desc', true);
 
		// Echo out the field
		?>
 
		<table class="form-table">
			<tr>
				<th>
					<label>Name</label>
				</th>
				<td>
					<input type="text" name="tube_post_name" class="regular-text" value="<?php echo $tube_post_name; ?>"> 
					<!-- classes: .small-text .regular-text .large-text -->
				</td>
			</tr>
			<tr>
				<th>
					<label>Description</label>
				</th>
				<td>
					<textarea name="tube_post_desc" class="large-text"><?php echo $tube_post_desc; ?></textarea>
				</td>
			</tr>
		</table>
	<?php
	}
 
 
	function awp_gma_tube_post_save_meta( $post_id, $post ) { // save the data
 
		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */
 
		if ( ! isset( $_POST['tube_post_noncename'] ) ) { // Check if our nonce is set.
			return;
		}
 
		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if( !wp_verify_nonce( $_POST['tube_post_noncename'], plugin_basename(__FILE__) ) ) {
			return $post->ID;
		}
 
		// is the user allowed to edit the post or page?
		if( ! current_user_can( 'edit_post', $post->ID )){
			return $post->ID;
		}
		// ok, we're authenticated: we need to find and save the data
		// we'll put it into an array to make it easier to loop though
 
		$tube_post_meta['_tube_post_name'] = $_POST['tube_post_name'];
		$tube_post_meta['_tube_post_desc'] = $_POST['tube_post_desc'];
 
		// add values as custom fields
		foreach( $tube_post_meta as $key => $value ) { // cycle through the $tube_post_meta array
			// if( $post->post_type == 'revision' ) return; // don't store custom data twice
			$value = implode(',', (array)$value); // if $value is an array, make it a CSV (unlikely)
			if( get_post_meta( $post->ID, $key, FALSE ) ) { // if the custom field already has a value
				update_post_meta($post->ID, $key, $value);
			} else { // if the custom field doesn't have a value
				add_post_meta( $post->ID, $key, $value );
			}
			if( !$value ) { // delete if blank
				delete_post_meta( $post->ID, $key );
			}
		}
	}
	add_action( 'save_post', 'awp_gma_tube_post_save_meta', 1, 2 ); // save the custom fields


	
}

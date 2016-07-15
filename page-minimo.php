<?php
/**
 * Template Name: Minimo page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<?php while ( have_posts() ) : the_post(); ?>
				<?php echo get_post_meta( 18, 'awp_gma_link_meta', true ); ?> 
			<?php endwhile; // End of the loop.


						//global $wpdb;
			//var_dump($wpdb);
			//global $meta_keys;
			//var_dump($meta_keys);
			//global $post;
			//foreach ($post->ID as $each_post) {
			//echo get_post_meta( $post->ID, 'awp_gma_link_meta', true ); //awp_gma_link_meta, awp_gma_image_meta
			//}
			//echo get_post_meta( $each_post, 'awp_gma_link_meta', true ); //awp_gma_link_meta, awp_gma_image_meta

			 ?>



			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

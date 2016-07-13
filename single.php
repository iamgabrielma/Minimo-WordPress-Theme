<?php
/**
 * _The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Minimo
 */
/* The core post of WP, we need to work with real content here so we need the plugin that creates new content */
get_header(); /* header.php*/?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); /* the loop */?>

			<?php get_template_part( 'template-parts/content', 'single' ); /* all content, si vamos a /template-parts/content-xxxxxx.php or generic content.php, now we go to content-single.php to check what is going to be displayed here */?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			
			<?php 
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'minimo' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'minimo' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'minimo' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'minimo' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar();/*sidebar.php*/ ?>
<?php get_footer(); /*footer.php*/?>

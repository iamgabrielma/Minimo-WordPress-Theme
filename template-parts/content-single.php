<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimo
 * @global $first_post
 */

?>
<?php global $first_post; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php 
		/* if thumbnail has been set, post featured image the_post_thumbnail() */
		if ( has_post_thumbnail() ) { ?>
			<figure class="featured-image">
				<?php if ( $first_post == true ) { ?>
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
						<?php the_post_thumbnail(); 
						/* default from the theme, others can be used, like
						the_post_thumbnail('thumbnail') -> default from wordpress
						the_post_thumbnail('minimo-small-thumb') -> created on functions.php
						more custom sizes can be created in functions.php
						*/
						?>
					</a>
				<?php } else { 
					the_post_thumbnail(); 
				}
				?>
			</figure>
		<?php }
		?>
		
		<?php 
			if ( $first_post == true ) {
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			} else {
				the_title( '<h1 class="entry-title">', '</h1>' ); 
			}
		
		?>

		<?php //does exist the exceprt? get it.
		if ( has_excerpt( $post->ID ) ) {
			echo '<div class="deck">';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '</div><!-- .deck -->';
		}
		?>
		
		<div class="entry-meta">
			<?php minimo_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); /* content! */?>
		<?php
			wp_link_pages( array( /* links to additional pages */
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php minimo_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->


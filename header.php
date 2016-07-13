<?php
/**
 * _The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Minimo
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- adding lato google fonts -->
<link href='https://fonts.googleapis.com/css?family=Lato:300,700' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site <?php echo get_theme_mod( 'layout_setting', 'no-sidebar' ); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'minimo' ); ?></a>

	<!-- CUSTOMIZER HEADER IMPLEMENTATION AT INC/CUSTOM-HEADER.PHP, SETUP OPTIONS CAN BE FOUND THERE -->
	<?php if ( get_header_image() ) { ?> <!-- If 'header image' is selected in the customizer, then: -->
		<header id="masthead" class="site-header" style="background-image: url(<?php header_image(); ?>)" role="banner"> <!-- Image as a background -->
	<?php } else { ?> <!-- Else: Image as a site header -->
		<header id="masthead" class="site-header" role="banner">
	<?php } ?>
			
		<?php // Display site icon or first letter as logo ?>	
		<div class="site-logo">
			<?php $site_title = get_bloginfo( 'name' ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<!-- Only available if text to speech browser is used -->
				<div class="screen-reader-text">
					<?php printf( esc_html__('Go to the home page of %1$s', 'minimo'), $site_title ); ?>	
				</div>
				<?php
				if ( has_site_icon() ) {
					$site_icon = esc_url( get_site_icon_url( 270 ) ); ?>
					<img class="site-icon" src="<?php echo $site_icon; ?>" alt="">
				<?php 
					/* added for custom logo functionality under inc/custom-header.php and select it in the customizer , will change the first letter in the logo for a selected image*/
					// if (has_custom_logo()) {
					// 	the_custom_logo();
					// }
					/* end */
					} else { ?>


					<!-- displays only first letter, mobile thingy, and aria-hidden = true means speech wont read this, as it wont have any sense-->
					<div class="site-firstletter" aria-hidden="true">
						<?php echo substr($site_title, 0, 1); ?>
					</div>
				<?php } ?>
			</a>
		</div>
		
		<div class="site-branding<?php if ( is_singular() ) { echo ' screen-reader-text'; } ?>">
		<!-- if is_singular page or post, in that case I want to echo out screen-header-text, so the header will be gone in those pages (hidden, no deleted) edited style.css to not look weird when is hidden adding a media query to  site-header css -->
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'minimo' ); ?></button>
			<?php 
			/* we added the possibility to use more menus in the functions.php through register_nav_menus(), now we can add it here */
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu' ) ); 
			/* this part has been grabbed from sidebar.php on 2015 theme, wheel invented, the menu_class => nav-menu part, style.css grabbed too from 2015 and pasted into style.css regarding this menu */
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

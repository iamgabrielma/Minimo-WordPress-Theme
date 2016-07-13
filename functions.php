<?php
/**
 * Minimo functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Minimo
 */
include('inc/theme-options.php');
include('inc/fonts-selector.php'); //fonts functionality tryout
include('inc/fonts-selector-two.php'); //fonts functionality tryout
include('inc/daytime-hello.php');

if ( ! function_exists( 'minimo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

/* CONTENTS

- Show analytics code footer
- google fonts

*/
/* registering font settings + 3 callbacks */
// function awp_register_admin_settings(){
//     register_setting( 'fonts', 'fonts' );
//     add_settings_section( 'font_section', 'Font Options', 'font_description', 'fonts' );
//     add_settings_field( 'body-font', 'Body Font', 'body_font_field', 'fonts', 'font_section' );
//     add_settings_field( 'h1-font', 'Header 1 Font', 'h1_font_field', 'fonts', 'font_section' );
// }
// add_action( 'admin_init', 'awp_register_admin_settings' );

// function font_description(){
// 	echo 'Use the form below to change fonts of your theme.';	
// }
// function my_register_admin_settings() {
//     register_setting( 'fonts', 'fonts' );
//     add_settings_field( 'body-font', 'Body Font', 'body_font_field', 'fonts', 'font_section' );
// }
// add_action( 'admin_init', 'my_register_admin_settings' );

/* Adds Minimo settings to the administration dashboard */
function awp_minimo_create_dashboard_menu() {
	
	// settings
	// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_menu_page( 'Minimo Theme Dashboard', 'Minimo Theme', 'read', 'awp_minimo_add_theme_options_page', 'awp_minimo_theme_options_page', null, 25 );
	// hooks

	add_submenu_page( 'awp_minimo_add_theme_options_page', 'Minimo Hooks', 'Hooks', 'read', 'awp-hooks-manager', 'awp_minimo_theme_hooks_page' );
	add_submenu_page( 'awp_minimo_add_theme_options_page', 'Minimo Layout', 'Layout', 'read', 'awp-layout-manager', 'awp_minimo_theme_layout_page' );
	add_submenu_page( 'awp_minimo_add_theme_options_page', 'Minimo Fonts', 'Fonts', 'read', 'awp-fonts-manager', 'awp_minimo_theme_fonts_page' );

	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	// add_submenu_page( 'awp_minimo_add_theme_options_page', 'Minimo Hooks', 'read', 'awp_minimo_add_theme_hooks_page', 'awp_minimo_theme_hooks_page' );

}
add_action( 'admin_menu', 'awp_minimo_create_dashboard_menu' );

/* adds google analytics to footer */
function awp_google_analytics(){

	global $options;
	echo '<!-- GOOGLE ANALYTICS START -->';
	//var_dump($options);
	//echo '<br>';

	$output_ga = get_option( 'options' );
	//var_dump($output_ga);
	echo $output_ga[0]['std'];

	//echo '<br>';
	echo '<!-- GOOGLE ANALYTICS END -->';

}
add_action( 'wp_footer', 'awp_google_analytics' );

/* get fonts */
// function get_fonts(){
// 	$fonts = array(
//         'arial' => array(
//             'name' => 'Arial',
//             'font' => '',
//             'css' => "font-family: Arial, sans-serif;"
//         ),
//         'ubuntu' => array(
//             'name' => 'Ubuntu',
//             'font' => '@import url(https://fonts.googleapis.com/css?family=Ubuntu);',
//             'css' => "font-family: 'Ubuntu', sans-serif;"
//         ),
//         'lobster' => array(
//             'name' => 'Lobster',
//             'font' => '@import url(https://fonts.googleapis.com/css?family=Lobster);',
//             'css' => "font-family: 'Lobster', cursive;"
//         ),
//         'lato'	=> array(
//         'name'	=>	'Lato',
//         'font'	=> 	'@import url(https://fonts.googleapis.com/css?family=Lato);',
//         'css' 	=> 	"font-family: 'lato', sans-serif;"
//     ));
//     return apply_filters( 'get_fonts', $fonts );
// }

/* ADD FONTS TO HEADER */
// function font_head(){
// 	/* esto funciona, pero lo que hace es sustituirlo por otra key*/
// 	$options = (array)get_option('fonts');
// 	//$fonts = get_fonts('fonts');
// 	$fonts = get_fonts();
// 	$body_key = 'lato';

// 	if (isset($options['body-font'])) {
// 		$body_key = $options['body-font'];
// 	}
// 	/* el problema es que al cambiarlo, sigue siendo lato en el font_head
// 	*/
// 	echo $body_key;

// 	// foreach ($fonts as $each_font) {
// 	// 	echo $each_font['name'];
// 	// }

// 	// echo '<!-- GOOGLE FONTS START -->';
// 	// echo '<style>';
// 	// var_dump($options);
// 	// echo '<!-- ///////////// -->';
// 	// var_dump($fonts);
// 	// echo '<!-- ///////////// -->';
// 	// var_dump($the_var);
// 	// //var_dump($_POST['fonts']);
// 	// /*
// 	// echo $fonts['lato']['font'];
// 	// echo 'body { ' . $fonts['lato']['css'] . ' }';
// 	// */
// 	// echo '</style>';
// 	// echo '<!-- GOOGLE FONTS ENDS -->';

// }
// add_action( 'wp_head', 'font_head' );


function minimo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on minimo, use a find and replace
	 * to change 'minimo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'minimo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 828, 360, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'minimo' ),
		'secondary' => esc_html__( 'Secondary Menu', 'minimo' ) // added so it appears on customizer, but will do nothing in the front-end, this just REGISTERS THE POSSIBILITY TO HAVE A SECOND MENU, but for using it we must code it into our theme -> header.php
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'minimo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Add editor styles
	 */
	// example of chevrons when menus/submenus are clicked
	add_editor_style( array( 'inc/editor-style.css', 'fonts/custom-fonts.css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' ) );
}
endif; // minimo_setup
add_action( 'after_setup_theme', 'minimo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function minimo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'minimo_content_width', 640 );
}
add_action( 'after_setup_theme', 'minimo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minimo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area', 'minimo' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'minimo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function minimo_scripts() {
	wp_enqueue_style( 'minimo-style', get_stylesheet_uri() );
	
	// Add Google Fonts: Fira Sans and Merriweather
	wp_enqueue_style( 'minimo-local-fonts', get_template_directory_uri() . '/fonts/custom-fonts.css' );
	
	// Add Font Awesome icons (http://fontawesome.io) 
	wp_enqueue_style( 'minimo-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	
	/* responsiveness of the nav menus, check functions.js for site-navigation */
	wp_enqueue_script( 'minimo-navigation', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20120206', true );
	/* enqueue and localize are tied up together, and we are sure of that through the handle 'minisocres-navigation', creates expand child menu and collapse, this function passes the <span> values to the JS , if we go to js/functions.js, we can find the call to those functions under initMainNavigation() */
	wp_localize_script( 'minimo-navigation', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'minimo' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'minimo' ) . '</span>',
	) );
	
	wp_enqueue_script( 'minimo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'minimo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


<?php
/**
 * Minimo functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Minimo
 */

/*  Call functions to draw the settings page */
include('inc/theme-options.php');
include('inc/theme-options-subpage.php');




//http://code.tutsplus.com/tutorials/create-a-settings-page-for-your-wordpress-theme--wp-20091
function awp_minimo_dashboard_menu() {
	
	// https://developer.wordpress.org/reference/functions/add_menu_page/
	add_menu_page( 'Minimo Theme Dashboard', 'Minimo Theme', 'read', 'awp_minimo_theme_options_page', 'awp_minimo_dashboard_callback_function', null, 25 );
	
	add_submenu_page( 'awp_minimo_theme_options_page', 'submenu', 'Submenu (WIP)', 'read', 'awp_minimo_theme_options_subpage', 'awp_minimo_dashboard_submenu_callback_function' );

}
add_action( 'admin_menu', 'awp_minimo_dashboard_menu' );

/* google analytics on footer*/
function awp_analytics(){

	//global $sub_options;
	//global $sub_value;

	//echo '<script> test: ' . $sub_options[0] . ' </script>'; //test: awp_google_analytics
	//var_dump($sub_value);


}
add_action( 'wp_footer','awp_analytics' );

function awp_analytics_tracking_code(){
	
	global $my_new_options;
	
	//$propertyID = 'UA-XXXXX-X'; // GA Property ID
	$propertyID = $my_new_options['property_id'];
	$my_output_property_id = get_option('awp_google_analytics');

	if ($my_new_options['ga_enable'] == true) { 

		echo '<!-- GOOGLE ANALYTICS START -->';
		echo $my_output_property_id . '<br>';
		?>

		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo $propertyID; ?>']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
<?php }
		echo '<!-- GOOGLE ANALYTICS END -->';
}
add_action( 'wp_footer','awp_analytics_tracking_code' );



















if ( ! function_exists( 'minimo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
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


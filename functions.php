<?php
/**
 * MG Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MG_Starter_Theme
 */

if ( ! function_exists( 'mg_starter_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mg_starter_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MG Starter Theme, use a find and replace
		 * to change 'mg-starter-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mg-starter-theme', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'mg-starter-theme' ),
		) );

		if( get_theme_mod( 'mg_nav_secondary', false) ) {
			register_nav_menu( 'menu-2', esc_html__( 'Secondary', 'mg-starter-theme' ) );
		}

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mg_starter_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mg_starter_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mg_starter_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mg_starter_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'mg_starter_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mg_starter_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mg-starter-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mg-starter-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if( get_theme_mod( 'mg_footer_enable', false ) ) {
		for( $i = 1; $i <= get_theme_mod( 'mg_footer_number_columns', 0 ); $i++ ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Footer ' . $i, 'mg-starter-theme' ),
				'id'            => 'footer-' . $i,
				'class'         => 'footer',
				'description'   => esc_html__( 'Add widgets here.', 'mg-starter-theme' ),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			) );
		}
	}
}
add_action( 'widgets_init', 'mg_starter_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mg_starter_theme_scripts() {
	wp_enqueue_style( 'mg-starter-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mg-starter-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mg-starter-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mg_starter_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// embeds
require_once get_template_directory() . '/inc/customizer-embeds.php';

// typography
require get_template_directory() . '/inc/customizer-typography.php';

// secondary nav
require get_template_directory() . '/inc/customizer-nav.php';

// footer
require get_template_directory() . '/inc/customizer-footer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load TGM for plugin reccomendation / requirement
 */
require get_template_directory() . '/inc/tgm.php';

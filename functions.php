<?php
/**
 * Boots Hard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Boots_Hard
 */

if ( ! defined( '_BOOTS_HARD_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_BOOTS_HARD_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function boots_hard_setup() {
	load_theme_textdomain( 'boots-hard', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( array( 'primary' => esc_html__( 'Primary', 'boots-hard' ) ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
add_action( 'after_setup_theme', 'boots_hard_setup' );

/**
 * Enqueue scripts and styles.
 */
function boots_hard_scripts() {
	wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2', 'all' );
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '6.4.2', 'all' );
	wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true );	
}
add_action( 'wp_enqueue_scripts', 'boots_hard_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function boots_hard_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'boots-hard' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'boots-hard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'boots_hard_widgets_init' );

/**
 * Load Bootstrap Navwalker.
 */
require get_template_directory() . '/inc/class-bootstrap-navwalker.php';

require get_template_directory() . '/inc/customizer.php';

/**
 * Load Customizer Section Manager.
 */
require get_template_directory() . '/inc/customizer-section-manager.php';
/**
 * Load Section Renderer for front-end display.
 */
require get_template_directory() . '/inc/section-renderer.php';

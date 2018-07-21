<?php

// Path constants
define('THEME', get_template_directory_uri(), true);
define('THEMELIB', TEMPLATEPATH . '/library'); 

// Load Theme Options
$gpp = get_option( 'option_tree' );


// Add Post Thumbnail Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 284, 150, true ); // 284x150 size
	add_image_size( '600', 600, true ); // 600 image size
	add_image_size( '940', 940, 9999 ); // 940 image size
}

if ( ! isset( $content_width ) ) $content_width = 620;  

// Load Post Images
require_once (TEMPLATEPATH . '/images.php');

// Load Google Fonts
require_once (THEMELIB . '/google-fonts.php');

// Add TGM Plugin Activation class
include(THEMELIB . '/tgm-plugin-activation/class-tgm-plugin-activation.php');

// Add Menu Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'nav-menus' );
	add_action( 'init', 'register_gpp_menus' );

	function register_gpp_menus() {
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'Workaholic' )
			)
		);
	}
}


/*
	This feature enables post and comment RSS feed links to head.
*/
	add_theme_support('automatic-feed-links');
	
/*
	Add theme support for custom backgrounds.
*/
	add_custom_background();

// Load javascripts
add_action('init', 'theme_load_js');
function theme_load_js() {
    if (is_admin()) return;
    wp_enqueue_script('jquery');    
    wp_enqueue_script('superfish', THEME .'/js/nav/superfish.js', array('jquery'));
    wp_enqueue_script('nav', THEME .'/js/nav/jquery.bgiframe.min.js', array('jquery'));
    wp_enqueue_script('nav', THEME .'/js/nav/hoverintent.js', array('jquery'));
    wp_enqueue_script('search', THEME .'/js/search.js','');    
}

//widgets
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Bottom-Left',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sub">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom-Middle',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sub">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom-Right',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sub">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sub">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Page-Sidebar',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sub">',
        'after_title' => '</h3>',
    ));


//get thumbnail
function postimage($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'order' => 'ASC',
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			echo $attachmentimage.apply_filters('the_title', $parent->post_title);
		}
	} 
}

//get thumbnails
function postimages($size='medium') {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'order' => 'ASC',
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			echo $attachmentimage;
			/*.apply_filters('the_title', get_the_title($image->ID))*/
		}
	} 
}

//check any attachment 
function checkimage($size='medium') {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			return $attachmentimage;
		}
	} 
}

// Get Wordpress Categories
global $categories;
$cats_array = get_categories();
$categories = array();
foreach ($cats_array as $cats) {
	$categories[0] = "";
	$categories[$cats->cat_ID] = $cats->cat_name;	
}



add_action( 'tgmpa_register', 'fullscreen_register_required_plugins' ); 

/*  TGM register required plugins  */
function fullscreen_register_required_plugins() {

	$plugins = array(

		/* Add Option Tree Plugin from .org repo */
		array('name' => 'Option Tree',
		'slug' => 'option-tree',
		),
	);

	/** Change this to your theme text domain, used for internationalising strings */
	$theme_text_domain = 'Workaholic';

	/**
	 * Array of configuration settings. Uncomment and amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * uncomment the strings and domain.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
        'domain'       => $theme_text_domain,         // Text domain - likely want to be the same as your theme
		'strings'      => array(
			/*'page_title'             => __( 'Install Required Plugins', $theme_text_domain ), // */
			/*'menu_title'             => __( 'Install Plugins', $theme_text_domain ), // */
			/*'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', $theme_text_domain ), // %1$s = plugin name */
			/*'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL */
			/*'button'                 => __( 'Install %s Now', $theme_text_domain ), // %1$s = plugin name */
			/*'installing'             => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name */
			/*'oops'                   => __( 'Something went wrong with the plugin API.', $theme_text_domain ), // */
			/*'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', $theme_text_domain ), // %1$s = plugin name, %2$s = TGMPA page URL */
			/*'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', $theme_text_domain ), // %1$s = plugin name */
			/*'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL */
			/*'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', $theme_text_domain ), // %1$s = plugin name */
			/*'return'                 => __( 'Return to Required Plugins Installer', $theme_text_domain ), // */
		),
	);

	tgmpa( $plugins, $config );

} ?>
<?php
/**
 * caresland-lite functions and definitions
 *
 * @package caresland-lite
 */


function ti_caresland_lite_setup() {

	global $content_width;

	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

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

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ti_caresland_lite, use a find and replace
	 * to change 'caresland-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'caresland-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'ti-caresland-lite-primary' => __( 'The Primary Menu', 'caresland-lite' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/* Set the image size by cropping the image */
	add_image_size( 'event-thumbnail', 325, 200, true );
	add_image_size( 'post-thumbnail', 315, 172, true );


	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ti_caresland_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	$args = array(
		'width'         => 980,
		'height'        => 60,
		'default-image' => '',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );
}

add_action( 'after_setup_theme', 'ti_caresland_lite_setup' );


/**
 * Register widgetized area and update sidebar with default widgets.
 */
function ti_caresland_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'caresland-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="line-orange"></div>',
		'after_widget'  => '<div class="bottom-shadow"></div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer1', 'caresland-lite' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="footer-box-inside">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer2', 'caresland-lite' ),
		'id'            => 'footer-2',
		'before_widget' => '<div id="%1$s" class="footer-box-inside">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer3', 'caresland-lite' ),
		'id'            => 'footer-3',
		'before_widget' => '<div id="%1$s" class="footer-box-inside">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer4', 'caresland-lite' ),
		'id'            => 'footer-4',
		'before_widget' => '<div id="%1$s" class="footer-box-inside">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ti_caresland_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ti_caresland_lite_scripts() {

	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');

	wp_enqueue_style( 'ti_caresland_lite_style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), 'v3.0.3', true );

	wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array(), 'v1.1', true );

	wp_enqueue_script( 'custom-scrips', get_template_directory_uri() . '/js/functions.js', array('jquery'), 'v1.0', true );
	wp_enqueue_script( 'scada_font','//fonts.googleapis.com/css?family=Scada' );
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ti_caresland_lite_scripts' );

/* no title */
add_filter( 'the_title', 'ti_caresland_lite_no_title');
function  ti_caresland_lite_no_title ($title) {
    if( $title == "" ){
        $title = "(No title)";
    }
    return $title;
}
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'ti_caresland_lite_required_plugins' );
function ti_caresland_lite_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      => 'Revive Old Post',
            'slug'      => 'tweet-old-post',
            'required'  => false,
        ),
        array(
            'name'      => 'WP Product Review',
            'slug'      => 'wp-product-review',
            'required'  => false,
        ),
    

    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'ti_caresland_lite';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'ti_caresland_lite',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'caresland-lite' ),
            'menu_title'                                => __( 'Install Plugins', 'caresland-lite' ),
            'installing'                                => __( 'Installing Plugin: %s', 'caresland-lite' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'caresland-lite' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','caresland-lite' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','caresland-lite' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','caresland-lite' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','caresland-lite' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','caresland-lite' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','caresland-lite' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','caresland-lite' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','caresland-lite' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins','caresland-lite' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins','caresland-lite' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'caresland-lite' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'caresland-lite' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'caresland-lite' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}
function  ti_caresland_lite_add_editor_styles() {
    add_editor_style( '/css/custom-editor-style.css' );
}
add_action( 'init', 'ti_caresland_lite_add_editor_styles' );

add_action( 'customize_controls_print_scripts', 'ti_caresland_lite_customizer_button' );

function  ti_caresland_lite_customizer_button()
{
    wp_register_script( 'ti_caresland_lite_customizer_script', get_template_directory_uri().'/js/customizer_button.js', array('jquery'), 'v1.0', true);
    wp_enqueue_script( 'ti_caresland_lite_customizer_script' );
}

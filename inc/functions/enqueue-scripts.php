<?php 

/**
 * Enqueue scripts
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
function inter_scripts() {

	$css_dir = get_stylesheet_directory_uri() . '/assets/css/';
	$js_dir = get_stylesheet_directory_uri() . '/assets/js/';

	wp_enqueue_style( 'bootstrap', $css_dir.'bootstrap.min.css', array(), false, false );

	wp_enqueue_style( 'bootstrapreboot', $css_dir.'bootstrap-reboot.min.css', array(), false, false );

	wp_enqueue_style( 'bootstrapgrid', $css_dir.'bootstrap-grid.min.css', array(), false, false );

	wp_enqueue_style( 'elusive-icons', $css_dir.'elusive-icons.min.css', array(), false, false );

	wp_enqueue_style( 'theme', $css_dir.'main.min.css', array(), false, false );

	// wp_enqueue_style( 'fontawesome-5', '//use.fontawesome.com/releases/v5.0.1/css/all.css', array(), false, false );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'font-awesome', '//use.fontawesome.com/releases/v5.0.4/js/all.js', array(), null );
	// required from upgrade from v4 to v5
	wp_enqueue_script( 'font-awesome-shim', '//use.fontawesome.com/releases/v5.0.4/js/v4-shims.js', array(), null );

	wp_enqueue_script( 'theme', $js_dir.'theme.js', array('jquery'), false, true );

	wp_enqueue_script( 'bootstrap-js', $js_dir.'bootstrap.min.js', array('jquery'), false, false );
}

add_action( 'wp_enqueue_scripts', 'inter_scripts', '11' );

function inter_admin_style(){
	
	$css_dir = get_stylesheet_directory_uri() . '/assets/css/';
	
	wp_enqueue_style( 'theme-admin', $css_dir.'theme-admin.css', array(), false, false );
}

add_action('admin_head', 'inter_admin_style');

/**
 * Filter the HTML script tag of `font-awesome` script to add `defer` attribute.
 *
 * @param string $tag    The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return   Filtered HTML script tag.
 */
// add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );

function add_defer_attribute( $tag, $handle ) {

    if ( 'font-awesome' === $handle ) {
    	
        return str_replace( ' src', ' defer src', $tag );
    }
}

?>
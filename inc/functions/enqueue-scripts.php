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
function inter_name_scripts() {

	$css_dir = get_stylesheet_directory_uri() . '/assets/css/';
	$js_dir = get_stylesheet_directory_uri() . '/assets/js/';

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'bootstrap-js', $js_dir.'/bootstrap.min.js', array('jquery'), false, false );

	wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/3608d41ab9.js', array('jquery'), false, false );

	wp_enqueue_style( 'bootstrap', $css_dir.'bootstrap.min.css', array(), false, false );

	wp_enqueue_style( 'bootstrapreboot', $css_dir.'bootstrap-reboot.min.css', array(), false, false );

	wp_enqueue_style( 'bootstrapgrid', $css_dir.'bootstrap-grid.min.css', array(), false, false );

	wp_enqueue_style( 'theme', $css_dir.'main.css', array(), false, false );

	#wp_enqueue_style( 'glyphicon', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css', array('bootstrap'), false, false );

	

}

add_action( 'wp_enqueue_scripts', 'inter_name_scripts' ); ?>
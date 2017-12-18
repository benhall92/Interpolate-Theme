<?php

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/inc/options/theme-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/options/theme-config.php' );
}

add_action( 'after_setup_theme', 'inter_theme_setup' );

function inter_theme_setup() {
	load_theme_textdomain( 'inter_theme', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu', 'inter_theme' )
		)
	);
}

add_action( 'comment_form_before', 'inter_theme_enqueue_comment_reply_script' );

function inter_theme_enqueue_comment_reply_script() {
	
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'inter_theme_title' );

function inter_theme_title( $title ) {
	
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'inter_theme_filter_wp_title' );

function inter_theme_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'inter_theme_widgets_init' );

function inter_theme_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'inter_theme' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		)
	);
}

function inter_theme_custom_pings( $comment ) {

	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}

function inter_show_tags() {

	$posttags = get_the_tags();
	$content = '';

	if ($posttags) {

		echo '<p>';
		
		$array = [];
		
		foreach($posttags as $tag) {
			$array[] = '<a href="/tag/' . $tag->slug . '/"><span class="badge badge-info">' . $tag->name . '</span></a>';
		}
		
		$content .= 'Tags: ' . implode(' ', $array);

		echo $content;

		echo '</p>';
	}
}

/**
 *
 * Add a class to a list item
 *
 **/

add_filter('nav_menu_css_class','inter_menu_classes',1,3);

function inter_menu_classes($classes, $item, $args) {
	
	if($args->theme_location == 'main-menu') {

		$classes[] = 'nav-item';
	}

  	return $classes;
}

/**
 *
 * Add a class to a link item
 *
 **/

add_filter( 'nav_menu_link_attributes', 'inter_add_menu_link_class', 10, 3 );

function inter_add_menu_link_class( $atts, $item, $args ) {
    
    // check if the item is in the primary menu
    if( $args->theme_location == 'main-menu' ) {
    
		// add the desired attributes:
		$atts['class'] = 'nav-link';
    }

    return $atts;
}

/**
 * Remove version from Scripts
 *
 * If you don't remove versions from scripts, you can't cache them.
 **/

add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

function remove_cssjs_ver( $src ) {
    
    if( strpos( $src, '?ver=' ) || strpos( $src, '?v=' ) || strpos( $src, '?version=' ) )
        $src = remove_query_arg( 'ver', $src );
        return $src;
}
/**
 * Move Yoast SEO to the bottom of the page
 *
 * SRC: https://gist.github.com/aderaaij/6767503
 **/
function inter_yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'inter_yoasttobottom');

require_once (dirname(__FILE__) . '/inc/functions/register-sidebars.php');
require_once (dirname(__FILE__) . '/inc/functions/enqueue-scripts.php');
require_once (dirname(__FILE__) . '/inc/functions/page-options.php');
require_once (dirname(__FILE__) . '/inc/functions/breadcrumbs.php');
require_once (dirname(__FILE__) . '/inc/functions/numbered-pagination.php');
require_once (dirname(__FILE__) . '/inc/options/theme-config.php');
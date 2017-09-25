<?php

add_action( 'after_setup_theme', 'blankslate_setup' );

function blankslate_setup() {
	load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu', 'blankslate' )
		)
	);
}

add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );

function blankslate_enqueue_comment_reply_script() {
	
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'blankslate_title' );

function blankslate_title( $title ) {
	
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'blankslate_filter_wp_title' );

function blankslate_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'blankslate_widgets_init' );

function blankslate_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'blankslate' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		)
	);
}

function blankslate_custom_pings( $comment ) {

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

include 'inc/functions/register-sidebars.php';
include 'inc/functions/enqueue-scripts.php';
include 'inc/functions/page-options.php';
include 'inc/functions/breadcrumbs.php';
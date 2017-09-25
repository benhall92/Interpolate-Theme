<?php

/**
* Creates a sidebar
* @param string|array  Builds Sidebar based off of 'name' and 'id' values.
*/

add_action( 'widgets_init', 'inter_widgets_init' );

function inter_widgets_init () {

$footer_column_one = array(
	'name'          => __( 'Footer Column One', 'inter_theme' ),
	'id'            => 'footer-column-one',
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s ">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);

register_sidebar( $footer_column_one );

$footer_column_two = array(
	'name'          => __( 'Footer Column Two', 'inter_theme' ),
	'id'            => 'footer-column-two',
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s ">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);

register_sidebar( $footer_column_two );

$footer_column_three = array(
	'name'          => __( 'Footer Column Three', 'inter_theme' ),
	'id'            => 'footer-column-three',
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s ">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);

register_sidebar( $footer_column_three );

}

?>
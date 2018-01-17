<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):

	/*
	 * Declare WooCommerce support
	 */

	add_action( 'after_setup_theme', 'woocommerce_support' );

	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}

	/*
	 * src: https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	 *
	 * The hook method is more involved than using woocommerce_content
	 * but is more flexible. This is similar to the method we use when
	 * creating themes. It’s also the method we use to integrate nicely
	 * with Twenty Ten to Twenty Sixteen themes.
	 *
	 * Insert a few lines in your theme’s functions.php file.
	 *
	 * First unhook the WooCommerce wrappers
	 */

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


	add_action('woocommerce_before_main_content', 'inter_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'inter_wrapper_end', 10);

	function inter_wrapper_start() {
		echo '<main class="page-main">';
	}

	function inter_wrapper_end() {
		echo '</main>';
	}

	/*
	 * SRC: https://docs.woocommerce.com/document/show-cart-contents-total/
	 *
	 * Ensure cart contents update when products are added to the cart via
	 * AJAX (place the following in functions.php).
	 *
	 * Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
	* Compatible with WooCommerce 3.0+. Thanks to Alex for assisting
	* with an update!
	*/
	 
	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		?>
		<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	  		<i class="fas fa-shopping-cart"></i> (<?php echo WC()->cart->get_cart_contents_count(); ?>)
	  	</a>
		<?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}

endif;

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

		echo '<p class="single-post-tags">';
		
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

/*
 * DEFINE THEME GLOBAL OPTION
 */
Redux::init( 'inter_options' );

global $inter_options;

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):

	global $posts_per_shop_row;

	$posts_per_shop_row = $inter_options['shop-posts-per-row'];

	// Change number or products per row to 3
	add_filter('loop_shop_columns', 'loop_columns', 1, 10);

	if (!function_exists('loop_columns')) {

		function loop_columns($number_columns) {

			global $posts_per_shop_row;

			return $posts_per_shop_row;
		}
	}

	/*
	 * REMOVE WOOCOMMERCE ACTIONS
	 */

	// ARCHIVE HOOKS
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

	remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);

	remove_action('woocommerce_before_main_content', 'woocommerce_product_archive_description', 10);

	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	

	// PRODUCT SINGLE HOOKS
	remove_action('woocommerce_before_single_product', 'wc_print_notices', 10);

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );	

	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 12 );


	if( $inter_options['product-show-title'] == 'yes' ):

		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

	endif;

	if( $inter_options['product-show-sidebar'] ):

		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	endif;

endif;

require 'plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/benhall92/Interpolate-Theme',
	__FILE__,
	'inter_theme'
);

//Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('your-token-here');

//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
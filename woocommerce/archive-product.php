<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>

<?php

global $inter_options;

$page_layout 		= $inter_options['shop-layout'];
$show_sidebar 		= $inter_options['shop-show-sidebar'];
$sidebar_position 	= $inter_options['shop-sidebar-position'];
$show_header 		= $inter_options['shop-show-header'];
$show_title 		= $inter_options['shop-show-title'];
$show_breadcrumbs 	= $inter_options['shop-show-breadcrumbs'];
$posts_per_row 		= $inter_options['shop-posts-per-row'];

/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

if ($show_header == 'yes'): ?>

<header class="page-header woocommerce-products-header" role="banner">

	<?php if ($page_layout == 'boxed'): ?>
	<!-- container -->
	<div class="container">

	<?php else: ?>

	<!-- container fluid -->
	<div class="container-fluid">

	<?php endif ?>
		
		<div class="row">

			<?php if ($show_title == 'yes'): ?>
			
				<?php if ($show_breadcrumbs == 'yes'): ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-12 order-xs-12">
				<?php else: ?>
				<div class="col-md-12 col-sm-12 xs-12 order-lg-1 order-sm-12 order-xs-12">
				<?php endif; ?>

					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				</div>
			<?php endif; ?>

			<?php if ($show_breadcrumbs == 'yes'): ?>
				<?php if ($show_title == 'yes'): ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-sm-1 order-xs-1">
				<?php else: ?>
				<div class="col-md-12 col-sm-12 xs-12 order-lg-2 order-sm-1 order-xs-1">
				<?php endif; ?>
					<?php woocommerce_breadcrumb(); ?>
				</div>
			<?php endif ?>

		</div>

	<?php if ($page_layout == 'boxed'): ?>
	<!-- /container -->
	</div>
	<?php endif ?>
	
</header>

<?php endif; ?>

<main class="page-main" id="archive">

	<?php if ($page_layout == 'boxed'): ?>
	<!-- container -->
	<div class="container">

	<?php else: ?>

	<!-- container fluid -->
	<div class="container-fluid">

	<?php endif ?>

	<div class="row mt-2 mb-2">
	<?php
			/**
			 * woocommerce_before_shop_loop hook.
			 *
			 * @hooked wc_print_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		?>
	</div>

	<div class="row">

		<?php if ($show_sidebar == 'yes' && $sidebar_position == 'left'): ?>

		<aside class="col-lg-3 col-md-3">
			<?php
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>
		</aside>
			
		<?php endif ?>

		<?php if ($show_sidebar == 'yes'): ?>

		<!-- col -->
		<div class="col-lg-9 col-md-9">

		<?php else: ?>

		<!-- col -->
		<div class="col" id="products-<?php echo $posts_per_row; ?>">

		<?php endif ?>

		<?php if ( have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			?>

		<?php endif; ?>

		<!-- /col -->
		</div>

		<?php if ($show_sidebar == 'yes' && $sidebar_position == 'right'): ?>

		<aside class="col-lg-3 col-md-3">
			<?php
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>
		</aside>
			
		<?php endif ?>

	<?php if ($page_layout == 'boxed'): ?>
		
		<!-- /container -->
		</div>

	<?php endif ?>

</main>

<?php
	/**
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
?>
	
<?php get_footer( 'shop' ); ?>
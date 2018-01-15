<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $inter_options;

$page_layout 		= $inter_options['product-layout'];
$show_sidebar 		= $inter_options['product-show-sidebar'];
$sidebar_position 	= $inter_options['product-sidebar-position'];
$show_header 		= $inter_options['product-show-header'];
$show_title 		= $inter_options['product-show-title'];
$show_breadcrumbs 	= $inter_options['product-show-breadcrumbs'];

?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
 do_action( 'woocommerce_before_single_product' );
 if ( post_password_required() ) {
 	echo get_the_password_form();
 	return;
 }
 if ($show_header == 'yes'): ?>

<header class="page-header" role="banner">

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

					<?php woocommerce_template_single_title(); ?>
				</div>
			<?php endif; ?>

			<?php if ($show_breadcrumbs == 'yes'): ?>
				<?php if ($show_title == 'yes'): ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-sm-1 order-xs-1">
				<?php else: ?>
				<div class="col-md-12 col-sm-12 xs-12 order-lg-2 order-sm-1 order-xs-1">
				<?php endif; ?>
					<?php inter_breadcrumbs(); ?>
				</div>
			<?php endif ?>

		</div>

	<?php if ($page_layout == 'boxed'): ?>
	<!-- /container -->
	</div>
	<?php endif ?>
	
</header>

<?php endif; ?>

<?php wc_print_notices(); ?>

<main class="page-main" id="single">

	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ($page_layout == 'boxed'): ?>
		<!-- container -->
		<div class="container">

		<?php else: ?>

		<!-- container fluid -->
		<div class="container-fluid">

		<?php endif ?>

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
			<div class="col">

			<?php endif ?>

				<?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>

				<div class="summary entry-summary">

					<?php
						/**
						 * woocommerce_single_product_summary hook.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>

				</div><!-- .summary -->

				<?php
					/**
					 * woocommerce_after_single_product_summary hook.
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * @hooked woocommerce_upsell_display - 15
					 * @hooked woocommerce_output_related_products - 20
					 */
					do_action( 'woocommerce_after_single_product_summary' );
				?>

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

		</div>

		<?php if ($page_layout == 'boxed'): ?>
			
			<!-- /container -->
			</div>

		<?php endif ?>

	</div>
	
</main>

<?php do_action( 'woocommerce_after_single_product' ); ?>
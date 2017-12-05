<?php

$post_id = '';

if( is_home() ):
	$post_id = get_option( 'page_for_posts' );
else:
	$post_id = get_the_id();
endif;

$show_header 		= get_post_meta($post_id, '_show_header', true);
$show_title 		= get_post_meta($post_id, '_show_title', true);
$show_breadcrumbs 	= get_post_meta($post_id, '_show_breadcrumbs', true);
$page_layout 		= get_post_meta($post_id, '_page_layout', true);

if ($show_header): ?>

<header class="page-header" role="banner">

	<?php if ($page_layout == 'boxed'): ?>
	<!-- container -->
	<div class="container">
	<?php endif ?>
		
		<div class="row">
			
			<?php if ($show_title): ?>

				<?php if (!$show_breadcrumbs): ?>
<<<<<<< HEAD
				<div class="col-md-12 col-sm-12 xs-12 order-lg-1 order-sm-12 order-xs-12">
				<?php else: ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-12 order-xs-12">
=======
				<div class="col col-md-12 col-sm-12 xs-12 order-lg-1 order-sm-12 order-xs-12">
				<?php else: ?>
				<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-12 order-xs-12">
>>>>>>> 643c3c1d0acca6ca9848b518ec28a728495cb605
				<?php endif; ?>
					<h1><?php echo get_the_title($post_id); ?></h1>
				</div>
			<?php endif; ?>

			<?php if ($show_breadcrumbs): ?>
				<?php if (!$show_title): ?>
<<<<<<< HEAD
				<div class="col-md-12 col-sm-12 xs-12 order-lg-2 order-sm-1 order-xs-1">
				<?php else: ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-sm-1 order-xs-1">
=======
				<div class="col col-md-12 col-sm-12 xs-12 order-lg-2 order-sm-1 order-xs-1">
				<?php else: ?>
				<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-sm-1 order-xs-1">
>>>>>>> 643c3c1d0acca6ca9848b518ec28a728495cb605
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

<?php get_template_part('inc/layout/page-main-css'); ?>

<?php
$page_layout 		= get_post_meta(get_the_id(), '_page_layout', true);
$show_sidebar 		= get_post_meta(get_the_id(), '_show_sidebar', true);
$sidebar_position 	= get_post_meta(get_the_id(), '_sidebar_position', true); ?>

<main class="page-main">

	<?php if ($page_layout == 'boxed'): ?>
		
		<!-- container -->
		<div class="container">

	<?php endif ?>

	<div class="row">

		<?php if ($show_sidebar && $sidebar_position == 'left'): ?>

		<aside class="col-lg-3 col-md-3">
			<?php get_sidebar(); ?>
		</aside>
			
		<?php endif ?>

		<?php if ($show_sidebar): ?>

		<!-- col -->
		<div class="col-lg-9 col-md-9">

		<?php else: ?>

		<!-- col -->
		<div class="col">

		<?php endif ?>

		<?php get_template_part('inc/layout/page-layout'); ?>

		<!-- /col -->
		</div>

		<?php if ($show_sidebar && $sidebar_position == 'right'): ?>

		<aside class="col-lg-3 col-md-3">
			<?php get_sidebar(); ?>
		</aside>
			
		<?php endif ?>

	</div>

	<?php if ($page_layout == 'boxed'): ?>
		
		<!-- /container -->
		</div>

	<?php endif ?>
	
</main>
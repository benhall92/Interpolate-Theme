<?php get_header(); ?>

<?php

global $inter_options;

$page_layout 		= $inter_options['404-layout'];
$show_sidebar 		= $inter_options['404-show-sidebar'];
$sidebar_position 	= $inter_options['404-sidebar-position'];
$body_copy 			= $inter_options['404-body-copy']; ?>

<main class="page-main" id="PageNotFound">

	<?php if ($page_layout == 'boxed'): ?>
		
		<!-- container -->
		<div class="container">

	<?php endif ?>

	<div class="row">

		<?php if ($show_sidebar == 'yes' && $sidebar_position == 'left'): ?>

		<aside class="col-lg-3 col-md-3">
			<?php get_sidebar(); ?>
		</aside>
			
		<?php endif ?>

		<?php if ($show_sidebar == 'yes'): ?>

		<!-- col -->
		<div class="col-lg-9 col-md-9">

		<?php else: ?>

		<!-- col -->
		<div class="col">

		<?php endif ?>

		<article id="post-0" class="post not-found">

			<div class="jumbotron">
				
				<h1><?php _e( 'Not Found', 'inter_theme' ); ?></h1>
				
				<p><?php _e( 'Nothing found for the requested page. Try a search instead?', 'blankslate' ); ?></p> 

				<?php get_search_form(); ?>

			</div>

			<?php if ($body_copy != ""): ?>

				<div class="row">

					<div class="col">

						<?php echo $body_copy; ?>
						
					</div>
					
				</div>

			<?php endif; ?>

		</article>

		<!-- /col -->
		</div>

		<?php if ($show_sidebar == 'yes' && $sidebar_position == 'right'): ?>

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

<?php get_footer(); ?>
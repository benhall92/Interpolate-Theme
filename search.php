<?php get_header(); ?>

<?php

global $inter_options;

$page_layout 		= $inter_options['search-layout'];
$show_sidebar 		= $inter_options['search-show-sidebar'];
$sidebar_position 	= $inter_options['search-sidebar-position'];
$show_header 		= $inter_options['search-show-header'];
$show_title 		= $inter_options['search-show-title'];
$show_breadcrumbs 	= $inter_options['search-show-breadcrumbs'];
$posts_per_row 		= $inter_options['search-posts-per-row'];

$col = '';

if( $posts_per_row == '2' ){

	$col = 'col col-lg-6 col-md-6 col-sm-12';

}elseif( $posts_per_row == '3' ){

	$col = 'col col-lg-4 col-md-4 col-sm-12';

}else{

	$col = 'col col-lg-3 col-md-3 col-sm-12';
}

if ($show_header == 'yes'): ?>

<header class="page-header" role="banner">

	<?php if ($page_layout == 'boxed'): ?>
	<!-- container -->
	<div class="container">
	<?php endif ?>
		
		<div class="row">
			
			<?php if ($show_title == 'yes'): ?>
				<?php if ($show_breadcrumbs == 'yes'): ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-12">
				<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-2">
				<?php endif; ?>
					<h1 ><?php printf( __( 'Search Results for: %s', 'inter_theme' ), get_search_query() ); ?></h1>
				</div>
			<?php endif; ?>

			<?php if ($show_breadcrumbs == 'yes'): ?>
				<?php if ($show_title == 'yes'): ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-sm-1">
				<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12 order-lg-2 order-sm-1">
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

<main class="page-main" id="archive">

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

		<?php if ( have_posts() ): ?>

			<!-- Row -->
			<div class="row">

			<?php while( have_posts() ): the_post(); ?>

			<?php $thumb_url = get_the_post_thumbnail_url() ?>

			<div class="<?php echo $col; ?>">
				
				<div class="card">

					<?php if ($thumb_url != ""): ?>
					
					<img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

					<?php endif ?>
					
					<div class="card-body">
						
						<h4 class="card-title"><?php the_title(); ?></h4>
						<p class="card-text"><?php the_excerpt(); ?></p>

						<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('View Article', 'inter_theme'); ?></a>
					</div>

					<div class="card-footer text-muted">
						<span class="fa fa-user" aria-hidden="true"></span> <?php the_author(); ?>&nbsp; / &nbsp;<span class="fa fa-calendar" aria-hidden="true"></span> <?php the_date(); ?>
					</div>

				</div>

			</div>

			<?php endwhile; ?>

			<!-- /Row -->
			</div>

			<?php inter_numeric_posts_nav(); ?>

		<?php else: ?>

			<div class="jumbotron">
				
				<h2><?php _e( 'Nothing Found', 'inter_theme' ); ?></h2>

				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'inter_theme' ); ?></p>

				<?php get_search_form(); ?>

			</div>
			
		<?php endif ?>

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
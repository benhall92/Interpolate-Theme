<?php
/**
 * Change layout
 *
 * This page will change the layout of the page depending on
 * the type of page that is being viewed.
 *
 * @link https://www.interpolate.co
 * @since 1.0.0
 *
 * @package Intertheme
 */

global $inter_options;

if( is_home() ):
	$post_id = get_option( 'page_for_posts' );
else:
	$post_id = get_the_id();
endif;

$show_featured_image = get_post_meta($post_id, '_show_featured_image', true);

$posts_per_row 	= $inter_options['archive-posts-per-row'];
$body_copy 		= $inter_options['archive-body-copy'];

$col = '';

if( $posts_per_row == '2' ){

	$col = 'col-lg-6 col-md-6 col-sm-12';

}elseif( $posts_per_row == '3' ){

	$col = 'col-lg-4 col-md-6 col-sm-12';

}else{

	$col = 'col-lg-3 col-md-6 col-sm-12';
}

?>

<?php if( is_home() ): ?>

	<?php if (have_posts()): ?>

		<?php if ($body_copy != "" && is_home() ): ?>

			<div class="row mb-4">

				<div class="col">

					<?php echo $body_copy; ?>
					
				</div>
				
			</div>

		<?php endif; ?>

		<!-- Row -->
		<div class="row row-eq-height">

		<?php while( have_posts() ): the_post(); ?>

		<?php $thumb_url = get_the_post_thumbnail_url() ?>

		<div class="<?php echo $col; ?> mb-4">
			
			<div class="card">

				<?php if ($thumb_url != ""): ?>
				
				<img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

				<?php endif ?>
				
				<div class="card-body">
					
					<h4 class="card-title"><?php the_title(); ?></h4>

					<div class="card-excerpt">
						<p class="card-text"><?php the_excerpt(); ?></p>
					</div>

					<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('View Article', 'inter_theme'); ?></a>
				</div>

				<div class="card-footer text-muted">
					<span class="fa fa-user" aria-hidden="true"></span> <?php the_author(); ?>&nbsp; | &nbsp;<span class="fa fa-calendar" aria-hidden="true"></span> <?php the_date('d-m-Y'); ?>
				</div>

			</div>

		</div>

		<?php endwhile; ?>

		<!-- /Row -->
		</div>

		<?php inter_numeric_posts_nav(); ?>

	<?php endif ?>

<?php else: ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php if ( has_post_thumbnail() && $show_featured_image ): ?>

			<div class="post-featured-image">

				<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
				
			</div>

		<?php endif; ?>

		<?php if ( is_single() ): ?>

			<div class="alert alert-secondary" role="alert">

				<span class="fa fa-user" aria-hidden="true"></span> <?php the_author(); ?> | <span class="fa fa-calendar" aria-hidden="true"></span> <?php the_date('d-m-Y'); ?>

			</div>

			<?php inter_show_tags(); ?>	

			<div class="rte">

				<?php the_content(); ?>

			</div>

		<?php elseif ( is_page() ): ?>

			<div class="rte">

				<?php the_content(); ?>

			</div>
			
		<?php endif ?>

		<?php if ( !post_password_required() ): ?>
			
			<?php if (is_singular('post') && comments_open() ): ?>
			
			<hr>

			<?php comments_template( '', true ); ?>

			<?php endif ?>

		<?php endif; ?>

	<?php endwhile; endif; ?>

<?php endif ?>
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
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php if ( has_post_thumbnail() ): ?>

	<div class="post-featured-image">

		<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
		
	</div>

<?php endif; ?>

<?php if ( is_single() ): ?>

	<div class="alert alert-light" role="alert">

		<span class="fa fa-user" aria-hidden="true"></span> <?php the_author(); ?> / <span class="fa fa-calendar" aria-hidden="true"></span> <?php the_date(); ?>

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

<?php if ( ! post_password_required() ) comments_template( '', true ); ?>

<?php endwhile; endif; ?>
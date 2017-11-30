<?php

global $inter_options;

$business_legal_name = $inter_options['business-legal-name'];
$use_logo	 	= $inter_options['use-footer-logo'];
$footer_logo 	= $inter_options['footer-logo'];
$logo_max_width = $inter_options['footer-logo-max-width'];
$js 			= $inter_options['js_editor'];

$copyright = ($business_legal_name != "" ? $business_legal_name : get_bloginfo('name') ); ?>

<div class="clear"></div>

<footer id="footer" role="contentinfo" class="py-4">

	<div class="container">

		<div class="row">

			<div class="col-lg-3">

				<?php if ( $use_logo == 'yes' ): ?>

					<img style="max-width: <?php echo $logo_max_width; ?>;" src="<?php echo $footer_logo['url']; ?>" alt="<?php echo get_bloginfo('name'); ?>">

				<?php else: ?>

					<h2><?php echo get_bloginfo('name'); ?></h2>
					
				<?php endif ?>

				<?php get_template_part('inc/layout/social-list'); ?>

			</div>

			<?php if ( is_active_sidebar( 'footer-column-one' ) ) : ?>
				<div class="col-lg-3">
					<div id="footer-column-one" class="widget-area">
						<ul class="sidebar">
						<?php dynamic_sidebar( 'footer-column-one' ); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-column-two' ) ) : ?>
				<div class="col-lg-3">
					<div id="footer-column-two" class="widget-area">
						<ul class="sidebar">
						<?php dynamic_sidebar( 'footer-column-two' ); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-column-three' ) ) : ?>
				<div class="col-lg-3">
					<div id="footer-column-three" class="widget-area">
						<ul class="sidebar">
						<?php dynamic_sidebar( 'footer-column-three' ); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
			
		</div>

	</div>

	<div id="copyright" class="copyright">
		<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'inter_theme' ), '&copy;', date( 'Y' ), esc_html($copyright) ); echo sprintf( __( ' Theme By %1$s.', 'inter_theme' ), '<a href="https://www.interpolate.co/">Interpolate co</a>' ); ?>
	</div>

</footer>

<?php wp_footer(); ?>

<?php if ($js != ""): ?>
	<script type="text/javascript">
		<?php echo $js; ?>
	</script>
<?php endif; ?>

<?php get_template_part( 'inc/markup-schema' ); ?>

</body>

</html>
<div class="clear"></div>

<footer id="footer" role="contentinfo">

	<div class="container">

		<div class="row">

			<div class="col-lg-3">
				
				<h2><?php echo get_bloginfo('name'); ?></h2>

			</div>

			<?php if ( is_active_sidebar( 'footer-column-one' ) ) : ?>
				<div class="col-lg-3">
					<div id="footer-column-one" class="widget-area">
						<ul class="xoxo">
						<?php dynamic_sidebar( 'footer-column-one' ); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-column-two' ) ) : ?>
				<div class="col-lg-3">
					<div id="footer-column-two" class="widget-area">
						<ul class="xoxo">
						<?php dynamic_sidebar( 'footer-column-two' ); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-column-three' ) ) : ?>
				<div class="col-lg-3">
					<div id="footer-column-three" class="widget-area">
						<ul class="xoxo">
						<?php dynamic_sidebar( 'footer-column-three' ); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
			
		</div>

	</div>

	<div id="copyright" class="copyright">
		<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'blankslate' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); echo sprintf( __( ' Theme By: %1$s.', 'blankslate' ), '<a href="http://tidythemes.com/">TidyThemes</a>' ); ?>
	</div>

</footer>

<?php wp_footer(); ?>

</body>

</html>
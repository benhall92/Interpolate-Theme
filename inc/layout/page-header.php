<?php

$show_header 		= get_post_meta(get_the_id(), '_show_header', true);
$show_title 		= get_post_meta(get_the_id(), '_show_title', true);
$show_breadcrumbs 	= get_post_meta(get_the_id(), '_show_breadcrumbs', true);
$page_layout 		= get_post_meta(get_the_id(), '_page_layout', true);

if ($show_header): ?>

<header class="page-header" role="banner">

	<?php if ($page_layout == 'boxed'): ?>
	<!-- container -->
	<div class="container">
	<?php endif ?>
		
		<div class="row">
			
			<?php if ($show_title): ?>
				<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-12">
					<h1><?php the_title(); ?></h1>
				</div>
			<?php endif; ?>

			<?php if ($show_breadcrumbs): ?>
				<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-sm-1 ">
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

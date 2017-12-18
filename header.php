<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php global $inter_options; ?>

<?php

$css 			= $inter_options['css_editor'];
$show_favicon 	= $inter_options['use-favicon'];
$favicon 		= $inter_options['favicon']; ?>

<head>
	<?php if ($show_favicon == 'yes'): ?>
	<link rel="icon" href="<?php echo $favicon['url']; ?>" type="image/x-icon" />
	<?php endif ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<?php wp_head(); ?>

	<?php if ($css != ""): ?>
	<style type="text/css">
		<?php echo $css; ?>
	</style>
	<?php endif ?>
</head>

<?php

$nav_align 			= ($inter_options['nav-align'] == 'left' ? 'mr-auto' : 'ml-auto');
$cta_icon 			= $inter_options['cta-nav-icon']; 
$cta_link 			= $inter_options['cta-nav-link'];
$use_header_logo 	= $inter_options['use-nav-logo'];
$nav_logo 			= $inter_options['nav-logo'];
$logo_max_width 	= $inter_options['nav-logo-max-width'];

$show_top_bar 		= $inter_options['show-top-bar'];
$top_bar_left_html 	= $inter_options['top-bar-left-html'];
$show_left 			= $inter_options['top-bar-left-mobile'];
$top_bar_right_html = $inter_options['top-bar-right-html'];
$show_right			= $inter_options['top-bar-right-mobile'];
$show_top			= $inter_options['top-bar-mobile']; ?>

<body <?php body_class(); ?>>

<?php if ($show_top_bar == 'yes'): ?>

	<div class="top-bar <?php if($show_top == 'no'):?>d-none d-sm-none d-md-block<?php endif; ?>">

		<div class="row">

			<?php if ($top_bar_left_html != ""): ?>

			<div class="col-lg-6 col-md-6 <?php if($show_left == 'no'):?>d-none d-sm-none d-md-block<?php endif; ?>">

				<div class="text-left">

					<?php echo $top_bar_left_html; ?>
					
				</div>
				
			</div>

			<?php endif; ?>

			<?php if ($top_bar_right_html != ""): ?>

			<div class="col-lg-6 col-md-6 <?php if($show_right == 'no'):?>d-none d-sm-none d-md-block<?php endif; ?>">

				<div class="text-right">

					<?php echo $top_bar_right_html; ?>
					
				</div>
				
			</div>

			<?php endif; ?>
			
		</div>
		
	</div>
	
<?php endif ?>

<nav id="topNavBar" class="navbar <?php if ($inter_options['sticky-nav'] == 'yes'): ?>sticky-top<?php endif ?> navbar-expand-lg navbar-light">


	<?php if( is_front_page() ): ?>
		<h1 class="navbar-brand" itemscope itemtype="http://schema.org/Organization">
    <?php else: ?>
		<div class="navbar-brand" itemscope itemtype="http://schema.org/Organization">
    <?php endif; ?>
    	<?php if ( $use_header_logo == 'no' ): ?>
    		<a class="navbar-brand-text" href="<?php echo get_home_url(); ?>">
    			<?php echo get_bloginfo('name'); ?>
    		</a>
    	<?php else: ?>
	        <a href="<?php echo get_home_url(); ?>" itemprop="url" class="site-header__logo-link">
	        	<?php if( is_front_page() ): ?>
	        		<span><?php echo get_bloginfo('name'); ?> | <?php echo get_bloginfo('description'); ?></span>
	        	<?php endif; ?>
	          <img style="max-width: <?php echo $logo_max_width; ?>;" src="<?php echo $nav_logo['url']; ?>" title="<?php echo get_bloginfo('name'); ?> | <?php echo get_bloginfo('description'); ?>" alt="<?php echo get_bloginfo('name'); ?> | <?php echo get_bloginfo('description'); ?>" itemprop="logo">
	        </a>
      	<?php endif; ?>
   	<?php if( is_front_page() ): ?>
		</h1>
	<?php else: ?>
		</div>
	<?php endif; ?>
  	
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<i class="fa fa-bars"></i>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">

	  	<?php wp_nav_menu(
	  		array(
	  			'theme_location' => 'main-menu',
	  			'container' => false,
	  			'menu_class' => 'navbar-nav '.$nav_align
	  		)
	  	); ?>

		<?php if ($inter_options['show-search-bar-in-nav'] == 'yes'): ?>
	  	<div class="my-2 my-lg-0">

			<?php get_search_form(); ?>

		</div>
		<?php endif ?>

		<?php if ($inter_options['show-cta-in-nav'] == 'yes'): ?>
		<div class="nav pull-right header-cta">
		<?php if ($cta_link != ''): ?>
      	<a href="<?php echo $cta_link; ?>">
      	<?php endif ?>
			<button id="navBarCTA" type="button" class="btn btn-primary navbar-btn">
				<?php if ($cta_icon != ""): ?>
				<i class="<?php echo $cta_icon; ?>"></i>
				<?php endif ?>
				<?php _e( $inter_options['cta-nav-text'], 'inter_theme'); ?>
			</button>
        <?php if ($cta_link != ''): ?>
		</a>
      	<?php endif ?>
        </div>
        <?php endif ?>

	</div>

</nav>

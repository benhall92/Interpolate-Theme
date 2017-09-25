<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
		
	<a class="navbar-brand" href="#"><?php echo get_bloginfo('name'); ?></a>
  	
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">

	  	<?php wp_nav_menu(
	  		array(
	  			'theme_location' => 'main-menu',
	  			'container' => false,
	  			'menu_class' => 'navbar-nav mr-auto'
	  		)
	  	); ?>

	  	<div class="my-2 my-lg-0">

			<form class="form-inline ">
				
				<input class="form-control mr-sm-2" type="text" placeholder="Search">
				
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

			</form>

		</div>

		<div class="nav pull-right header-cta">
          <button type="button" class="btn btn-primary navbar-btn">
            <span class="glyphicon glyphicon-plus"></span> 
            Call
          </button>
        </div>

	</div>

</nav>

<?php

$post_id = '';

if( is_home() ):

	$post_id = get_option( 'page_for_posts' );

else:

	$post_id = get_the_id();

endif;

$bottom_padding = get_post_meta($post_id, '_bottom_padding', true);
$top_padding 	= get_post_meta($post_id, '_top_padding', true); ?>

<style type="text/css">
	
.page-main{
	padding-bottom: <?php echo $bottom_padding; ?>;
	padding-top: <?php echo $top_padding; ?>;
}	

</style>
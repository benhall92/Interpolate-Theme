<?php

$bottom_padding = get_post_meta(get_the_id(), '_bottom_padding', true);
$top_padding 	= get_post_meta(get_the_id(), '_top_padding', true); ?>

<style type="text/css">
	
.page-main{
	padding-bottom: <?php echo $bottom_padding; ?>;
	padding-top: <?php echo $top_padding; ?>;
}	

</style>
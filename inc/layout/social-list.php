<?php

global $inter_options;

$facebook 		= $inter_options['facebook-link'];
$twiiter 		= $inter_options['twiiter-link'];
$instagram 		= $inter_options['instagram-link'];
$google_plus 	= $inter_options['google-plus-link'];
$pinterest 		= $inter_options['pinterest-link'];
$linkedin 		= $inter_options['linkedin-link'];
$youtube 		= $inter_options['youtube-link']; ?>

<?php

$social['fa fa-facebook-official'] = $facebook;
$social['fa fa-twitter'] = $twiiter;
$social['fa fa-instagram'] = $instagram;
$social['fa fa-google-plus'] = $google_plus;
$social['fa fa-pinterest'] = $pinterest;
$social['fa fa-linkedin'] = $linkedin;
$social['fa fa-youtube'] = $youtube; ?>

<?php if ( !empty($social) ): ?>

	<ul class="list-inline social-list">

	<?php foreach( $social as $key => $val ): ?>

		<?php if ($val != ""): ?>

		<li class="list-inline-item">
			<a target="_blank" href="<?php echo $val; ?>">
				<i class="<?php echo $key; ?>" aria-hidden="true"></i>
			</a>
		</li>

		<?php endif ?>

	<?php endforeach ?>

	</ul>
	
<?php endif ?>
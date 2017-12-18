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

$social['fab fa-facebook'] = $facebook;
$social['fab fa-twitter'] = $twiiter;
$social['fab fa-instagram'] = $instagram;
$social['fab fa-google-plus'] = $google_plus;
$social['fab fa-pinterest'] = $pinterest;
$social['fab fa-linkedin'] = $linkedin;
$social['fab fa-youtube'] = $youtube; ?>

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
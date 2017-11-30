<?php

/**
 * This page appears more confusing than it actually is...
 *
 * Google's Structured Data Testing Tool throws up an error
 * if "," appear at the end of a line and there is no code
 * following it up. Therefore checks need to be made to see
 * if the user has entered all of the information.
 *
 * Hopefully this will limit errors if the user has not entered
 * all of the required info... 
 **/
global $inter_options;

$use_markup = $inter_options['use-markup-schema'];
$business_name = $inter_options['business-name'];
$business_legal_name = $inter_options['business-legal-name'];
$business_founding_date = $inter_options['business-founding-date'];

/******************************************/
$founders = array();

$business_founder_one = $inter_options['business-founder-one'];
$business_founder_two = $inter_options['business-founder-two'];
$business_founder_three = $inter_options['business-founder-three'];

if($business_founder_one!=""): array_push($founders, $business_founder_one); endif;
if($business_founder_two!=""): array_push($founders, $business_founder_two); endif;
if($business_founder_three!=""): array_push($founders, $business_founder_three); endif;
/******************************************/

$business_logo = $inter_options['business-logo'];

/******************************************/

$address = array();

$business_street_address = $inter_options['business-streeet-address'];
$business_city = $inter_options['business-city'];
$business_region = $inter_options['business-region'];
$business_postal_code = $inter_options['business-postal-code'];
$business_country = $inter_options['business-country'];

if($business_street_address!=""):
	$address['streetAddress'] = $business_street_address;
endif;

if($business_city!=""):
	$address['addressLocality'] = $business_city;
endif;

if($business_region!=""):
	$address['addressRegion'] = $business_region;
endif;

if($business_postal_code!=""):
	$address['postalCode']= $business_postal_code;
endif;

if($business_country!=""):
	$address['addressCountry'] = $business_country;
endif;

/******************************************/

$contact = array();

$business_contact_telephone = $inter_options['business-contact-telephone'];
$business_contact_email = $inter_options['business-contact-email'];

if($business_contact_telephone!=""):
	$contact['telephone'] = $business_contact_telephone;
endif;

if($business_contact_email!=""):
	$contact['email'] = $business_contact_email;
endif;

/******************************************/

$social = array();

$facebook = $inter_options['facebook-link'];
$twiiter = $inter_options['twiiter-link'];
$instagram = $inter_options['instagram-link'];
$google_plus = $inter_options['google-plus-link'];
$pinterest = $inter_options['pinterest-link'];
$linkedin = $inter_options['linkedin-link'];
$youtube = $inter_options['youtube-link'];

if($facebook!=""): array_push($social, $facebook); endif;
if($twiiter!=""): array_push($social, $twiiter); endif;
if($instagram!=""): array_push($social, $instagram); endif;
if($google_plus!=""): array_push($social, $google_plus); endif;
if($pinterest!=""): array_push($social, $pinterest); endif;
if($linkedin!=""): array_push($social, $linkedin); endif;
if($youtube!=""): array_push($social, $youtube); endif;

/******************************************/

if ($use_markup == 'yes'): ?>

<script type="application/ld+json">
 { "@context": "http://schema.org",
 "@type": "Organization",
 	<?php if($business_name !=''):?>"name" : "<?php echo $business_name; ?>",<?php endif; ?>
 
 	<?php if($business_legal_name !=''):?>"legalName" : "<?php echo $business_legal_name; ?>",<?php endif; ?>
 	"url": "<?php echo home_url(); ?>",

 	"logo": "<?php echo $business_logo['url']; ?>",

 <?php if( $business_founding_date != ""):?>"foundingDate": "<?php echo $business_founding_date;?>",<?php endif; ?>

 	<?php if( count($founders) >0 ): ?>
	"founders": [
		<?php foreach( $founders as $item ): ?>
		{
			"@type": "Person",
			"name": "<?php echo $item; ?>"<?php ( !next($founders) ? '' : ','); ?>
		}
		<?php endforeach; ?>
	],<?php endif; ?>
	<?php if( count($address) >0 ): ?>
	"address": {
		"@type": "PostalAddress",
		<?php foreach( $address as $key => $item ):

			echo '"'.$key.'":'.'"'.$item.'"'.( !next($address) ? '' : ',');

		endforeach; ?>
	},<?php endif; ?>
	<?php if( count($contact) >0 ): ?>
	"contactPoint": {
		"@type": "ContactPoint",
		"contactType": "customer support",
		<?php foreach( $contact as $key => $item ):

			echo '"'.$key.'":'.'"'.$item.'"'.( !next($contact) ? '' : ',');

		endforeach; ?>
	},<?php endif; ?>
	"sameAs": [

		<?php foreach( $social as $item ):

			echo '"'.$item.'"'.( !next($social) ? '' : ',');

		endforeach; ?>
	]
}
</script>

<?php if (is_singular('post') ): ?>

<script type="application/ld+json">
{ "@context": "http://schema.org", 
 "@type": "BlogPosting",
 "headline": "<?php the_title(); ?>",
 "image": "<?php the_post_thumbnail_url(); ?>",
 "award": "<?php echo strip_tags( get_the_excerpt() ); ?>",
 "editor": "<?php the_author(); ?>", 
 "keywords": "<?php the_tags(); ?>",
 "publisher": "<?php bloginfo('title'); ?>",
 "url": "<?php home_url(); ?>",
 "datePublished": "<?php the_date(); ?>",
 "dateCreated": "<?php the_date(); ?>",
 "dateModified": "<?php the_modified_date(); ?>",
 "description": "<?php echo strip_tags( get_the_excerpt() ); ?>",
 "articleBody": '<?php echo strip_tags( get_the_content() ); ?>',
   "author": {
    "@type": "Person",
    "name": "<?php the_author(); ?>"
  }
 }
</script>
	
<?php endif ?>

<?php endif ?>
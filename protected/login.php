<?php
//google 
// init configuration
$clientID = '';
$clientSecret = '';
$redirectUri = 'https://dons.nextpixel.dz/signin/ggl';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

$ggl_loginUrl = $client->createAuthUrl();

# example-obtain-from-js-cookie-app.php
$fb = new Facebook\Facebook([
	'app_id' => '',
	'app_secret' => '',
	'default_graph_version' => 'v2.12',
]);
// Get the FacebookRedirectLoginHelper
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'public_profile']; // optional
$fb_loginUrl = $helper->getLoginUrl('https://dons.nextpixel.dz/signin/fb', $permissions);

?>

<main>
	<form class="login">
		<a href="<?= $ggl_loginUrl ?>">
			باستخدام الجيمايل
		</a>
		<a href="<?= $fb_loginUrl ?>">
			باستخدام الفيسبوك
		</a>
	</form>
</main>
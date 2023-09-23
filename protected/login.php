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


?>

<main>
	<form class="login">
		<a href="<?= $ggl_loginUrl ?>">
			باستخدام الجيمايل
		</a>
	</form>
</main>
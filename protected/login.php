<?php
//google 
// init configuration
$clientID = '354921473505-pe06h709f2e5rebl6em7asl122m1obhk.apps.googleusercontent.com';
$clientSecret = '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';
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
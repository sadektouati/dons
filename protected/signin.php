<?php

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$client->setAccessToken($token['access_token']);

// get profile info
$google_oauth = new Google_Service_Oauth2($client);
$google_account_info = $google_oauth->userinfo->get();

$socialId = 'google' . $google_account_info->id;
$socialProfilePage = $google_account_info->email;
$socialUserEmail = $google_account_info->email;
$socialUserName = $google_account_info->name;

$signinUserQuery = pg_query_params($conn, "select * from app.signin_doner($1)", [$socialId]);
$signinUserResult = pg_fetch_assoc($signinUserQuery);

$_SESSION['social_id'] = $socialId;

?>
<main>
    <header>You're signed in successfully :)</header>
    <meta http-equiv="refresh" content="0; url=/profile">
</main>
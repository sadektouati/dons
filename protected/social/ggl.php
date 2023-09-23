<?php

$clientID = '308602626807-8efu7nhjrb0isiv6c32e59rrtof42jau.apps.googleusercontent.com';
$clientSecret = 'cL2oS4167JqztK9ZCbOKFGSy';
$redirectUri = 'https://tijelabine.com/socialauth/ggl';

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

include_once('protected/social/signin.php');
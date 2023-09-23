social finfo_buffer
<?php

// // code comes from this url: https://github.com/facebook/php-graph-sdk/blob/master/docs/getting_started.md#extending-the-access-token
// # example-obtain-from-js-cookie-app.php
// $fb = new Facebook\Facebook([
//   'app_id' => '405060756573725',
//   'app_secret' => 'c5ff889c7e3108efe0a1a598164599b5',
//   'default_graph_version' => 'v2.10',
// ]);


// // Get the FacebookRedirectLoginHelper
// $helper = $fb->getRedirectLoginHelper();
// // @TODO This is going away soon
// //$facebookClient = $fb->getClient();

// try {
//   $accessToken = $helper->getAccessToken();
// } catch (Facebook\Exceptions\FacebookResponseException $e) {
//   // When Graph returns an error
//   $error = 'facebookGraph';
// } catch (Facebook\Exceptions\FacebookSDKException $e) {
//   // When validation fails or other local issues
//   $error = 'facebookSDK';
// }

// if (isset($accessToken)) {
//   // Logged in
//   // Store the $accessToken in a PHP session
//   // You can also set the user as "logged in" at this point
// } elseif ($helper->getError()) {
//   $error = "userCanceledConnection";
//   // There was an error (user probably rejected the request)
//   /*echo '<p>Error: ' . $helper->getError();
//     echo '<p>Code: ' . $helper->getErrorCode();
//     echo '<p>Reason: ' . $helper->getErrorReason();
//     echo '<p>Description: ' . $helper->getErrorDescription();
//     exit;*/
// }
// //echo  'here7'; exit;

// //echo  $error.' '.$accessToken;// exit; echo ' ::'.$e->getMessage(); 
// if (isset($error)) {
//   echo $error . '<br>';
//   require_once($_SERVER['DOCUMENT_ROOT'] . '/protected/genericerror.php');
//   exit;
// }

// //extend the token
// // OAuth 2.0 client handler
// $oAuth2Client = $fb->getOAuth2Client();
// // Exchanges a short-lived access token for a long-lived one
// $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

// //Now get user details...
// try {
//   // Returns a `Facebook\FacebookResponse` object
//   $response = $fb->get('/me?fields=id,name,email,age_range,link,first_name,last_name,middle_name,gender,hometown,updated_time,friends,picture', $longLivedAccessToken);
// } catch (Facebook\Exceptions\FacebookResponseException $e) {
//   //echo  'Graph returned an error: ' . $e->getMessage();
//   $error = 'accessTokenGraph';
// } catch (Facebook\Exceptions\FacebookSDKException $e) {
//   //echo  'Facebook SDK returned an error: ' . $e->getMessage();
//   $error = 'accessTokenGraph';
// }

// if (isset($error)) {
//   exit('erreur: 0066');
// }

// $user = $response->getGraphUser();
// $socialId = 'facebook' . ($user['id'] ?? null);
// $socialProfilePage = $user['link'] ?? null;
// $socialUserEmail = $user['email'] ?? null;
// $socialUserName = $user['name'] ?? null;

include_once('protected/social/signin.php');

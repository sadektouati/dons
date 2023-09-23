<?php session_start();
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
$_SESSION['social_id'] = $_SESSION['social_id'] ?? null;

require('vendor/autoload.php');
require('db/connection.php');
require('lib/index.php');

if( empty($_SESSION['social_id']) == false and ($url == '/login' or $url == '/signin/fb' or $url == '/signin/ggl') ) header('location: /');

include('protected/header.php');

    if( ( $url == '/profile' or $url == '/login' ) and empty($_SESSION['social_id']) ){
        include('protected/login.php');

    }elseif( $url == '/signin/fb' and empty($_SESSION['social_id']) ){
        include('protected/social/fb.php');

    }elseif( $url == '/signin/ggl' and empty($_SESSION['social_id']) ){
        include('protected/social/ggl.php');

    }elseif( $url == '/profile' ){
        include('protected/profile.php');

    }elseif( $url != '/' ){
        include('protected/not-found.php');

    }else{
        include('protected/search.php');

    }

require_once('protected/footer.php');

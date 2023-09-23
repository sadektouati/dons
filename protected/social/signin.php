<?php

$signinUserQuery = pg_query_params($conn, "select * from app.signin_doner($1)", [$socialId]);
$signinUserResult = pg_fetch_assoc($signinUserQuery);

$_SESSION['social_id'] = $socialId;

?>
<main>
    <header>You're signed in successfully :)</header>
    <meta http-equiv="refresh" content="0; url=/profile">
</main>
<?php

$host		= "host=127.0.0.1";
$port		= "port=6432";
$dbname		= "dbname=dons";
$credentials = 'user=app password=TenderHoney';
$options	= "";

for ($connTest = 1; $connTest < 5; $connTest++) {
	try {
		$conn = pg_connect("$host $port $dbname $credentials $options");
	} catch (Exception $connExcption) {
		$conn = false;
	} catch (Throwable $connThrowable) {
		$conn = false;
	}
	if ($conn != false) {
		break;
	}
}

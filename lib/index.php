<?php

$url = strtok($_SERVER["REQUEST_URI"], '?');

function isGetedNullable($key, $isboolean = "")
{
	return (
        empty($_GET[$key]) ? ($isboolean == 'yes' ? 'f' : null) : ($isboolean == '' ? $_GET[$key] : 't'));
}

function isSelected($value, $anchor){
    return $value == $anchor ? 'selected' : '' ;
}
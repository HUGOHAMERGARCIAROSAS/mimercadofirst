<?php

function assetImage($path)
{
    return asset('web/' . $path);
}

function priceInSole($final)
{
    return "S/ " . priceFormat($final);
}

function limitText38($text)
{
    return str_limit($text, 38);
}

function addMarginBottom40($text)
{
    return (strlen($text) > 1 && strlen($text) < 25) ? 'mb-40' : '';
}

function priceFormat($final)
{
    return sprintf("%01.1f", $final);
}
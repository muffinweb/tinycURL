<?php

/**
 * Open built-in HttpServer here and test experiencing it
 */

//Composer Autoload
require './../vendor/autoload.php';

use Muffinweb\tinyCURL;
use Muffinweb\tinyCURLException;

try {
    $curl = new tinyCURL();
    $curl->get('https://ntv.com.tr')->render();
} catch (tinyCURLException $e){
    echo $e->getMessage();
}
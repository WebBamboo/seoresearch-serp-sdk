<?php
require_once('vendor/autoload.php');

use Seoresearch\Sdk;
use Seoresearch\Serp;

$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

$sdk = new Sdk($apiKey, $apiSecret);

var_dump($sdk->getHistory());
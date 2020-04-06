<?php
require_once('vendor/autoload.php');
use Seoresearch\Sdk;
use Seoresearch\Serp;

$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

$sdk = new Sdk($apiKey, $apiSecret);

$serp = new Serp();
$serp->keyword = 'serp api google';
$serp->endpoint = 'http://your-webhook-url.com/webhook.php';

$serp->sendToApi($sdk);
var_dump($serp);
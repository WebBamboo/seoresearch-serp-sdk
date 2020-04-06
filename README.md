# Google SERP Results in PHP
SEOResearch search API enables you to scrape Google search results straight from your code. It requires a [free registration](https://app.seoresearch.net) at Seoresearch.net
# Quick start
For composer ([Packagist](https://packagist.org/packages/webbamboo/seoresearch-serp-sdk)).
```bash
composer require webbamboo/seoresearch-serp-sdk
```
Load the dependency in your script:
```php
<?php
require __DIR__ . '/vendor/autoload.php';
```

Get your api key and secret from https://app.seoresearch.net/user/profile 
# Usage
You can check out the examples folder for usage examples. The workflow is the following

- [You create a SERP request](https://seoresearch.net/documents/serp-request/) - This adds your SERP query to our system and one of our bots will process it in up to 10 minutes, depending on the current load. You can provide an "Endpoint" parameter where our server can POST the results once they are dono, or you can manually query the serper
- [Get SERP results](https://seoresearch.net/documents/serp-results/) - You query our API with the ID you've received in the previous method

## Instantiate the api object with your api key and secret
```php
<?php
require_once('vendor/autoload.php');

use Seoresearch\Sdk;
use Seoresearch\Serp;

$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

$sdk = new Sdk($apiKey, $apiSecret);
```

## Get SERP history
```php
<?php
require_once('vendor/autoload.php');

use Seoresearch\Sdk;
use Seoresearch\Serp;

$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

$sdk = new Sdk($apiKey, $apiSecret);

var_dump($sdk->getHistory());
```
## Create SERP request
```php
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
```
## Get SERP results
```php
<?php
require_once('vendor/autoload.php');

use Seoresearch\Sdk;
use Seoresearch\Serp;

$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

$sdk = new Sdk($apiKey, $apiSecret);

$serp = new Serp();
$serp->fromId($sdk, 'YOUR_SERP_ID');

var_dump($serp);
```
## Webhook
```php
<?php
require_once('vendor/autoload.php');

use Seoresearch\Sdk;
use Seoresearch\Serp;

$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

$sdk = new Sdk($apiKey, $apiSecret);

var_dump($sdk->webhook($_POST, true));
```
## Anatomy of a SERP object
In order to populate a Serp object you can set the following properties: location, endpoint, mobile, keyword. You can see more about how that works in the [Create SERP request](#Create_SERP_request_49) section.
Methods:
- fromId(Sdk $sdk, $id) - Queries the API and hydrates the Serp object with the data. Takes an SDK object and Serp ID as a parameter.
- fromData($apiData) - Hydrates a Serp object from API response string
- sendToApi(Sdk $sdk) - Creates the actual Serp object in the API and updates the Serp object with the ID of the created resource

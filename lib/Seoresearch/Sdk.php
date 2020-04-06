<?php
namespace Seoresearch;

class Sdk
{
    protected $apiKey;
    protected $apiSecret;
    
    public function __construct($key, $secret)
    {
        $this->apiKey = $key;
        $this->apiSecret = $secret;
    }

    public function createSerp($data)
    {
        $apiMethod = '/api/v1/serp';
        
        return $this->buildPOSTRequest($apiMethod, $data);
    }

    public function getSerp($id)
    {
        $apiMethod = '/api/v1/queue/'.$id;
        
        return $this->buildGETRequest($apiMethod);
    }

    public function getHistory()
    {
        $apiMethod = '/api/v1/history';  

        return $this->buildGETRequest($apiMethod);
    }

    public function webhook($postData, $debug=false)
    {
        $serp = new Serp();
        $serp->fromData($postData);

        if($debug)
        {
            file_put_contents('webhook.log', print_r($serp, true), FILE_APPEND | LOCK_EX);
        }

        return $serp;
    }

    private function buildPOSTRequest($apiMethod, $data)
    {
        $url = $this->getApiEndpoint($apiMethod);

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { throw new \Exception("Unable to send request"); }

        return json_decode($result, true);
    }

    private function buildGETRequest($apiMethod)
    {
        $url = $this->getApiEndpoint($apiMethod);

        return json_decode(file_get_contents($url), 1);
    }

    private function getApiEndpoint($apiMethod)
    {
        return sprintf('https://app.seoresearch.net%s?apiKey=%s&secret=%s', $apiMethod, $this->apiKey, $this->secret);
    }
}
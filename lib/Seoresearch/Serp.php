<?php
namespace Seoresearch;

class Serp
{
    protected $id;
    protected $location = 'US';
    protected $endpoint;
    protected $mobile = false;
    protected $keyword;
    protected $status;

    public function setup($keyword, $mobile=false, $location=null, $endpoint=null)
    {
        $this->keyword = $keyword;
        $this->mobile = $mobile;
        $this->location = $location;
        $this->endpoint = $endpoint;
    }

    public function fromId(Sdk $sdk, $id)
    {
        $apiData = $sdk->getSerp($id);
        $this->fromData($apiData);

        return $this;
    }

    public function fromData($apiData)
    {
        $properties = ['id', 'keyword', 'mobile', 'results', 'location', 'status'];
        foreach($properties as $property)
        {
            if(isset($apiData[$property]))
            {
                $this->$property = $apiData[$property];
            }
        }
    }

    public function sendToApi(Sdk $sdk)
    {
        $response = $sdk->createSerp([
            'keyword' => $this->keyword,
            'mobile' => $this->mobile,
            'location' => $this->location,
            'endpoint' => $this->endpoint
        ]);
        if(isset($response['id']))
        {
            $this->id = $response['id'];
        }
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }


}
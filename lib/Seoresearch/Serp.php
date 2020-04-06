<?php
namespace Seoresearch;

class Serp
{
    protected $id;
    protected $location;
    protected $endpoint;
    protected $mobile;
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
        $sdk->createSerp([
            'keyword' => $this->keyword,
            'mobile' => $this->mobile,
            'location' => $this->location,
            'endpoint' => $this->endpoint
        ]);
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
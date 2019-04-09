<?php
use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

class SearchElastic
{


    private $client = null;

    public function __construct()
    {
           $hosts = ['localhost:9200'];
        $this->client = Elasticsearch\ClientBuilder::create()
            ->setHosts($hosts)
            ->build();
    }
}

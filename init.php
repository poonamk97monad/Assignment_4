<?php
use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$hosts = ['localhost:9200'];

$client = Elasticsearch\ClientBuilder::create()
    ->setHosts($hosts)
    ->build();

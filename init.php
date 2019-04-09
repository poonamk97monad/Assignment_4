<?php

require 'vendor/autoload.php';

$strHosts = ['localhost:9200'];

$objClient = Elasticsearch\ClientBuilder::create()
    ->setHosts($strHosts)
    ->build();

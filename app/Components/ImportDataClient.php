<?php

namespace App\Components;

use GuzzleHttp\Client;

class ImportDataClient
{
    public $client;
    /**
     * ImportDataClient constructor.
     * @param $client
     */
    public function __construct() {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://bulletinboard-servic/public/api/V1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
            'verify' => false
        ]);
    }
}

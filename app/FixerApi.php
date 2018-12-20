<?php

namespace App;

use GuzzleHttp\Client;
class FixerApi
{
    private static $key = 'b70c4eaffe72339e0ef2a4f80854dd16';
    private static $base_url = 'http://data.fixer.io/api';
    //

    private static function request($endpoint, $data = []) {
        // combine endpoint with base url
        $url = implode('/', [static::$base_url, $endpoint]);

        // Expand GET payload with access key
        $data = array_merge(['access_key' => static::$key], $data);

        // Build request url
        $request_url = implode('?', [$url, http_build_query($data)]);

        // Make request
        $client = new Client();
        $result = $client->get($request_url);

        // If request did not return a successful status - return null
        if($result->getStatusCode() !== 200){
            return null;
        }

        return json_decode($result->getBody());
    }

    public static function latest() {
        return static::request('latest');
    }   

    public static function historical($date) {
        return static::request($date);
    }
}

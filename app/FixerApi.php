<?php

namespace App;
use App\FixerApiResponses;
use GuzzleHttp\Client;
class FixerApi
{
    private static $key = 'b70c4eaffe72339e0ef2a4f80854dd16';
    private static $base_url = 'http://data.fixer.io/api';
    //

    private static function get_stored_response($endpoint, $data) {
        $response = FixerApiResponses::where('endpoint', $endpoint)
            ->where('payload_sent', http_build_query($data))
            ->first();

        if (!empty($response)) {
            $response->hits += 1;
            $response->save();
            return $response;
        }

        return null;
    }

    private static function save_response($endpoint, $data, $payload_received, $status_code) {
        $entry                   = new FixerApiResponses();
        $entry->endpoint         = $endpoint;
        $entry->payload_sent     = http_build_query($data);
        $entry->payload_received = $payload_received;
        $entry->status_code      = $status_code;
        $entry->save();
    }

    private static function request($endpoint, $data = []) {
        // combine endpoint with base url
        $url = implode('/', [static::$base_url, $endpoint]);

        // Expand GET payload with access key
        $data = array_merge(['access_key' => static::$key], $data);

        
        $saved_response = static::get_stored_response($endpoint, $data);
        if(!empty($saved_response)) {
            return json_decode($saved_response->payload_received);
        }

        // Build request url
        $request_url = implode('?', [$url, http_build_query($data)]);

        // Make request
        $client = new Client();
        $result = $client->get($request_url);

        // If request did not return a successful status - return null
        if($result->getStatusCode() !== 200){
            return null;
        }

        static::save_response($endpoint, $data, $result->getBody(), $result->getStatusCode());

        return json_decode($result->getBody());
    }

    public static function latest() {
        return static::request('latest');
    }   

    public static function historical($date) {
        return static::request($date);
    }
}

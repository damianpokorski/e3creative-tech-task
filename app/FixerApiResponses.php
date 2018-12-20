<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixerApiResponses extends Model
{
    //
    protected $table = 'fixer_api_responses';

    protected $endpoint;
    protected $payload_sent;
    protected $payload_received;
    protected $status_code;
    protected $hits;
}

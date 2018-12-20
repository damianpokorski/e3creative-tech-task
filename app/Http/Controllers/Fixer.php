<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FixerApi;
use App\FixerApiResponses;
class Fixer extends Controller
{
    //
    public function index(){
        return response()->view('frontend');
    }



    public function historical($day, $month){
        $day             = str_pad($day, 2, "0", STR_PAD_LEFT);
        $month           = str_pad($month, 2, "0", STR_PAD_LEFT);
        $timestamp       = strtotime(implode('-', [$day, $month, date('Y')]));
        $seconds_in_year = 365 * 24 * 60 * 60;

        // If day if in the future of current year, - substract a year
        if($timestamp > time()) {
            $timestamp -= $seconds_in_year;
        }

        // Only allow as much as a year in the past
        $timestamp = max($timestamp, time() - $seconds_in_year);

        $date      = date('Y-m-d', $timestamp);
        return response()->json(FixerApi::historical($date));
    }

    public function past_submission_aggregator() {
        $responses = FixerApiResponses::orderBy('hits', 'desc')
            ->get(['endpoint', 'hits'])
            ->toArray();
        return response()->json($responses);
    }
}

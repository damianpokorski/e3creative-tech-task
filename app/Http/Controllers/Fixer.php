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
        $day       = str_pad($day, 2, "0", STR_PAD_LEFT);
        $month     = str_pad($month, 2, "0", STR_PAD_LEFT);
        $timestamp = strtotime(implode('-', [$day, $month, date('Y')]));
        $date      = date('Y-m-d', $timestamp);

        // Note add an edge case for if birthday is in the future -> then substract a year

        return response()->json(FixerApi::historical($date));
    }

    public function past_submission_aggregator() {
        $responses = FixerApiResponses::orderBy('hits', 'desc')
            ->get(['endpoint', 'hits'])
            ->toArray();
        return response()->json($responses);
    }
}

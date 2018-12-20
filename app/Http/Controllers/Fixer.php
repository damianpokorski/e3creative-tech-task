<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FixerApi;
class Fixer extends Controller
{
    //
    public function index(){
        echo 'Index';
    }



    public function historical($day, $month){
        $timestamp = strtotime(implode('-', [$day, $month, date('Y')]));
        $date      = date('Y-m-d', $timestamp);
        //var_dump($date);
        var_dump(FixerApi::historical($date));
    }
}

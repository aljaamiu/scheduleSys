<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class generalController extends Controller
{
    //
    function all(){
        date_default_timezone_set('Africa/Accra');


        $jsonItems = file_get_contents("json/items.json");
        $items = json_decode($jsonItems);

        $jsonHolidays = file_get_contents("json/holidays.json");
        $holidays1 = json_decode($jsonHolidays);

        $holidays = array();
        foreach($holidays1 as $jh){

            array_push($holidays, $jh->day);
        }

        $auto = 0;

        $allNextTime = array();

        foreach ($items as $key => $item) {

            $started = $item->started;
            $interval = $item->interval;

            $auto1 = $auto + 2;
            $item = array();

            $today = date('Y-m-d', strtotime($started));

            $nextYear1 = new DateTime('1st January Next Year');
            $nextYear = $nextYear1->format('Y-m-d');

            $diff = strtotime($nextYear) - strtotime($today);
            // return $diff;
            
            // 1 day = 24 hours
            // 24 * 60 * 60 = 86400 seconds
            $daysLeft = abs(round($diff / 86400));


            // Add days
            $nextTime = date('Y-m-d', strtotime($today. ' + 1 days'));

            $counter = 0;

            for ($i=0; $i < $daysLeft; $i++) { 

                //check if next year
                if ($nextTime < $nextYear){

                    $timestamp = strtotime($nextTime);
                    $weekday= date("l", $timestamp );
                    $normalized_weekday = strtolower($weekday);
                    if (($normalized_weekday == "saturday") || ($normalized_weekday == "sunday")) {
                        //
                        $nextTime = date('Y-m-d', strtotime($nextTime. ' + 1 days'));
                    }else{

                        if (in_array($nextTime, $holidays)){
                            $nextTime = date('Y-m-d', strtotime($nextTime. ' + 1 days'));
                        }else{
                            $counter++;
                            if($counter%$interval == 0){
                                array_push($item, $nextTime);
                                $nextTime = date('Y-m-d', strtotime($nextTime. ' + 1 days'));
                            }else{
                                $nextTime = date('Y-m-d', strtotime($nextTime. ' + 1 days'));
                            }
                        }
                        
                    }	

                }
            }
            $auto = $auto1;
            array_push($allNextTime, $item);
            
        }

        // $jsonAllNext = file_get_contents("json/allNext.json");
        // $allNext1 = json_decode($jsonAllNext);

        $fileName = "json/allNext.json";
        if(file_put_contents($fileName, json_encode($allNextTime) ) ){
            return response()->json(['success'=>'Done', 'items'=> $items, 'next'=> $allNextTime]);
            // return "Done";
            return $allNextTime;
            return json_encode($allNextTime);
        }else{
            return "error";
        }
    }
}

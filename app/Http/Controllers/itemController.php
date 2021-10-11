<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class itemController extends Controller
{
    //
    ///get all
    public function getAll(){

        $jsonData = file_get_contents("json/items.json");

        $dJsonData = json_decode($jsonData);

        $developers_record = array();

        $fid = 0;
        foreach($dJsonData as $j){
            $output = array();
            $fid++;

            $output["name"] = $j->name;
            $output["started"] = $j->started;
            $output["interval"] = $j->interval;
            $output["j_id"] = $fid;
            // echo $j->name;

            array_push($developers_record, $output);
            
        }
        return $developers_record;
        return json_encode($developers_record);

        // return $dJsonData;
        
    }

    ////

    ////save to json
    public function save(Request $req){

        // return $req;
        if( !empty($req->name) && !empty($req->interval) && !empty($req->started) ){
            //
            $name = ucwords( $req->name);
            $started = $req->started;
            $interval = $req->interval;

            $jsonData = file_get_contents("json/items.json");
            
            $dJsonData = json_decode($jsonData);

            $count = count($dJsonData);

            $developers_record = array();
            $fid = 0;
            $output = array();
            foreach($dJsonData as $j){
                $fid++;

                $output = array();

                $output["name"] = $j->name;
                $output["started"] = $j->started;
                $output["interval"] = $j->interval;
                // echo $j->name;

                array_push($developers_record, $output);
                
            }

            $output["name"] = $name;
            $output["started"] = $started;
            $output["interval"] = $interval;
            // $output["j_id"] = $count++;

            array_push($developers_record, $output);

            $fileName = "json/items.json";
            if(file_put_contents($fileName, json_encode($developers_record) ) ){
                return response()->json(['success'=>'Done']);
                return "Done";
            }else{
                return "error";
            }

        }else{
            //fill all
            return response()->json(['success'=>'Fill All', 'req'=> $req]);
        }
        
    }

    ///delete
    public function remove($j_id = null){

        if( !empty($j_id) ){
            
            $j_id = $j_id;

            $jsonData = file_get_contents("json/items.json");
            
            $dJsonData = json_decode($jsonData);

            // return count($dJsonData);
            $developers_record = array();
            $fid = 0;
            foreach($dJsonData as $j){
                $fid++;

                $output = array();

                
                // echo $j->name;

                if($fid == $j_id){
                    //
                }else{
                    $output["name"] = $j->name;
                    $output["started"] = $j->started;
                    $output["interval"] = $j->interval;
                    array_push($developers_record, $output);
                }
                
            }

            $fileName = "json/items.json";
            if(file_put_contents($fileName, json_encode($developers_record) ) ){
                return response()->json(['success'=>'Done']);
                return "Done";
            }else{
                return "error";
            }

        }else{
            //fill all
            return 'No ID Given';
        }
        
    }

    ///update
    function update(Request $req){
        // return $req;

        if( !empty($req->j_id) && !empty($req->name) && !empty($req->started) && !empty($req->interval) ){
            //
            $name = ucwords( $req->name);
            $interval = $req->interval;
            $started = $req->started;
            $j_id = $req->j_id;

            $jsonData = file_get_contents("json/items.json");
            
            $dJsonData = json_decode($jsonData);

            // return count($dJsonData);
            $developers_record = array();
            $fid = 0;
            foreach($dJsonData as $j){
                $fid++;

                $output = array();

                
                // echo $j->name;

                if($fid == $j_id){
                    $output["name"] = $name;
                    $output["interval"] = $interval;
                    $output["started"] = $started;
                    array_push($developers_record, $output);
                }else{
                    $output["name"] = $j->name;
                    $output["interval"] = $j->interval;
                    $output["started"] = $j->started;
                    array_push($developers_record, $output);
                }
                
            }

            $fileName = "json/items.json";
            if(file_put_contents($fileName, json_encode($developers_record) ) ){
                return response()->json(['success'=>'Done']);
                return "Done";
            }else{
                return "error";
            }

        }else{
            //fill all
            return response()->json(['success'=>'Fill All', 'req'=> $req]);
            return 'Fill All';
        }
        
    }
}

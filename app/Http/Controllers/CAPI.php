<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;


class CAPI extends Controller
{
    #Getters
    public static function api_get_patients(){
        return response()->json([
            'data' => Patient::all(),
        ], 200);
    }

    public static function api_post_patient(Request $request){
        if(Patient::add($request)){
            return response()->json(["message"=>"Patient added successfully"], 200);
        }else{
            return response()->json(["message"=>"An error occured while adding patient"], 200);
        }
    }
}

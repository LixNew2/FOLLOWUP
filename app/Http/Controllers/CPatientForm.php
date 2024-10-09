<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class CPatientForm extends Controller{
    public function show_page(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application{
        return view('Patient/patient_form');
    }

    public function add_patient(Request $request){
        if(Patient::add($request)){ // If patient has been added, redirect
            return redirect("/patient");
        };

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class CPatient extends Controller{
    public function show_page(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {   $patients = Patient::all(); // Get all patients in the table Patient
        return view('Patient/index', compact('patients'));
    }

    // General delete patient method
    public function del_patient($id){
        if(Patient::destroy($id)){ // If patient has been deleted, redirect
            return redirect('/patient');
        };

    }

    //General edit patient method
    public function edit_patient($id, $name, $lastname, $date){
        if(Patient::edit($id, $name, $lastname, $date)){ // If patient has been edited, redirect
            return redirect('/patient');
        };
    }

    //FORM

    public function show_page_form(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application{
        return view('Patient/patient_form');
    }

    public function add_patient(Request $request){
        if(Patient::add($request)){ // If patient has been added, redirect
            return redirect("/patient");
        };
    }

    public function show_page_spec($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $patient = Patient::find($id);
        $incidents = $patient->get_incidents;

        return view('Patient/patient_spec', compact('patient', 'incidents'));
    }
}

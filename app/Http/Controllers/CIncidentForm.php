<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Patient;
use Illuminate\Http\Request;

class CIncidentForm extends Controller{

    public function show_page(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application{
        $patients = Patient::all(); // Get all incidents in the table Incident
        return view('Incident/incident_form', compact('patients'));
    }

    public function add_incident(Request $request){
        if(Incident::add($request)){ // If incidents has been added, redirect
            return redirect("/incident");
        };

    }

}

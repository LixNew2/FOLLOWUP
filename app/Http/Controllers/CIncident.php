<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Incident;
use Illuminate\Http\Request;

class CIncident extends Controller{
    public function show_page(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {   $incidents = Incident::all();
        return view('Incident/index', compact('incidents'));
    }

    public function show_form(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application{
        $patients = Patient::all(); // Get all incidents in the table Incident
        return view('Incident/incident_form', compact('patients'));
    }

    //General edit incident method
    public function del_incident($id){
        if(Incident::destroy($id)){ // If incident has been deleted, redirect
            return redirect('/incident');
        }
    }

    //Delete incident with spec view
    public function del_incident_with_spec($id, $patient_id){
        if(Incident::destroy($id)){ // If incident has been deleted, redirect
            return redirect("/patient_spec/{$patient_id}");
        };
    }

    //General edit incident method
    public function edit_incident($id, $desc, $level, $date){
        if(Incident::edit($id, $desc, $level, $date)){ // If incident has been edited, redirect
            return redirect('/incident');
        };
    }

    //Edit incident with spec view
    public function edit_incident_with_spec($id, $patient_id, $desc, $level, $date){
        if(Incident::edit($id, $desc, $level, $date)){ // If incident has been edited, redirect
            return redirect("/patient_spec/{$patient_id}");
        };
    }


    // FORM

    public function show_page_form(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application{
        $patients = Patient::all(); // Get all incidents in the table Incident
        return view('Incident/incident_form', compact('patients'));
    }

    public function add_incident(Request $request){
        if(Incident::add($request)){ // If incidents has been added, redirect
            return redirect("/incident");
        };

    }

    //API
    public function store(){

    }
}

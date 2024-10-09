<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Patient;

class CPatientSpec extends Controller{
    public function show_page($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $patient = Patient::find($id);
        $incidents = $patient->get_incidents;

        return view('Patient/patient_spec', compact('patient', 'incidents'));
    }
}

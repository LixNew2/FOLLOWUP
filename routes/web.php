<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/patient', [\App\Http\Controllers\CPatient::class, 'show_page']);
Route::get('/incident', [\App\Http\Controllers\CIncident::class, 'show_page']);
Route::get('/patient_spec/{id}', [\App\Http\Controllers\CPatient::class, 'show_page_spec']);
Route::get('/patient_form', [\App\Http\Controllers\CPatient::class, 'show_page_form']);
Route::get('/incident_form', [\App\Http\Controllers\CIncident::class, 'show_page_form']);
Route::get('/patient/{id}', [\App\Http\Controllers\CPatient::class, 'del_patient']);
Route::get('/incident/{id}', [\App\Http\Controllers\CIncident::class, 'del_incident']);
Route::get('/incident/{id}/{patient_id}', [\App\Http\Controllers\CIncident::class, 'del_incident_with_spec']);
Route::get('/incident/{id}/{desc}/{level}/{date}', [\App\Http\Controllers\CIncident::class, 'edit_incident']);
Route::get('/patient/{id}/{name}/{lastname}/{date}', [\App\Http\Controllers\CPatient::class, 'edit_patient']);
Route::get('/incident_spec/{id}/{patient_id}/{desc}/{level}/{date}', [\App\Http\Controllers\CIncident::class, 'edit_incident_with_spec']);

Route::post('/patient/add', [\App\Http\Controllers\CPatient::class, 'add_patient'])->name('patient.add');
Route::post('/incident/add', [\App\Http\Controllers\CIncident::class, 'add_incident'])->name('incident.add');

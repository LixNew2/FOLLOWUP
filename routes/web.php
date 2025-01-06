<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login/login');
});

Route::get('/patient', [\App\Http\Controllers\CPatient::class, 'show_page'])->middleware('auth:sanctum');
Route::get('/incident', [\App\Http\Controllers\CIncident::class, 'show_page'])->middleware('auth:sanctum');
Route::get('/patient_spec/{id}', [\App\Http\Controllers\CPatient::class, 'show_page_spec'])->middleware('auth:sanctum');
Route::get('/patient_form', [\App\Http\Controllers\CPatient::class, 'show_page_form'])->middleware('auth:sanctum');
Route::get('/incident_form', [\App\Http\Controllers\CIncident::class, 'show_page_form'])->middleware('auth:sanctum');
Route::get('/patient/{id}', [\App\Http\Controllers\CPatient::class, 'del_patient'])->middleware('auth:sanctum');
Route::get('/incident/{id}', [\App\Http\Controllers\CIncident::class, 'del_incident'])->middleware('auth:sanctum');
Route::get('/incident/{id}/{patient_id}', [\App\Http\Controllers\CIncident::class, 'del_incident_with_spec'])->middleware('auth:sanctum');
Route::get('/incident/{id}/{desc}/{level}/{date}', [\App\Http\Controllers\CIncident::class, 'edit_incident'])->middleware('auth:sanctum');
Route::get('/patient/{id}/{name}/{lastname}/{date}/{email}/{age_surdite}', [\App\Http\Controllers\CPatient::class, 'edit_patient']);
Route::get('/incident_spec/{id}/{patient_id}/{desc}/{level}/{date}', [\App\Http\Controllers\CIncident::class, 'edit_incident_with_spec'])->middleware('auth:sanctum');
Route::get('/login', [\App\Http\Controllers\CLogin::class, 'show_page'])->name('login');


Route::post('/patient/add', [\App\Http\Controllers\CPatient::class, 'add_patient'])->name('patient.add')->middleware('auth:sanctum');
Route::post('/incident/add', [\App\Http\Controllers\CIncident::class, 'add_incident'])->name('incident.add')->middleware('auth:sanctum');
Route::post('/login', [\App\Http\Controllers\CLogin::class, 'login'])->name('login.con');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return response()->json([
        'message' => 'Success',
        'data' => $request->all(),
        'status' => 200
    ]);
})->middleware('auth:sanctum');

Route::get('/get_patients', [\App\Http\Controllers\CAPI::class, "api_get_patients"])->middleware('auth:sanctum');
Route::post('/add_patient', [\App\Http\Controllers\CAPI::class, "api_post_patient"])->middleware('auth:sanctum');

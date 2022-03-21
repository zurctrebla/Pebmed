<?php

use App\Http\Controllers\Api\{
    PatientController,
    UserController
};

use Illuminate\Support\Facades\Route;

Route::apiResource('/users', UserController::class);

Route::apiResource('/users/{user}/patients', PatientController::class);


Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

<?php

use App\Http\Controllers\Api\{
    PatientController,
    SchedulingController,
    UserController
};

use Illuminate\Support\Facades\Route;

Route::apiResource('/patients/{patient}/schedules', SchedulingController::class);

Route::apiResource('/users/{user}/patients', PatientController::class);

Route::apiResource('/users', UserController::class);

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

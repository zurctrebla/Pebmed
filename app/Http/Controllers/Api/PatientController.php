<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePatient;
use App\Http\Resources\PatientResource;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user)
    {
        $patients = $this->patientService->getPatientsByUser($user);

        return PatientResource::collection($patients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdatePatient  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePatient $request, $user)
    {
        $Patient = $this->patientService->createNewPatient($request->validated());

        return new PatientResource($Patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $identify)
    {
        $user = $this->patientService->getPatientByUser($user, $identify);

        return new PatientResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdatePatient $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePatient $request, $user, $identify)
    {
        $this->patientService->updatePatient($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user, $identify)
    {
        $this->patientService->deletePatient($identify);

        return response()->json([], 204);
    }
}
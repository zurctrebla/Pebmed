<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateScheduling;
use App\Http\Resources\SchedulingResource;
use App\Services\SchedulingService;
use Illuminate\Http\Request;

class SchedulingController extends Controller
{
    protected $schedulingService;

    public function __construct(SchedulingService $schedulingService)
    {
        $this->schedulingService = $schedulingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient)
    {
        $schedules = $this->schedulingService->getSchedulesByPatient($patient);

        return SchedulingResource::collection($schedules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateScheduling  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateScheduling $request, $patient)
    {
        $patient = $this->schedulingService->createNewScheduling($request->validated());

        return new SchedulingResource($patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient, $identify)
    {
        $patient = $this->schedulingService->getSchedulingByPatient($patient, $identify);

        return new SchedulingResource($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateScheduling $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateScheduling $request, $patient, $identify)
    {
        $this->schedulingService->updateScheduling($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($patient, $identify)
    {
        $this->schedulingService->deleteScheduling($identify);

        return response()->json([], 204);
    }
}

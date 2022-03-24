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
    * @OA\Get(
    *      path="/patients/{patient}/schedules",
    *      operationId="getSchedulesList",
    *      tags={"Schedules"},
    *      summary="Get list of schedules",
    *      description="Returns list of schedules",
    *      @OA\Parameter(
    *          name="patient",
    *          description="Patient uuid",
    *          required=true,
    *          in="path",
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation"
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    *     )
    */
    public function index($patient)
    {
        $schedules = $this->schedulingService->getSchedulesByPatient($patient);

        return SchedulingResource::collection($schedules);
    }

    /**
    * @OA\Post(
    *      path="/patients/{patient}/schedules/",
    *      operationId="storeSchedules",
    *      tags={"Schedules"},
    *      summary="Store new schedules",
    *      description="Returns schedules data",
    *      @OA\Parameter(
    *          name="patient",
    *          description="Patient uuid",
    *          required=true,
    *          in="path",
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(property="patient", type="string"),
    *              @OA\Property(property="scheduling", type="datetime")
    *          )
    *      ),
    *      @OA\Response(
    *          response=201,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *
    *          )
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="Bad Request"
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    * )
    */
    public function store(StoreUpdateScheduling $request, $patient)
    {
        $patient = $this->schedulingService->createNewScheduling($request->validated());

        return new SchedulingResource($patient);
    }

    /**
    * @OA\Get(
    *      path="/patients/{patient}/schedules/{scheduling}",
    *      operationId="getSchedulingList",
    *      tags={"Schedules"},
    *      summary="Get schedules",
    *      description="Returns list of schedules",
    *       @OA\Parameter(
    *         description="Parameter with multiple examples",
    *         in="path",
    *         name="patient",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *     ),
    *       @OA\Parameter(
    *         description="Parameter with multiple examples",
    *         in="path",
    *         name="scheduling",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *     ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation"
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    *     )
    */
    public function show($patient, $identify)
    {
        $patient = $this->schedulingService->getSchedulingByPatient($patient, $identify);

        return new SchedulingResource($patient);
    }

    /**
    * @OA\Put(
    *      path="/patients/{patient}/schedules/{scheduling}",
    *      operationId="updateScheduling",
    *      tags={"Schedules"},
    *      summary="Update existing scheduling",
    *      description="Returns updated scheduling data",
    *      @OA\Parameter(
    *          description="Parameter with multiple examples",
    *          in="path",
    *          name="patient",
    *          required=true,
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\Parameter(
    *          description="Parameter with multiple examples",
    *          in="path",
    *          name="scheduling",
    *          required=true,
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *              @OA\Property(property="patient", type="string"),
    *              @OA\Property(property="scheduling", type="date")
    *          )
    *      ),
    *      @OA\Response(
    *          response=202,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *              @OA\Property(property="identify", type="string"),
    *              @OA\Property(property="patient", type="string"),
    *              @OA\Property(property="scheduling", type="date")
    *          )
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="Bad Request"
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Resource Not Found"
    *      )
    * )
    */
    public function update(StoreUpdateScheduling $request, $patient, $identify)
    {
        $this->schedulingService->updateScheduling($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
    * @OA\Delete(
    *      path="/patients/{patient}/schedules/{scheduling}",
    *      operationId="deleteScheduling",
    *      tags={"Schedules"},
    *      summary="Delete existing scheduling",
    *      description="Deletes a record and returns no content",
    *       @OA\Parameter(
    *           description="Parameter with mutliple examples",
    *           in="path",
    *           name="patient",
    *           required=true,
    *           @OA\Schema(type="string"),
    *           @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")
    *       ),
    *       @OA\Parameter(
    *           description="Parameter with multiple examples",
    *           in="path",
    *           name="scheduling",
    *           required=true,
    *           @OA\Schema(type="string"),
    *           @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")
    *      ),
    *      @OA\Response(
    *          response=204,
    *          description="Successful operation",
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Resource Not Found"
    *      )
    * )
    */
    public function destroy($patient, $identify)
    {
        $this->schedulingService->deleteScheduling($identify);

        return response()->json([], 204);
    }
}

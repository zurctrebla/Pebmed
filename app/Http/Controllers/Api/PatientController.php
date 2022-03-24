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
    * @OA\Get(
    *      path="/users/{uuid}/patients",
    *      operationId="getPatientsList",
    *      tags={"Patients"},
    *      summary="Get list of patients",
    *      description="Returns list of patients",
    *      @OA\Parameter(
    *          name="uuid",
    *          description="User uuid",
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
    public function index($user)
    {
        $patients = $this->patientService->getPatientsByUser($user);

        return PatientResource::collection($patients);
    }

    /**
    * @OA\Post(
    *      path="/users/{uuid}/patients/",
    *      operationId="storePatient",
    *      tags={"Patients"},
    *      summary="Store new patient",
    *      description="Returns patient data",
    *      @OA\Parameter(
    *          name="uuid",
    *          description="User uuid",
    *          required=true,
    *          in="path",
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(property="user", type="string"),
    *              @OA\Property(property="name", type="string"),
    *              @OA\Property(property="phone", type="string"),
    *              @OA\Property(property="email", type="string"),
    *              @OA\Property(property="dob", type="date"),
    *              @OA\Property(property="gender", type="string"),
    *              @OA\Property(property="height", type="number"),
    *              @OA\Property(property="weight", type="number")
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
    public function store(StoreUpdatePatient $request, $user)
    {
        $Patient = $this->patientService->createNewPatient($request->validated());

        return new PatientResource($Patient);
    }

    /**
    * @OA\Get(
    *      path="/users/{user}/patients/{identify}",
    *      operationId="getPatientList",
    *      tags={"Patients"},
    *      summary="Get patients",
    *      description="Returns list of patientes",
    *       @OA\Parameter(
    *         description="Parameter with multiple examples",
    *         in="path",
    *         name="user",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *     ),
    *       @OA\Parameter(
    *         description="Parameter with multiple examples",
    *         in="path",
    *         name="identify",
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
    public function show($user, $identify)
    {
        $user = $this->patientService->getPatientByUser($user, $identify);

        return new PatientResource($user);
    }

    /**
    * @OA\Put(
    *      path="/users/{user}/patients/{identify}",
    *      operationId="updatePatient",
    *      tags={"Patients"},
    *      summary="Update existing patient",
    *      description="Returns updated patient data",
    *      @OA\Parameter(
    *          description="Parameter with multiple examples",
    *          in="path",
    *          name="user uuid",
    *          required=true,
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\Parameter(
    *          description="Parameter with multiple examples",
    *          in="path",
    *          name="identify",
    *          required=true,
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *              @OA\Property(property="user", type="string"),
    *              @OA\Property(property="name", type="string"),
    *              @OA\Property(property="phone", type="string"),
    *              @OA\Property(property="email", type="string"),
    *              @OA\Property(property="dob", type="date"),
    *              @OA\Property(property="gender", type="string"),
    *              @OA\Property(property="height", type="number"),
    *              @OA\Property(property="weight", type="number")
    *          )
    *      ),
    *      @OA\Response(
    *          response=202,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *              @OA\Property(property="identify", type="string"),
    *              @OA\Property(property="name", type="string"),
    *              @OA\Property(property="email", type="string"),
    *              @OA\Property(property="password", type="string")
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
    public function update(StoreUpdatePatient $request, $user, $identify)
    {
        $this->patientService->updatePatient($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
    * @OA\Delete(
    *      path="/users/{uuid}/patients/{identify}",
    *      operationId="deletePatient",
    *      tags={"Patients"},
    *      summary="Delete existing patient",
    *      description="Deletes a record and returns no content",
    *       @OA\Parameter(
    *           description="Parameter with mutliple examples",
    *           in="path",
    *           name="uuid",
    *           required=true,
    *           @OA\Schema(type="string"),
    *           @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")
    *       ),
    *       @OA\Parameter(
    *           description="Parameter with multiple examples",
    *           in="path",
    *           name="identify",
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
    public function destroy($user, $identify)
    {
        $this->patientService->deletePatient($identify);

        return response()->json([], 204);
    }
}

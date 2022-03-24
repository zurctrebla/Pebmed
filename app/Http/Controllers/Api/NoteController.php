<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateNote;
use App\Http\Resources\NoteResource;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
    * @OA\Get(
    *      path="/schedules/{scheduling}/notes",
    *      operationId="getNotesList",
    *      tags={"Notes"},
    *      summary="Get list of notes",
    *      description="Returns list of notes",
    *      @OA\Parameter(
    *          name="scheduling",
    *          description="scheduling",
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
    public function index($scheduling)
    {
        $notes = $this->noteService->getNotesByScheduling($scheduling);

        return NoteResource::collection($notes);
    }

    /**
    * @OA\Post(
    *      path="/schedules/{scheduling}/notes/",
    *      operationId="storeNotes",
    *      tags={"Notes"},
    *      summary="Store new notes",
    *      description="Returns notes data",
    *      @OA\Parameter(
    *          name="scheduling",
    *          description="Scheduling",
    *          required=true,
    *          in="path",
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(property="scheduling", type="string"),
    *              @OA\Property(property="note", type="string")
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
    public function store(StoreUpdateNote $request, $scheduling)
    {
        $scheduling = $this->noteService->createNewNote($request->validated());

        return new NoteResource($scheduling);
    }

    /**
    * @OA\Get(
    *      path="/schedules/{scheduling}/notes/{note}",
    *      operationId="getNoteList",
    *      tags={"Notes"},
    *      summary="Get notes",
    *      description="Returns list of notes",
    *       @OA\Parameter(
    *         description="Parameter with multiple examples",
    *         in="path",
    *         name="scheduling",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *     ),
    *       @OA\Parameter(
    *         description="Parameter with multiple examples",
    *         in="path",
    *         name="note",
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
    public function show($scheduling, $identify)
    {
        $scheduling = $this->noteService->getNoteByscheduling($scheduling, $identify);

        return new NoteResource($scheduling);
    }

    /**
    * @OA\Put(
    *      path="/schedules/{scheduling}/notes/{note}",
    *      operationId="updateNote",
    *      tags={"Notes"},
    *      summary="Update existing note",
    *      description="Returns updated note data",
    *      @OA\Parameter(
    *          description="Parameter with multiple examples",
    *          in="path",
    *          name="scheduling",
    *          required=true,
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\Parameter(
    *          description="Parameter with multiple examples",
    *          in="path",
    *          name="note",
    *          required=true,
    *          @OA\Schema(type="string"),
    *          @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *      ),
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *              @OA\Property(property="scheduling", type="string"),
    *              @OA\Property(property="note", type="string")
    *          )
    *      ),
    *      @OA\Response(
    *          response=202,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *              @OA\Property(property="identify", type="string"),
    *              @OA\Property(property="scheduling", type="string"),
    *              @OA\Property(property="obs", type="string")
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
    public function update(StoreUpdateNote $request, $scheduling,  $identify)
    {
        $this->noteService->updateNote($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
    * @OA\Delete(
    *      path="/schedules/{scheduling}/notes/{note}",
    *      operationId="deleteNote",
    *      tags={"Notes"},
    *      summary="Delete existing note",
    *      description="Deletes a record and returns no content",
    *       @OA\Parameter(
    *           description="Parameter with mutliple examples",
    *           in="path",
    *           name="scheduling",
    *           required=true,
    *           @OA\Schema(type="string"),
    *           @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")
    *       ),
    *       @OA\Parameter(
    *           description="Parameter with multiple examples",
    *           in="path",
    *           name="note",
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
    public function destroy($scheduling, $identify)
    {
        $this->noteService->deleteNote($identify);

        return response()->json([], 204);
    }
}

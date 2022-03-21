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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($scheduling)
    {
        $notes = $this->noteService->getNotesByScheduling($scheduling);

        return NoteResource::collection($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateNote $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateNote $request, $scheduling)
    {
        $scheduling = $this->noteService->createNewNote($request->validated());

        return new NoteResource($scheduling);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($scheduling, $identify)
    {
        $scheduling = $this->noteService->getNoteByscheduling($scheduling, $identify);

        return new NoteResource($scheduling);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateNote $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateNote $request, $scheduling,  $identify)
    {
        $this->noteService->updateNote($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($scheduling, $identify)
    {
        $this->noteService->deleteNote($identify);

        return response()->json([], 204);
    }
}

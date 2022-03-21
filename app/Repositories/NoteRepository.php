<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Support\Facades\Cache;

class NoteRepository
{
    protected $entity;

    public function __construct(Note $note)
    {
        $this->entity = $note;
    }

    public function getNotesScheduling(int $schedulingId)
    {
        return $this->entity
                        ->where('scheduling_id', $schedulingId)
                        ->get();
    }

    public function createNewNote(int $schedulingId, array $data)
    {
        $data['scheduling_id'] = $schedulingId;

        return $this->entity->create($data);
    }

    public function getNoteByScheduling(int $schedulingId, string $identify)
    {
        return $this->entity
                    ->where('scheduling_id', $schedulingId)
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function getNoteByUuid(string $identify)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function updateNoteByUuid(int $schedulingId, string $identify, array $data)
    {
        $note = $this->getNoteByUuid($identify);

        $data['scheduling_id'] = $schedulingId;

        return $note->update($data);
    }

    public function deleteNoteByUuid(string $identify)
    {
        $note = $this->getNoteByUuid($identify);

        return $note->delete();
    }
}

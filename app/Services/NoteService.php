<?php

namespace App\Services;

use App\Repositories\{
    NoteRepository,
    SchedulingRepository
};

class NoteService
{
    protected $schedulingRepository, $patientRepository;

    public function __construct(
        NoteRepository $noteRepository,
        SchedulingRepository $schedulingRepository
    ) {
        $this->noteRepository = $noteRepository;
        $this->schedulingRepository = $schedulingRepository;
    }

    public function getNotesByScheduling(string $scheduling)
    {
        $scheduling = $this->schedulingRepository->getSchedulingByUuid($scheduling);

        return $this->noteRepository->getNotesScheduling($scheduling->id);
    }

    public function createNewNote(array $data)
    {
        $scheduling = $this->schedulingRepository->getSchedulingByUuid($data['scheduling']);

        return $this->noteRepository->createNewNote($scheduling->id, $data);
    }

    public function getNoteByScheduling(string $scheduling, string $identify)
    {
        $scheduling = $this->schedulingRepository->getSchedulingByUuid($scheduling);

        return $this->noteRepository->getNoteByScheduling($scheduling->id, $identify);
    }

    public function updateNote(string $identify, array $data)
    {
        $scheduling = $this->schedulingRepository->getSchedulingByUuid($data['scheduling']);

        return $this->noteRepository->updateNoteByUuid($scheduling->id, $identify, $data);
    }

    public function deleteNote(string $identify)
    {
        return $this->noteRepository->deleteNoteByUuid($identify);
    }
}

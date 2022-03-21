<?php

namespace App\Repositories;

use App\Models\Patient;
use Illuminate\Support\Facades\Cache;

class PatientRepository
{
    protected $entity;

    public function __construct(Patient $patient)
    {
        $this->entity = $patient;
    }

    public function getPatientUser(int $userId)
    {
        return $this->entity
                        ->where('user_id', $userId)
                        ->get();
    }

    public function createNewPatient(int $userId, array $data)
    {
        $data['user_id'] = $userId;

        return $this->entity->create($data);
    }

    public function getPatientByUser(int $userId, string $identify)
    {
        return $this->entity
                    ->where('user_id', $userId)
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function getPatientByUuid(string $identify)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function updatePatientByUuid(int $userId, string $identify, array $data)
    {
        $patient = $this->getPatientByUuid($identify);

        $data['user_id'] = $userId;

        return $patient->update($data);
    }

    public function deletePatientByUuid(string $identify)
    {
        $patient = $this->getPatientByUuid($identify);

        return $patient->delete();
    }
}

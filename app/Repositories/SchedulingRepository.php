<?php

namespace App\Repositories;

use App\Models\Scheduling;
use Illuminate\Support\Facades\Cache;

class SchedulingRepository
{
    protected $entity;

    public function __construct(Scheduling $scheduling)
    {
        $this->entity = $scheduling;
    }

    public function getSchedulesPatient(int $patientId)
    {
        return $this->entity
                        ->where('patient_id', $patientId)
                        ->get();
    }

    public function createNewScheduling(int $patientId, array $data)
    {
        $data['patient_id'] = $patientId;

        return $this->entity->create($data);
    }

    public function getSchedulingByPatient(int $patientId, string $identify)
    {
        return $this->entity
                    ->where('patient_id', $patientId)
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function getSchedulingByUuid(string $identify)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function updateSchedulingByUuid(int $patientId, string $identify, array $data)
    {
        $scheduling = $this->getSchedulingByUuid($identify);

        $data['patient_id'] = $patientId;

        return $scheduling->update($data);
    }

    public function deleteSchedulingByUuid(string $identify)
    {
        $scheduling = $this->getSchedulingByUuid($identify);

        return $scheduling->delete();
    }
}

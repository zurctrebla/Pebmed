<?php

namespace App\Services;

use App\Repositories\{
    SchedulingRepository,
    PatientRepository
};

class SchedulingService
{
    protected $schedulingRepository, $patientRepository;

    public function __construct(
        SchedulingRepository $schedulingRepository,
        PatientRepository $patientRepository
    ) {
        $this->schedulingRepository = $schedulingRepository;
        $this->patientRepository = $patientRepository;
    }

    public function getSchedulesByPatient(string $patient)
    {
        $patient = $this->patientRepository->getPatientByUuid($patient);

        return $this->schedulingRepository->getSchedulesPatient($patient->id);
    }

    public function createNewScheduling(array $data)
    {
        $patient = $this->patientRepository->getPatientByUuid($data['patient']);

        return $this->schedulingRepository->createNewScheduling($patient->id, $data);
    }

    public function getSchedulingByPatient(string $patient, string $identify)
    {
        $patient = $this->patientRepository->getPatientByUuid($patient);

        return $this->schedulingRepository->getSchedulingByPatient($patient->id, $identify);
    }

    public function updateScheduling(string $identify, array $data)
    {
        $patient = $this->patientRepository->getPatientByUuid($data['patient']);

        return $this->schedulingRepository->updateSchedulingByUuid($patient->id, $identify, $data);
    }

    public function deleteScheduling(string $identify)
    {
        return $this->schedulingRepository->deleteSchedulingByUuid($identify);
    }
}

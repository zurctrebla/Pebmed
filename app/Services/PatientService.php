<?php

namespace App\Services;

use App\Repositories\{
    UserRepository,
    PatientRepository
};

class PatientService
{
    protected $PatientRepository, $userRepository;

    public function __construct(
        PatientRepository $patientRepository,
        UserRepository $userRepository
    ) {
        $this->patientRepository = $patientRepository;
        $this->userRepository = $userRepository;
    }

    public function getPatientsByUser(string $user)
    {
        $user = $this->userRepository->getUserByUuid($user);

        return $this->patientRepository->getPatientUser($user->id);
    }

    public function createNewPatient(array $data)
    {
        $user = $this->userRepository->getUserByUuid($data['user']);

        return $this->patientRepository->createNewPatient($user->id, $data);
    }

    public function getPatientByUser(string $user, string $identify)
    {
        $user = $this->userRepository->getUserByUuid($user);

        return $this->patientRepository->getPatientByUser($user->id, $identify);
    }

    public function updatePatient(string $identify, array $data)
    {
        $user = $this->userRepository->getUserByUuid($data['user']);

        return $this->patientRepository->updatePatientByUuid($user->id, $identify, $data);
    }

    public function deletePatient(string $identify)
    {
        return $this->patientRepository->deletePatientByUuid($identify);
    }
}

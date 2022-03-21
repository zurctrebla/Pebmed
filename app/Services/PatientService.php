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

    // public function getModuleByCourse(string $course, string $identify)
    // {
    //     $course = $this->userRepository->getCourseByUuid($course);

    //     return $this->patientRepository->getModuleByCourse($course->id, $identify);
    // }

    // public function updateModule(string $identify, array $data)
    // {
    //     $course = $this->userRepository->getCourseByUuid($data['course']);

    //     return $this->patientRepository->updateModuleByUuid($course->id, $identify, $data);
    // }

    // public function deleteModule(string $identify)
    // {
    //     return $this->patientRepository->deleteModuleByUuid($identify);
    // }
}

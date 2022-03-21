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

    // public function createNewModule(int $userId, array $data)
    // {
    //     $data['course_id'] = $userId;

    //     return $this->entity->create($data);
    // }

    // public function getModuleByCourse(int $userId, string $identify)
    // {
    //     return $this->entity
    //                 ->where('course_id', $userId)
    //                 ->where('uuid', $identify)
    //                 ->firstOrfail();
    // }

    // public function getModuleByUuid(string $identify)
    // {
    //     return $this->entity
    //                 ->where('uuid', $identify)
    //                 ->firstOrfail();
    // }

    // public function updateModuleByUuid(int $userId, string $identify, array $data)
    // {
    //     $module = $this->getModuleByUuid($identify);

    //     Cache::forget('courses');

    //     $data['course_id'] = $userId;


    //     return $module->update($data);
    // }

    // public function deleteModuleByUuid(string $identify)
    // {
    //     $module = $this->getModuleByUuid($identify);

    //     Cache::forget('courses');

    //     return $module->delete();
    // }
}

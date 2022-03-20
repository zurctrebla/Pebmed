<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    public function getUsers()
    {
        return $this->repository->getAllUsers();
    }

    public function createNewUser(array $data)
    {
        return $this->repository->createNewUser($data);
    }

    public function getUser(string $identify)
    {
        return $this->repository->getUserByUuid($identify);
    }

    public function deleteUser(string $identify)
    {
        return $this->repository->deleteUserByUuid($identify);
    }

    public function updateUser(string $identify, array $data)
    {
        return $this->repository->updateUserByUuid($identify, $data);
    }
}

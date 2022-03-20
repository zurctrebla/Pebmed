<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAllUsers()
    {
        return $this->entity->get();
    }

    public function createNewUser(array $data)
    {
        return $this->entity->create($data);
    }

    public function getUserByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }

    public function deleteUserByUuid(string $identify)
    {
        $user = $this->getUserByUuid($identify, false);

        return $user->delete();
    }

    public function updateUserByUuid(string $identify, array $data)
    {
        $user = $this->getUserByUuid($identify, false);

        return $user->update($data);
    }
}

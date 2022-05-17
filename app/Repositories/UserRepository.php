<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAll($id, $number = 6)
    {
        return $this->entity->where('id', '!=', $id)->paginate($number);
    }

    public function getUser($id)
    {
        return $this->entity->findOrFail($id);
    }

    public function createNew($data)
    {
        return $this->entity->create($data);
    }

    public function delete($id)
    {
        $user = $this->getUser($id);

        return $user->delete();
    }
}



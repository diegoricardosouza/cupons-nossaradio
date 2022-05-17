<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAllUsers($id, $number = 6)
    {
        return $this->entity->where('id', '!=', $id)->paginate($number);
    }
}



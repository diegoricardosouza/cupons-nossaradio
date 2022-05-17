<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
    protected $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getAllUsers()
    {
        $idUserLogged = auth()->user()->id;

        return $this->repository->getAll($idUserLogged);
    }

    public function createNewUser($request) {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        return $this->repository->createNew($data);
    }
}

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

    public function getUser($id)
    {
        return $this->repository->getUser($id);
    }

    public function createNewUser($request) {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        return $this->repository->createNew($data);
    }

    public function updateUser($id, $request)
    {
        $data = $request->all();
        $user = $this->repository->getUser($id);

        if(!empty($data['password']))
        {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $user->password;
        }

        return $this->repository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->repository->delete($id);
    }
}

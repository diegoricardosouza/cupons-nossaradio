<?php

namespace App\Services;

use App\Repositories\ListMailRepository;

class ListMailService {
    protected $repository;

    public function __construct(ListMailRepository $listMailRepository)
    {
        $this->repository = $listMailRepository;
    }

    public function getAllMails()
    {
        return $this->repository->getAll(10);
    }

    public function getMail($id)
    {
        return $this->repository->getMail($id);
    }

    public function createNewMail($request) {
        $data = $request->all();

        return $this->repository->createNew($data);
    }

    public function updateMail($id, $request)
    {
        $data = $request->all();

        return $this->repository->update($id, $data);
    }

    public function deleteMail($id)
    {
        return $this->repository->delete($id);
    }

    public function getAllMailsTotal()
    {
        return $this->repository->getAllMails();
    }
}

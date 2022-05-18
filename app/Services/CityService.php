<?php

namespace App\Services;

use App\Repositories\CityRepository;

class CityService {
    protected $repository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->repository = $cityRepository;
    }

    public function getAllCities()
    {
        return $this->repository->getAll();
    }

    public function getCity($id)
    {
        return $this->repository->getCity($id);
    }

    public function createNewCity($request) {
        $data = $request->all();

        return $this->repository->createNew($data);
    }

    public function updateCity($id, $request)
    {
        $data = $request->all();

        return $this->repository->update($id, $data);
    }

    public function deleteCity($id)
    {
        return $this->repository->delete($id);
    }
}

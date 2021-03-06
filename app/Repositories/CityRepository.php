<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository {
    protected $entity;

    public function __construct(City $city)
    {
        $this->entity = $city;
    }

    public function getAll($number = 6)
    {
        return $this->entity->paginate($number);
    }

    public function getTotal()
    {
        return $this->entity->all();
    }

    public function getCity($id)
    {
        return $this->entity->find($id);
    }

    public function getCityBySlug($slug)
    {
        return $this->entity->where('slug', $slug)->first();
    }

    public function createNew($data)
    {
        return $this->entity->create($data);
    }

    public function update($id, $data)
    {
        $city = $this->getCity($id);

        return $city->update($data);
    }

    public function delete($id)
    {
        $city = $this->getCity($id);

        return $city->delete();
    }

    public function getAllByCity($slug, $number = 6)
    {
        $city = $this->getCityBySlug($slug);

        if(!$city) {
            return null;
        } else {
            return $city->coupons()
                        ->orderBy('name', 'asc')
                        ->paginate($number);
        }
    }
}



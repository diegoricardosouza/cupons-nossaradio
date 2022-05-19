<?php

namespace App\Repositories;

use App\Models\Coupon;

class HomeRepository
{
    protected $entity;

    public function __construct(Coupon $coupon)
    {
        $this->entity = $coupon;
    }

    public function getAll($number = 6)
    {
        return $this->entity->paginate($number);
    }

    public function getCoupon($id)
    {
        return $this->entity->with('cities')->find($id);
    }

    public function createNew($data)
    {
        $coupon = $this->entity->create($data);
        $coupon->cities()->attach($data['city']);

        return $coupon;
    }

    public function update($id, $data)
    {
        $coupon = $this->getCoupon($id);
        $coupon->cities()->sync($data['city']);

        return $coupon->update($data);
    }

    public function delete($id)
    {
        $coupon = $this->getCoupon($id);

        return $coupon->delete();
    }
}

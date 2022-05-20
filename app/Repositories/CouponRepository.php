<?php

namespace App\Repositories;

use App\Models\Coupon;

class CouponRepository {
    protected $entity;

    public function __construct(Coupon $coupon)
    {
        $this->entity = $coupon;
    }

    public function getAll($search = null, $number = 6)
    {
        $coupons = $this->entity->where(function ($query) use ($search) {
            if($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            }
        })->paginate($number);

        return $coupons;
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

    public function updateDownload($id)
    {
        $coupon = $this->getCoupon($id);

        return $coupon->update(['downloads' => $coupon->downloads + 1]);
    }
}



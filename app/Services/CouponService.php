<?php

namespace App\Services;

use App\Repositories\CityRepository;
use App\Repositories\CouponRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CouponService {
    protected $repository;
    protected $repositoryCity;

    public function __construct(CouponRepository $couponRepository, CityRepository $repositoryCity)
    {
        $this->repository = $couponRepository;
        $this->repositoryCity = $repositoryCity;
    }

    public function getAllCoupons($search)
    {
        return $this->repository->getAll($search);
    }

    public function getAllCities()
    {
        return $this->repositoryCity->getTotal();
    }

    public function getCoupon($id)
    {
        return $this->repository->getCoupon($id);
    }

    public function createNewCoupon($request) {
        $data = $request->all();
        $data['validity'] = Carbon::parse($request->validity)->format('Y-m-d');

        if ($request->image) {
            $data['image'] = $request->image->store('coupons');
        }

        return $this->repository->createNew($data);
    }

    public function updateCoupon($id, $request)
    {
        $data = $request->all();
        $coupon = $this->repository->getCoupon($id);
        $data['validity'] = Carbon::parse($request->validity)->format('Y-m-d');

        if ($request->image) {
            if ($coupon->image && Storage::exists($coupon->image)) {
                Storage::delete($coupon->image);
            }

            $data['image'] = $request->image->store('coupons');
        }

        return $this->repository->update($id, $data);
    }

    public function deleteCoupon($id)
    {
        $coupon = $this->repository->getCoupon($id);

        if ($coupon->image && Storage::exists($coupon->image)) {
            Storage::delete($coupon->image);
        }

        return $this->repository->delete($id);
    }
}

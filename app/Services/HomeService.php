<?php

namespace App\Services;

use App\Repositories\CityRepository;
use App\Repositories\CouponRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class HomeService {
    protected $repository;
    protected $repositoryCity;

    public function __construct(CouponRepository $couponRepository, CityRepository $repositoryCity)
    {
        $this->repository = $couponRepository;
        $this->repositoryCity = $repositoryCity;
    }

    public function getAllCoupons()
    {
        return $this->repository->getAll(6);
    }

    public function getAllCouponsByCity($city)
    {
        return $this->repositoryCity->getAllByCity($city, 6);
    }

    public function getCityBySlug($slug)
    {
        return $this->repositoryCity->getCityBySlug($slug);
    }

    public function ajaxUpdateDownload()
    {
        return null;
    }
}

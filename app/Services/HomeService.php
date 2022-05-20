<?php

namespace App\Services;

use App\Repositories\CityRepository;
use App\Repositories\CouponRepository;
use App\Repositories\ListMailRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class HomeService {
    protected $repository;
    protected $repositoryCity;
    protected $repositoryEmail;

    public function __construct(CouponRepository $couponRepository, CityRepository $repositoryCity, ListMailRepository $repositoryEmail)
    {
        $this->repository = $couponRepository;
        $this->repositoryCity = $repositoryCity;
        $this->repositoryEmail = $repositoryEmail;
    }

    public function getAllCoupons()
    {
        return $this->repository->getAll(15);
    }

    public function getAllCouponsByCity($city)
    {
        return $this->repositoryCity->getAllByCity($city, 15);
    }

    public function getCityBySlug($slug)
    {
        return $this->repositoryCity->getCityBySlug($slug);
    }

    public function getEmail($email)
    {
        return $this->repositoryEmail->getMailByName($email);
    }

    public function ajaxUpdateDownload($id)
    {
        return $this->repository->updateDownload($id);
    }

    public function ajaxStoreEmail($email)
    {
        if($this->getEmail($email)) {
            return true;
        } else {
            $this->repositoryEmail->createNew([
                'email' => $email
            ]);
            return true;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->homeService->getAllCoupons();

        return view('front.home', compact('coupons'));
    }

    public function city($slug)
    {
        $coupons = $this->homeService->getAllCouponsByCity($slug);
        $city = $this->homeService->getCityBySlug($slug);

        return view('front.city', compact('coupons', 'city'));
    }

    public function ajaxDownload(Request $request)
    {
        return $this->homeService->ajaxUpdateDownload($request->id);
    }
}

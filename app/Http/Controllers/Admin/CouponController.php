<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCouponFormRequest;
use App\Services\CouponService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $coupons = $this->couponService->getAllCoupons($request->search ?? '');

        return view('admin.coupons.index', compact('coupons', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->couponService->getAllCities();

        return view('admin.coupons.create', compact('cities'));
    }

    public function store(StoreUpdateCouponFormRequest $request)
    {
        // $newDate = Carbon::parse($request->validity)->format('Y-m-d');
        // dd($newDate);

        $couponCreated = $this->couponService->createNewCoupon($request);

        if ($couponCreated)
            return redirect()->route('coupons.index')->with('user_success', 'Cupom criado com sucesso!');
    }

    public function edit($id)
    {
        if (!$coupon = $this->couponService->getCoupon($id))
            return redirect()->route('coupons.index');

        $cities = $this->couponService->getAllCities();

        return view('admin.coupons.edit', compact('coupon', 'cities'));
    }

    public function update(StoreUpdateCouponFormRequest $request, $id)
    {
        if (!$this->couponService->getCoupon($id))
            return redirect()->route('coupons.index');

        $couponUpdated = $this->couponService->updateCoupon($id, $request);

        if ($couponUpdated)
            return redirect()->route('coupons.index')->with('user_success', 'Cupom Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$this->couponService->getCoupon($id))
            return redirect()->route('coupons.index');

        $this->couponService->deleteCoupon($id);

        return redirect()->route('coupons.index')->with('user_success', 'Cupom Deletado com sucesso!');
    }
}

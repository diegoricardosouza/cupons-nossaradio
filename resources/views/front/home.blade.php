@extends('layouts.home')

@section('title', 'Cupons')

@section('content')

<div class="container">
        <div class="row">
            @foreach($coupons as $coupon)
            <div class="col w-20 text-center coupons__block">
                <a href="{{ url("storage/{$coupon->image}") }}" download>
                    <img src="{{ url("storage/{$coupon->image}") }}" alt="{{ $coupon->name }}" title="{{ $coupon->name }}" class="img-fluid">
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.home')

@if($coupons)
    @section('title', "Cupons {$city->name}" )
@else
    @section('title', 'Cupons')
@endif


@section('content')

<div class="container">
        @if($coupons)
        <div class="row">
            <div class="col-lg-12 coupons__title">
                <header>
                    <h2>cupons <span>{{ $city->name }}</span></h2>
                </header>
            </div>
        </div>

        <div class="row">
            @foreach($coupons as $coupon)
            <div class="col w-20 text-center coupons__block">
                <a href="{{ url("storage/{$coupon->image}") }}" download onclick="onClick({{ $coupon->id }})">
                    <img src="{{ url("storage/{$coupon->image}") }}" alt="{{ $coupon->name }}" title="{{ $coupon->name }}" class="img-fluid">
                </a>
            </div>
            @endforeach
        </div>

        @if($coupons->total() > '15')
            <div class="row">
                <div class="col-lg-12 coupons__pagination">
                    @if(isset($dataForm))
                        {!! $coupons->appends($dataForm)->links() !!}
                    @else
                        {!! $coupons->links() !!}
                    @endif
                </div>
            </div>
        @endif

        @else
        <div class="row">
            <div class="col-lg-12 coupons__title text-center">
                <header>
                    <h2>Não há cupons para esta cidade</h2>
                </header>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function onClick(id) {
        fetch(
            '/city-ajax', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'POST',
                credentials: "same-origin",
                body: JSON.stringify({
                    id,
                })
            }
        )
    }
</script>
@endsection

@extends('layouts.home')

@section('title', 'Cupons')

@section('content')

<div class="coupons-modal__bg">
    <div class="container">
        <div class="coupons-modal__content">
            <div class="coupons-modal__form">
                <img src="{{ url('images/logo.png') }}" alt="" class="img-form">

                <div>
                    <form action="" method="post" class="formmodal">
                        @csrf
                        <input type="email" name="email" placeholder="e-mail">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 103.44" style="enable-background:new 0 0 122.88 103.44" xml:space="preserve"><path d="M69.49 102.77 49.8 84.04l-20.23 18.27c-.45.49-1.09.79-1.8.79-1.35 0-2.44-1.09-2.44-2.44V60.77L.76 37.41a2.445 2.445 0 0 1-.09-3.45c.31-.33.7-.55 1.11-.67l118-33.2a2.444 2.444 0 0 1 2.77 3.58l-49.2 98.42c-.6 1.2-2.06 1.69-3.26 1.09-.23-.11-.43-.25-.6-.41zM46.26 80.68 30.21 65.42v29.76l16.05-14.5zM28.15 56.73l76.32-47.26L7.22 36.83l20.93 19.9zm86.28-47.7L31.79 60.19l38.67 36.78 43.97-87.94z"/></svg>
                        </button>
                    </form>

                    <span class="info">CADASTRE SEU EMAIL E ESCOLHA SEUS CUPONS</span>
                </div>
            </div>
        </div>

        @if($coupons)
        <div class="row">
            @foreach($coupons as $coupon)
            <div class="col w-20 text-center coupons__block">
                <a href="#" data-toggle="modal" data-target="#exampleModalCenter{{ $coupon->id }}">
                    <img src="{{ url("storage/{$coupon->image}") }}" alt="{{ $coupon->name }}" title="{{ $coupon->name }}" class="img-fluid">
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter{{ $coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{ $coupon->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $coupon->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <a href="{{ url("storage/{$coupon->image}") }}" download onclick="onClick({{ $coupon->id }})">
                                    <img src="{{ url("storage/{$coupon->image}") }}" alt="{{ $coupon->name }}" title="{{ $coupon->name }}" class="img-fluid">
                                </a>
                            </div>

                            <div style="margin-top: 20px;" class="text-center">
                                <p>Para acessar o desconto do cupom basta clicar em cima da imagem e imprimir ou salvar a imagem no seu celular e apresentar no estabelecimento no ato da compra.<br><br>

                                Para pedidos por telefone informe sobre o cupom antes do fechamento da compra. Cupom ainda n??o aceito para compras on-line.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <h2>N??o h?? cupons para esta cidade</h2>
                </header>
            </div>
        </div>
        @endif
    </div>
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

    function submitForm() {
        const formModal = document.querySelector('.formmodal');
        const modalContainer = document.querySelector('.coupons-modal__content');

        formModal.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = new FormData(this);
            const email = form.get('email');

            if (email === '') {
                alert('Preencha o campo e-mail');
                return;
            } else {
                fetch(
                    '/storemail', {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'POST',
                        credentials: "same-origin",
                        body: JSON.stringify({
                            email,
                        })
                    }
                )
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        alert('Email adicionado com sucesso');
                        // window.location.reload();
                        localStorage.setItem('email', email);
                        modalContainer.style.display = 'none';
                    } else {
                        alert('Erro ao adicionar o email');
                    }
                })
                .catch(error => {
                    alert('Erro ao adicionar o email');
                });
            }
        });
    }

    function verifyEmail() {
        const email = localStorage.getItem('email');
        const modalContainer = document.querySelector('.coupons-modal__content');

        if (email) {
            modalContainer.style.display = 'none';
        }
    }

    submitForm();
    verifyEmail();
</script>
@endsection

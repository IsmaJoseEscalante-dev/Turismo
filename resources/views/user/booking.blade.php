@extends('layouts.app')

@section('css')
<style>
.btn-pagar {
    background-color: #01BCFF;
    color: white;
}

.btn-pagar:hover {
    color: #F8FAFC
}
.img-card{
    width: 100px;
    height: 60px;
    margin-right: 30px;
    filter: drop-shadow(5px 5px 5px #CCCED0);
    margin-bottom: 2rem;
}
@media (max-width: 768px) {
    .img-card{
        width: 70px;
        height: 50px;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection

@section('content')-
<div class="container-fluid my-3">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4>Detalles de la reserva</h4>
            <div><p class="mb-0"><b>Propietario: </b>{{ Auth::user()->name }}</p></div>
            <div><p class="mb-1"><b>Email: </b>{{ Auth::user()->email }}</p></div>
            <div><p class="mb-1"><b>Fecha de salida: </b>{{ $cart->date }}</p></div>
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-responsive-sm">
                        <tr>
                            <th>Item</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th style="width:80px">Total</th>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-uppercase mb-0">{{ $cart->cartable->name }}</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item font-weight-bold">PASAJEROS</li>
                                    @foreach ($cart->passengers as $passenger)
                                    <li class="list-group-item">{{ $passenger->name . ' ' . $passenger->lastName }}</li >
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $cart->cartable->amount }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->cartable->amount * $cart->quantity }} $</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3 shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('pay') }}" method="POST" id="paymentForm">
                @csrf
                @foreach ($paymentPlatforms as $paymentPlatform)
                <div class="d-flex align-items-center">
                    <img class="img-card" src="{{ asset('pagos/mastercard.jpeg') }}" alt="mastercard">
                    <img class="img-card" src="{{ asset('pagos/americanexpress.jpeg') }}" alt="americanExpress">
                    <img class="img-card" src="{{ asset('pagos/vista.jpeg') }}" alt="visa">
                </div>

                <label class="mt-3"><b>Datos del Propietario de la Tarjeta:</b></label>
                <div class="form-group form-row">
                    <div class="col-6">
                        <input class="form-control" type="text" data-checkout="cardholderName"
                        placeholder="Your Name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="email" data-checkout="cardholderEmail"
                        placeholder="email@example.com" name="email" value="{{ Auth::user()->email }}">
                    </div>
                </div>

                <div class="form-group form-row">
                    <div class="col-6 col-md-4">
                        <label><b>Número de Tarjeta:</b></label>
                        <input class="form-control" type="text" id="cardNumber" data-checkout="cardNumber"
                        placeholder="Numero de la tarjeta">
                    </div>

                    <div class="col-6 col-md-3">
                        <label><b>Código CVC:</b></label>
                        <input class="form-control" type="number"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" data-checkout="securityCode" placeholder="CVC">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-12 col-md-4">
                        <label><b>Fecha de Expiración:</b></label>
                        <span class="d-flex">
                            <input class="form-control" type="number"
                            pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" data-checkout="cardExpirationMonth"
                            placeholder="Mes">
                            <input class="form-control" type="number"
                            pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" data-checkout="cardExpirationYear"
                            placeholder="Año">
                        </span>
                    </div>
                </div>

                <div class="form-group form-row">
                    <div class="col-5 col-md-2">
                        <select class="custom-select" data-checkout="docType"></select>
                    </div>
                    <div class="col-7 col-md-2">
                        <input class="form-control" type="text" data-checkout="docNumber" placeholder="Document">
                    </div>
                </div>

                <div class="form-group form-row">
                    <div class="col">
                        <small class="form-text text-mute" role="alert">La moneda oficial es el {{ strtoupper(config('services.mercadopago.base_currency')) }} <i>(peso Argentino)</i></small>
                    </div>
                </div>

                <div class="form-group form-row">
                    <div class="col">
                        <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
                    </div>
                </div>
                <input type="hidden" name="payment_platform" value="{{ $paymentPlatform->id }}" required>
                <input type="hidden" name="cart_id" value="{{ $cart->id }}" required>
                <input type="hidden" id="cardNetwork" name="card_network">
                <input type="hidden" id="cardToken" name="card_token">
                <div class="text-center mt-3">
                    <button type="submit" id="payButton" class="btn btn-pagar btn-lg">Pagar</button>
                </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<script>
    const mercadoPago = window.Mercadopago;

    mercadoPago.setPublishableKey('{{ config('services.mercadopago.key') }}');

    mercadoPago.getIdentificationTypes();

    function setCardNetwork() {
        const cardNumber = document.getElementById("cardNumber");

        mercadoPago.getPaymentMethod({
            "bin": cardNumber.value.substring(0, 7)
        },
        function(status, response) {
            const cardNetwork = document.getElementById("cardNetwork");

            cardNetwork.value = response[0].id;
            console.log(response);
            mercadoPagoForm.submit();
        }
        );
    }

    const mercadoPagoForm = document.getElementById("paymentForm");

    mercadoPagoForm.addEventListener('submit', function(e) {
        e.preventDefault();

        mercadoPago.createToken(mercadoPagoForm, function(status, response) {
            if (status != 200 && status != 201) {
                const errors = document.getElementById("paymentErrors");

                errors.textContent = response.cause[0].description;
            } else {
                const cardToken = document.getElementById("cardToken");

                cardToken.value = response.id;
                setCardNetwork();
            }
        });
    });
</script>
@endsection

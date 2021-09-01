@extends('layouts.app')

@section('content')-
    <div class="container-fluid my-3">
        <div class="card">
            <div class="card-body">
                <h4>Resumen de la reserva</h4>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered table-responsive-sm">
                            <tr>
                                <th>Propietario</th>
                                <th>Fecha</th>
                                <th>Tour</th>
                                <th>Pasajeros</th>
                            </tr>
                            <tr>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ $cart->date }}</td>
                                <td>{{ $cart->cartable->name }}</td>
                                <td>
                                    <ul>
                                        @foreach ($cart->passengers as $passenger)
                                            <li>{{ $passenger->name . ' ' . $passenger->lastName }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h5 id="countPassenger">Pasajeros : {{ $cart->quantity }}</h5>
                        <h5>Precio : {{ $cart->cartable->amount }}$</h5>
                        <h5>total : {{ $cart->cartable->amount * $cart->quantity }} $</h5>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            Mercado pago
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="cho-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Tarjeta de credito
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        pago con tarjeta
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pay') }}" method="POST" id="paymentForm">
                    @csrf
                    @foreach($paymentPlatforms as $paymentPlatform)
                        <img src="{{ asset('img/mercadopago.jpg') }}" alt="" class="d-block">
                        <label class="mt-3">Card details:</label>

                        <div class="form-group form-row">
                            <div class="col-5">
                                <input class="form-control" type="text" id="cardNumber" data-checkout="cardNumber"
                                       placeholder="Card Number">
                            </div>

                            <div class="col-2">
                                <input class="form-control" type="text" data-checkout="securityCode" placeholder="CVC">
                            </div>

                            <div class="col-1"></div>

                            <div class="col-1">
                                <input class="form-control" type="text" data-checkout="cardExpirationMonth"
                                       placeholder="MM">
                            </div>

                            <div class="col-1">
                                <input class="form-control" type="text" data-checkout="cardExpirationYear"
                                       placeholder="YY">
                            </div>
                        </div>



                        <div class="form-group form-row">
                            <div class="col-5">
                                <input class="form-control" type="text" data-checkout="cardholderName"
                                       placeholder="Your Name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-5">
                                <input class="form-control" type="email" data-checkout="cardholderEmail"
                                       placeholder="email@example.com" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>


                        <div class="form-group form-row">
                            <div class="col-2">
                                <select class="custom-select" data-checkout="docType"></select>
                            </div>
                            <div class="col-3">
                                <input class="form-control" type="text" data-checkout="docNumber"
                                       placeholder="Document">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col">
                                <small class="form-text text-mute" role="alert">Your payment will be converted
                                    to {{ strtoupper(config('services.mercadopago.base_currency')) }}</small>
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
                            <button type="submit" id="payButton" class="btn btn-primary btn-lg">Pay</button>
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

            mercadoPago.getPaymentMethod(
                {"bin": cardNumber.value.substring(0, 7)},
                function (status, response) {
                    const cardNetwork = document.getElementById("cardNetwork");

                    cardNetwork.value = response[0].id;
                    console.log(response);
                    mercadoPagoForm.submit();
                }
            );
        }

        const mercadoPagoForm = document.getElementById("paymentForm");

        mercadoPagoForm.addEventListener('submit', function (e) {
            e.preventDefault();

            mercadoPago.createToken(mercadoPagoForm, function (status, response) {
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

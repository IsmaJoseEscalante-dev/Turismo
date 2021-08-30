@extends('layouts.app')

@section('content')
    @php
        require base_path('vendor/autoload.php');
        MercadoPago\SDK::setAccessToken(config('services.mercado_pago.token'));

        $preference = new MercadoPago\Preference();
        $item = new MercadoPago\Item();
        $item->title = $cart->cartable->name;
        $item->quantity = $cart->quantity;
        $item->unit_price = $cart->cartable->amount;
        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => route('home'),
            "failure" => route('home'),
            "pending" => route('home')
        );
        $preference->auto_return = "approved";
        $preference->save();

    @endphp
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
                                        @foreach($cart->passengers as $passenger)
                                            <li>{{ $passenger->name." ". $passenger->lastName}}</li>
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
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
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
    </div>
@endsection

@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        // Agrega credenciales de SDK
        const mp = new MercadoPago("{{ config('services.mercado_pago.key') }}", {
            locale: 'es-AR'
        });
        // Inicializa el checkout
        mp.checkout({
            preference: {
                id: '{{ $preference->id }}'
            },
            render: {
                container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                label: 'Pagar', // Cambia el texto del botón de pago (opcional)
            }
        });
    </script>
@endsection

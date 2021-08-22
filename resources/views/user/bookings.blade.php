@extends('layouts.app')

@section('content')
    <div class="container-fluid my-3">
        <h3>Reservas por pagar</h3>
        <div class="row">
            @forelse($carts as $cart)
                <div class="card col-md-8 mx-auto my-2">
                    <div class="card-body">
                        <h4>Reserva para {{ $cart->tour->name }}</h4>
                        <p class="lead">Precio: {{ $cart->tour->amount }} $</p>
                        <p class="lead">N° personas: {{ $cart->quantity }}</p>
                        <p class="lead">Total a pagar: {{ $cart->tour->amount * $cart->quantity }} $</p>
                        <div class="d-flex float-right">
                            <a href="{{ route('booking.tour', $cart->tour->id) }}"
                               class="btn btn-primary">Pagar</a>
                            <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>

                </div>
            @empty
                <h4>No hay reservas</h4>
            @endforelse
        </div>
    </div>
@endsection

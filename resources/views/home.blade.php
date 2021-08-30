@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('message')}}
            </div>
        @endif
        <div class="row bg-white py-3 border rounded">
            <div class="col-md-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" id="list-dashboard-list" data-toggle="list"
                       href="#list-dashboard" role="tab" aria-controls="dashboard">
                        <i class="fas fa-tachometer-alt"></i> &nbsp;Dashboard
                    </a>
                    <a class="list-group-item list-group-item-action active" id="list-orders-list" data-toggle="list"
                       href="#list-orders" role="tab" aria-controls="orders">
                        <i class="fa fa-cart-arrow-down"></i> &nbsp;Ordenes
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-detail-list" data-toggle="list"
                       href="#list-detail" role="tab" aria-controls="detail">
                        <i class="fa fa-user"></i> &nbsp;Detalle de cuenta
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-change-list" data-toggle="list"
                       href="#list-change" role="tab" aria-controls="change">
                        <i class="fas fa-edit"></i> &nbsp;Editar Datos</a>
                    <a class="list-group-item list-group-item-action"
                       onclick="event.preventDefault();
                    document.getElementById('logout-form-home').submit();"
                       style="cursor: pointer"
                    >
                        <i class="fas fa-sign-out-alt"></i> &nbsp;Cerrar Sesión
                    </a>
                    <form id="logout-form-home" action="{{ route('logout') }}" method="POST"
                          class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="list-dashboard" role="tabpanel"
                         aria-labelledby="list-dashboard-list">
                        <h3>Dashboard</h3>
                        <hr>
                        <p class="lead">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum ipsum mollitia obcaecati,
                            pariatur perspiciatis placeat qui! Atque eligendi excepturi laborum!
                        </p>
                    </div>
                    <div class="tab-pane fade show active" id="list-orders" role="tabpanel"
                         aria-labelledby="list-orders-list">
                        <h3>Ordenes</h3>
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="10px">Orden</th>
                                <th>Lugar</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->tour->name }}</td>
                                    <td>{{ $booking->date }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>{{ $booking->total }}</td>
                                    <td>
                                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-primary">Ver</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay reservas</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="list-detail" role="tabpanel" aria-labelledby="list-detail-list">
                        <h3>Detalles de cuenta</h3>
                        <hr>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Apellidos</th>
                                <td>{{ Auth::user()->lastName }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Telefono</th>
                                <td>{{ Auth::user()->phone }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="list-change" role="tabpanel" aria-labelledby="list-change-list">
                        <h3>Editar datos</h3>
                        <hr>
                        <form action="{{ route('users.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Nombre *</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('name', Auth::user()->name) }}">
                                    @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Apellidos *</label>
                                    <input type="text" name="lastName" class="form-control"
                                           value="{{ old('lastName', Auth::user()->lastName) }}">
                                    @error('lastName')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Telefono *</label>
                                    <input type="number" name="phone" class="form-control"
                                           value="{{ old('phone', Auth::user()->phone) }}">
                                    @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                        </form>
                        <h4>Cambiar contraseña</h4>
                        <hr>
                        <form action="{{ route('users.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Nueva contraseña</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Repetir contraseña</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        if (localStorage.getItem('date') && localStorage.getItem('inputs')) {
            let date = localStorage.getItem('date');
            let tour = JSON.parse(localStorage.getItem('model'))
            let passengers = JSON.parse(localStorage.getItem('inputs'));
            let total = passengers.length * Number(tour.amount)

            axios.post('/api/booking', {
                names: passengers,
                total: total,
                quantity: passengers.length,
                date: date,
                user_id: "{{ Auth::id() }}",
                tour_id: tour.id,
                unit_price: tour.amount
            })
                .then( () => {
                    localStorage.clear()
                })
                .catch(function (error) {
                    console.log(error.data);
                });
        }
    </script>
@endsection

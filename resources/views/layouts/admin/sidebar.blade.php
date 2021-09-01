<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('carts.show') }}" class="nav-link {{ Request::is('carts') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Carts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bookings.index') }}" class="nav-link {{ Request::is('bookings') ? 'active' :'' }}">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>
                            Reservas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('categories') ? 'active' :'' }}">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            Categorias
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('promotions.index') }}" class="nav-link {{ Request::is('promotions') ? 'active' :'' }}">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>
                            Promociones
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tours.index') }}" class="nav-link {{ Request::is('tours') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-bus-alt"></i>
                        <p>
                            Excursiones
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('stations.index') }}" class="nav-link {{ Request::is('stations') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Paradas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('events.events') }}" class="nav-link  {{ Request::is('events') ? 'active' :'' }}">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>
                            Eventos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('comments.index') }}" class="nav-link {{ Request::is('comments') ? 'active' :'' }}">
                        <i class="nav-icon fa fa-comments"></i>
                        <p>
                            comentarios
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PetsQu Shop</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('css')
</head>
<body>
    {{-- header --}}
    <div class="header bg-light sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light row">
                <div class="col-lg-2 col-sm-6 col-12 order-lg-1">
                    <a class="navbar-brand" href="{{ route('main.index') }}"><i class="fas fa-cat"></i> PetsQu Shop</a>
                </div>
                <div class="col-lg-8 col-sm-12 order-lg-2 order-3">
                    <form class="form-inline my-2 my-lg-0 w-100" action="{{ route('main.search') }}" method="GET">
                        <div class="input-group w-100">
                            <input type="text" name="keyword" class="form-control" placeholder="Coba cari makanan kucing" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-sm-6 col-12 order-lg-2 order-2 d-flex justify-content-end">
                    @if (Auth::check())
                    <a href="{{ route('main.cart', Auth::id()) }}" class="btn btn-light text-success"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">{{ ucwords(Auth::user()->name) }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('main.pembelian') }}">Pembelian</a>
                            <hr>
                            <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                    @endif
                </div>
            </nav>
        </div>
    </div>
    {{-- main content --}}
    @yield('main-content')

    {{-- modals --}}
    @yield('modals')
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('js')
</body>
</html>
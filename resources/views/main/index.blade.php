@extends('layouts.main-store')

@section('main-content')
    {{-- produk display --}}
    <div class="main-content pb-5">
        {{-- jumbotron section --}}
        <div id="carouselExampleIndicators" class="carousel slide pb-3" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('slide_promo/1.webp') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('slide_promo/2.webp') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('slide_promo/3.webp') }}" alt="Third slide">
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
        {{-- product section --}}
        <div class="container">
            <div class="row">
                @forelse ($products as $product)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1" style="height: 350px">
                    <a href="{{ route('main.detail', $product) }}" class="text-dark text-decoration-none">
                        <div class="card w-100 h-100 shadow">
                            <img style="object-fit: cover; height: 60%" class="card-img-top" src="{{ asset('gambar_produk/'.$product->img) }}" alt="{{ $product->name,' image' }}">
                            <div class="card-body p-1" style="height: 30%">
                              <h6 class="card-title">{{ $product->name }}</h6>
                              <span><strong>Rp. {{ number_format($product->price, 0, ".", ".") }}</strong></span>
                            </div>
                            <div class="card-footer py-0 px-2" style="height: 10%">
                                <span class="text-warning">&#9733;</span>
                                <span class="text-warning">&#9733;</span>
                                <span class="text-warning">&#9733;</span>
                                <span class="text-warning">&#9733;</span>
                                <span class="text-warning">&#9734;</span>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Item tidak ditemukan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

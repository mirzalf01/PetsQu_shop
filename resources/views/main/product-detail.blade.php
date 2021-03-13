@extends('layouts.main-store')

@section('main-content')
    {{-- produk display --}}
    <div class="main-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <img class="w-100" src="{{ asset('gambar_produk/'.$product->img) }}" alt="{{ $product->name,' image' }}">
                </div>
                <div class="col-lg-8 col-6">
                    <h2 class="">{{ $product->name }}</h2>
                    <h3>Rp. {{ number_format($product->price, 0, ".", ".") }}</h3>
                    <form action="{{ route('main.store', $product) }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <input type="number" value="1" name="qty" class="form-control border-0 text-center rounded-0" style="border-bottom: 1px solid black !important; width: 75px" id="inputQty" aria-describedby="emailHelp" placeholder="Qty">
                            <small id="emailHelp" class="form-text text-muted">Max. pembelian {{ $product->stock }}</small>
                        </div>
                        <button class="btn btn-sm btn-success" onclick="return cekStock(event);" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> <span class="font-weight-bold">Keranjang</span></button>
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                  <div class="nav nav-tabs" id="product-tab" role="tablist">
                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                    <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                  </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                      {{ $product->detail }}
                  </div>
                  <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">

                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    @if (session('successinsertcart'))
        Swal.fire(
            'Sukses',
            '{{ session('successinsertcart') }}!',
            'success'
        );
    @endif
    function cekStock(ev){
        ev.preventDefault();
        let form = ev.currentTarget.form;
        let inputQty = document.getElementById('inputQty').value;
        if (inputQty > 0 && inputQty <= {{ $product->stock }}) {
            form.submit();
        }
        else if(inputQty <= 0){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Min. pembelian 1!',
            });
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Max. pembelian {{ $product->stock }}!',
            });
        }
    }

</script>
    
@endsection
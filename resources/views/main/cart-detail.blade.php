@extends('layouts.main-store')

@section('css')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
@endsection

@section('main-content')
    {{-- produk display --}}
    <div class="main-content py-5">
        <div class="container">
            {{-- alert error --}}
            <div class="row">
                <div class="col-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                </div>
            </div>
            <!-- data tables -->
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Keranjang Belanja</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Stok Tersedia</th>
                            <th>Total Harga</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($carts as $cart)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td><img style="width: 75px; height: 75px; object-fit: cover" src="{{ asset('gambar_produk/'.$cart->product->img) }}" alt=""></td>
                            <td>{{ $cart->product->name }}</td>
                            <td>Rp. {{ number_format($cart->product->price, 0, ".", ".") }}</td>
                            @if ($cart->qty > $cart->product->stock)
                                <td class="text-danger font-weight-bold">{{ $cart->qty }}</td>
                                <td>{{ $cart->product->stock }}</td>
                            @else
                                <td>{{ $cart->qty }}</td>
                                <td>{{ $cart->product->stock }}</td>    
                            @endif
                            <td>Rp. {{ number_format($cart->total, 0, ".", ".") }}</td>
                            <td>
                                <button type="button" data-id="{{ $cart->id }}" data-name="{{ $cart->product->name }}" data-qty="{{ $cart->qty }}" data-price="{{ $cart->product->price }}" class="btn btn-info btn-sm modBut" data-toggle="modal" data-target="#editproduct">
                                    <span class="fas fa-edit" aria-hidden="true"></span></a>
                                </button>
                                <form class="d-inline" action="{{ route('main.destroy', $cart) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apa anda yakin?')"><span class="far fa-trash-alt" aria-hidden="true"></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">Total</td>
                                <td>Rp. {{ number_format($total, 0, ".", ".") }}</td>
                                <td>
                                    @if ($total != 0)
                                    <form class="d-inline" action="{{ route('transactions.store') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Proses Permintaan</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection

@section('modals')
    {{-- edit produk --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="editproduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" method="post" action="{{ route('main.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="productId">
                <div class="form-group">
                    <label>Nama *</label>
                    <input type="text" id="productName" name="name" class="form-control" required="" disabled>
                </div>
                <div class="form-group">
                    <label>Qty *</label>
                    <input type="number" id="productQty" name="qty" class="form-control" required="" >
                    <div class="invalid-feedback">
                        Harga tidak boleh kosong!
                    </div>
                </div>
                <div class="form-group">
                    <span>* Tidak boleh kosong</span>
                </div>
                <button class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    $('#editproduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var qty = button.data('qty');
        var price = button.data('price');
        $('#productId').val(id);
        $('#productName').val(name);
        $('#productQty').val(qty);
    });
    @if (session('successeditcart'))
        Swal.fire(
            'Sukses',
            '{{ session('successeditcart') }}!',
            'success'
        );
    @elseif(session('successdeletecart'))
        Swal.fire(
            'Sukses',
            '{{ session('successdeletecart') }}!',
            'success'
        );
    @elseif(session('successprocesscart'))
        Swal.fire(
            'Sukses',
            '{{ session('successprocesscart') }}!',
            'success'
        );
    @elseif(session('errorprocess'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('errorprocess') }}',
        });
    @endif
</script>
@endsection

{{-- livewire jetstream dashboard --}}
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
 --}}

 {{-- AdminLTE dashboard --}}
@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box-open    "></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Produk</span>
                    <span class="info-box-number">
                    @if ($products == null)
                        {{ 0 }}
                    @else
                        {{ $products->count() }}
                    @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Transaksi</span>
                    <span class="info-box-number">
                        @if ($transactions == null)
                            {{ 0 }}
                        @else
                            {{ $transactions->count() }}
                        @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Admin</span>
                    <span class="info-box-number">
                        @if ($admins == null)
                            {{ 0 }}
                        @else
                            {{ $admins->count() }}
                        @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">
                        @if ($members == null)
                            {{ 0 }}
                        @else
                            {{ $members->count() }}
                        @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
    
@endsection
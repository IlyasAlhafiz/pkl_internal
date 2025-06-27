@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1>Dashboard</h1>
    <p>Selamat datang di halaman admin</p>
    <p>Ini adalah halaman utama untuk
         
    <div class="row gx-3">
    <div class="col-lg-4 col-xxl-2 col-6">
    <div class="card text-white bg-primary rounded">
      <div class="card-body p-4">
        <span>
          <i class="ti ti-layout-grid fs-8"></i>
        </span>
        <h3 class="card-title mt-3 mb-0 text-white">{{ $data['totalProduk'] }}</h3>
        <p class="card-text text-white-50 fs-3 fw-normal">
          Total Produk
        </p>
      </div>
    </div>
    </div>
    <div class="col-lg-4 col-xxl-2 col-6">
    <div class="card text-white text-bg-success">
      <div class="card-body p-4">
        <span>
          <i class="ti ti-archive fs-8"></i>
        </span>
        <h3 class="card-title mt-3 mb-0 text-white">{{ $data['totalKategori'] }}</h3>
        <p class="card-text text-white-50 fs-3 fw-normal">
          Total Kategori
        </p>
      </div>
    </div>
    </div>
    <div class="col-lg-4 col-xxl-2 col-6">
    <div class="card text-white text-bg-warning">
      <div class="card-body p-4">
        <span>
          <i class="ti ti-users fs-8"></i>
        </span>
        <h3 class="card-title mt-3 mb-0 text-white">{{ $data['totalUsers'] }}</h3>
        <p class="card-text text-white-50 fs-3 fw-normal">
          Total User
        </p>
      </div>
    </div>
    </div>
    <div class="col-lg-4 col-xxl-2 col-6">
    <div class="card text-white text-bg-danger">
      <div class="card-body p-4">
        <span>
          <i class="ti ti-gift fs-8"></i>
        </span>
        <h3 class="card-title mt-3 mb-0 text-white">{{ $data['totalOrders'] }}</h3>
        <p class="card-text text-white-50 fs-3 fw-normal">
          Total Order
        </p>
      </div>
    </div>
    </div>
    
</div>
@endsection
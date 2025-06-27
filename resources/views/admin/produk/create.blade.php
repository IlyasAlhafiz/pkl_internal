@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Tambah Produk</h4>
        <form action="{{ route('admin.produk.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <select name="id_kategori" id="id_kategori" class="form-control">
                            <option disabled selected>Pilih Kategori</option>
                            @foreach ($kategori as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        <label for="tb-frame">Nama Kategori</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama" value="{{old('nama')}}" required>
                        <label for="tb-frame">Nama Produk</label>
                        @error('nama')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="deskripsi" value="{{old('deskripsi')}}" required>
                        <label for="tb-frame">Deskripsi</label>
                        @error('deskripsi')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="harga" value="{{old('harga')}}" required>
                        <label for="tb-frame">Harga</label>
                        @error('harga')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="stok" value="{{old('stok')}}" required>
                        <label for="tb-frame">Stok</label>
                        @error('stok')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" name="gambar" accept="image/*">
                        <label for="tb-frame">Foto</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-md-flex align-items-center">
                        <div class="ms-auto mt-3 mt-md-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send fs-4"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
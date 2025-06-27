@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-14">
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        <div class="table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Nama Produk</th>
                    <th>Slug</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Foto Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->kategori->nama }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->slug }}</td>
                        <td>{{ $data->deskripsi }}</td>
                        <td>{{ $data->stok }}</td>
                        <td><img src="{{ asset('storage/' .$data->gambar) }}" width="100" alt=""></td>
                        <td>
                            <a href="{{ route('admin.produk.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.produk.destroy', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
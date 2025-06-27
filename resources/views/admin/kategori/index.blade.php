@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-14">
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
        <div class="table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->slug }}</td>
                        <td>
                            <a href="{{ route('admin.kategori.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.kategori.destroy', $data->id) }}" method="POST" class="d-inline">
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
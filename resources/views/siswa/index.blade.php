<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Siswa</h1>
    <a href="{{ route('siswa.create') }}">Tambah Data Siswa</a>
    
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
        @forelse ($data as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['kelas'] }}</td>
            <td>
                <form action="{{ route('siswa.destroy', $item['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
        </tr>
            @empty
        <tr>
            <td>Tidak ada data siswa</td>
            @endforelse
        </tr>
    </table>
</body>
</html>
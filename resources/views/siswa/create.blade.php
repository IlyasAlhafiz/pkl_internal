<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Data Siswa</h1>

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>
                    <input type="text" name="kelas" value="{{ old('kelas') }}">
                    @error('kelas')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </td>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">Simpan</button>
                </td>
            </tr>
        </table>
    </form>

    <a href="{{ route('siswa.index') }}">Kembali ke Daftar Siswa</a>
</body>
</html>
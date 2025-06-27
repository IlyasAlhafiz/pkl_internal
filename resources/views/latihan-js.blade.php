@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Latihan JS</h1>
    <p id="text">Ini penjelasannya</p>
    <button id="alertButton" class="btn btn-primary">Klik</button>
</div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertButton = document.getElementById('alertButton');
            const textElement = document.getElementById('text');

            alertButton.addEventListener('click', function() {
                alert('Tombol telah diklik!');
                textElement.textContent = 'Tombol telah diklik!';
            });
        });
    </script>
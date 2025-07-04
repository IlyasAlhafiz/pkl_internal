    @include('layouts.frontend.navbar')
    @include('layouts.frontend.sidebar')

    <div class="container py-5 position-relative">

        <a href="{{ route('welcome') }}" class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 mt-3 me-3" 
        style="z-index: 10; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
            </svg>
        </a>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="row align-items-start">
                    <div class="col-md-6 mb-4">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="img-fluid rounded shadow">
                    </div>

                    <div class="col-md-6 ps-md-5 ps-4">
                        <h2 class="mb-3">{{ $produk->nama }}</h2>
                        <p class="text-muted">Kategori: <strong>{{ $produk->kategori->nama }}</strong></p>
                        <p class="text-muted">Stok Tersedia: <strong>{{ $produk->stok }}</strong></p>

                        <h4 class="text-dark mt-3">
                            <span class="badge bg-warning text-dark fs-5 shadow-sm">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                        </h4>

                        <form action="{{ route('order.create') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="items[0][id_produk]" value="{{ $produk->id }}">

                            @if ($produk->stok > 0)
                            <div class="mb-3 d-flex align-items-center">
                                <label for="qty" class="me-2">Jumlah:</label>
                                <input type="number" name="items[0][quantity]" id="qty" class="form-control" value="1" min="1" max="{{ $produk->stok }}" style="width: 80px;">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Masukan ke Keranjang
                                <svg width="16" height="16"><use xlink:href="#cart"></use></svg>
                            </button>
                            @else
                            <div class="alert alert-danger">Stok habis</div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 ps-md-5 ps-3">
                        <h5>Deskripsi Produk</h5>
                        <p>{{ $produk->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('sweetalert::alert')
    @endpush
    @include('layouts.frontend.footer')

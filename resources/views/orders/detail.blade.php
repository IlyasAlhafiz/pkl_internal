@include('layouts.frontend.navbar')
@include('layouts.frontend.sidebar')

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('orders.myOrders') }}" class="btn btn-outline-secondary">
                &laquo; Kembali Ke Daftar Pesanan
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Pesanan #{{ $order->id }}</h4>
                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-primary' }}">
                        {{ $order->status == 'completed' ? 'selesai' : 'Menunggu Pembayaran' }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Tanggal Pesanan:</strong></p>
                            <p>{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Status Pesanan</strong></p>
                            <p>{{ $order->status == 'completed' ? 'selesai' : 'Menunggu Pembayaran' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Produk Yang Dipesan</h4>
                </div>
                <div class="card-body">       
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="100">Photo</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderProduks as $item)
                                    <tr>
                                        <td>
                                            @if ($item->produk->gambar)
                                                <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->produk->nama }}" class="img-thumbnail" width="80">
                                            @else
                                                <div class="bg-light text-center p-2" style="width: 80px; height: 80px;">
                                                    Tidak ada gambar
                                                </div>
                                            @endif
                                        </td>
                                        <td><h6 class="mb-0">{{ $item->produk->nama }}</h6></td>
                                        <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <form action="{{ route('order.update-quantity', $item->id) }}" method="POST" class="d-flex align-items-center">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="hidden" name="id_order" value="{{ $item->id }}">
                                                        <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" min="1" max="{{ $item->produk->stok }}" style="width: 60px;">
                                                        <button type="submit" class="btn btn-primary">Perbarui</button>
                                                        <small class="text-muted btn-outline-primary ms-2">
                                                            Tersedia: {{ $item->produk->stok }}
                                                        </small>
                                                    </div>
                                                </form>
                                            @else
                                                <span class="badge bg-primary">{{ $item->quantity }}</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            @if ($order->status == 'pending')
                                                <form action="{{ route('order.remove-item', $item->id) }}" method="POST" class="d-inline-block ms-2">
                                                    @csrf
                                                    <input type="hidden" name="id_order" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Produk ini?')">Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
                            </tfoot>     
                        </table>    
                    </div>             
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Ringkasan Belanja</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Jumlah item <span>{{ $order->orderProduks->sum('quantity') }}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Total Harga <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Status <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-primary' }}">{{ $order->status == 'completed' ? 'Selesai' : 'Menunggu Pembayaran' }}</span></li> 
                        @if ($order->status == 'completed')
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal Selesai <span>{{ $order->updated_at->format('d M Y H:i') }}</span></li>
                        @endif
                    </ul>

                    @if ($order->status == 'pending')
                        <div class="mt-3">
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_order" value="{{ $order->id }}">
                                <button type="submit" class="btn btn-primary w-100">Bayar Sekarang</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @include('sweetalert::alert')
@endpush
@include('layouts.frontend.footer')
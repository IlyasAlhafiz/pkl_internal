@include('layouts.frontend.navbar')
@include('layouts.frontend.sidebar')

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Pesanan Saya</h2>

            @if ($orders->isEmpty())
                <div class="alert alert-info">
                    Anda belum memiliki pesanan.
                </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                        <td>{{ $order->orderProduks->sum('quantity') }}</td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-primary' }}">
                                                {{ $order->status == 'completed' ? 'Selesai' : 'Menunggu Pembayaran' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.detail', $order->id) }}" class="btn btn-sm btn-primary">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
        </div>
    </div>
</div>

@push('scripts')
    @include('sweetalert::alert')
@endpush
@include('layouts.frontend.footer')
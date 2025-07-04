                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                        <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                            @foreach ($produk as $data)
                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                                        <figure>
                                            <a href="{{ route('produk.show', $data->id) }}" title="{{ $data->nama }}">
                                                <img src="{{ asset("storage/{$data->gambar}") }}"  class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>{{ $data->nama }}</h3>
                                        <p class="mb-0 text-muted small">Stok: {{ $data->stok }} | <strong>{{ $data->kategori->nama }}</strong></p>
                                        <span class="price">{{ number_format($data->harga, 0, ',','.') }}</span>
                                        <div class="d-flex align-items-center justify-content-between">

                                              <form action="{{ route('order.create') }}" method="POST"
                                                class="mt-2" style="{{ $data->stok == 0 ? 'display: none;' : '' }}">
                                                @csrf
                                                <input type="hidden" name="items[0][id_produk]" value="{{ $data->id }}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="input-group produk-qty" style="max-width: 120px;">
                                                        <input type="number" name="items[0][quantity]"
                                                            class="form-control input-number" value="1" min="1"
                                                            max="{{ $data->stok }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        Masukan ke Keranjang
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#cart"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
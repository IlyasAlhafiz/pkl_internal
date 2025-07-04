<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use App\Models\produk;
use App\Models\Order;
use App\Models\OrderProduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EcommerceController extends Controller
{
    public function index()
    {
        $kategori = kategori::all();
        $produk = produk::all();
        return view('welcome', compact('kategori', 'produk'));
    }

    public function filter(Request $request)
    {
        if ($request->kategori_id === 'all') {
            $produk = Produk::with('kategori')->get();
        } else {
            $produk = Produk::with('kategori')->where('id_kategori', $request->kategori_id)->get();
        }

        return view('layouts.frontend.produk-filtered', compact('produk'))->render();
    }

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return view('produk.detail', compact('produk'));
    }


    public function createOrder(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $existingPendingOrder = Order::where('id_user', Auth::id())
                    ->where('status', 'pending')
                    ->latest()
                    ->first();

                $order = $existingPendingOrder ?? Order::create([
                    'id_user' => Auth::id(),
                    'total_harga' => 0,
                    'status' => 'pending',
                ]);

                $totalHarga = $order->total_harga;

                foreach ($request->items as $item) {
                    $produk = produk::findOrFail($item['id_produk']);
                    $subtotal = $produk->harga * $item['quantity'];

                    $existingItem = OrderProduk::where('id_order', $order->id)
                        ->where('id_produk', $produk->id)
                        ->first();

                    if ($existingItem) {
                        $oldSubtotal = $existingItem->subtotal;
                        $newQuantity = $existingItem->quantity + $item['quantity'];
                        $newSubTotal = $produk->harga * $newQuantity;

                        $existingItem->quantity = $newQuantity;
                        $existingItem->subtotal = $newSubTotal;
                        $existingItem->save();

                        $totalHarga = $totalHarga - $oldSubtotal + $newSubTotal;
                    } else {
                        OrderProduk::create([
                            'id_order' => $order->id,
                            'id_produk' => $item['id_produk'],
                            'quantity' => $item['quantity'],
                            'subtotal' => $subtotal,
                        ]);

                        $totalHarga += $subtotal;
                    }
                }

                $order->total_harga = $totalHarga;
                $order->save();
            });

            $produkNama = produk::findOrFail($request->items[0]['id_produk'])->nama;
            $quantity = $request->items[0]['quantity'];

            Alert::toast("$quantity x $produkNama berhasil ditambahkan ke keranjang.", 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Terjadi error: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }


    public function myOrders(){
        $orders = Order::with(['orderProduks.produk'])
            ->where('id_user', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function orderDetail($id){
        $order = Order::with(['orderProduks.produk'])
        ->where('id_user', Auth::id())
        ->findOrFail($id);

        return view('orders.detail', compact('order'));
    }

    public function updateQuantity(Request $request){
        try {
            $request->validate([
                'id_order' => 'required|exists:order_Produks,id',
                'quantity' => 'required|integer|min:1',
            ]);

            DB::transaction(function () use ($request) {
                $orderProduks = OrderProduk::findOrFail($request->id_order);
                $produk = produk::findOrFail($orderProduks->id_produk);
                $order = order::findOrFail($orderProduks->id_order);

                if ($order->id_user !== Auth::id()) {
                    throw new \Exception('Akses tidak sah untuk pesanan ini.');
                }

                if ($order->status !== 'pending') {
                    throw new \Exception('Tidak dapat mengubah pesanan yang telah selesai.');
                }

                if ($request->quantity > $produk->stok) {
                    throw new \Exception("Maaf, hanya tersedia {$produk->stok} barang untuk {$produk->nama}.");
                }

                $newSubtotal = $produk->harga * $request->quantity;

                $orderProduks->quantity = $request->quantity;
                $orderProduks->subtotal = $newSubtotal;
                $orderProduks->save();

                $order->total_harga = $order->orderProduks->sum('subtotal');
                $order->save();
            });

            Alert::toast("Jumlah berhasil diperbarui.", 'success');
            return back();
        } catch (\Exception $e) {
            Alert::toast('Terjadi error: ' . $e->getMessage(), 'error');
            return back();
        }
    }

    public function removeItem(Request $request)
    {
        try {
            $request->validate([
                'id_order' => 'required|exists:order_produks,id',
            ]);

            $orderDeleted = false;
            $message = null;
            $orderId = null;
            $productName = null;

            DB::transaction(function () use ($request, &$orderDeleted, &$message, &$orderId, &$productName) {
                $orderProduks = OrderProduk::findOrFail($request->id_order);
                $order = Order::findOrFail($orderProduks->id_order);
                $productName = Produk::findOrFail($orderProduks->id_produk)->nama;

                if ($order->id_user !== Auth::id()) {
                    throw new \Exception('Akses tidak sah untuk pesanan ini.');
                }

                if ($order->status !== 'pending') {
                    throw new \Exception('Tidak dapat merubah pesanan yang telah selesai.');
                }

                $orderId = $order->id;
                $order->total_harga -= $orderProduks->subtotal;
                $order->save();

                $orderProduks->delete();

                $remainingCount = OrderProduk::where('id_order', $orderId)->count();

                if ($remainingCount === 0) {
                    $order->delete();
                    $orderDeleted = true;
                    $message = 'Pesanan dihapus karena tidak ada produk di dalamnya.';
                }
            });

            if ($orderDeleted) {
                return redirect()->route('orders.index')->with('info', $message);
            }

            Alert::toast("Produk {$productName} berhasil dihapus dari keranjang.", 'success');
            return redirect()->route('orders.detail', ['id' => $orderId]);

        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                Alert::toast('Validasi gagal: ' . $e->getMessage(), 'error');
                return redirect()->back();
            }

            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }


public function checkOut(Request $request){
    try {
        $redirect = DB::transaction(function () use ($request) {
            $order = Order::with('orderProduks.produk')->findOrFail($request->id_order);

            if ($order->id_user !== Auth::id()) {
                throw new \Exception('Anda tidak memiliki akses ke pesanan ini.');
            }

            if ($order->status !== 'pending') {
                throw new \Exception('Pesanan ini sudah selesai.');
            }

            if ($order->orderProduks->isEmpty()) {
                throw new \Exception('Keranjang belanja kosong.');
            }

            $insufficientStock = [];
            foreach ($order->orderProduks as $item) {
                $produk = $item->produk;

                if ($produk->stok < $item->quantity) {
                    $insufficientStock[] = "{$produk->nama} (diminta: {$item->quantity}, stok: {$produk->stok})";
                }
            }

            if (!empty($insufficientStock)) {
                $produklist = implode(', ', $insufficientStock);
                return redirect()->route('order.detail', $order->id)->with('error', "Stok tidak mencukupi untuk: {$produklist}");
            }

            foreach ($order->orderProduks as $item) {
                $produk = $item->produk;
                $produk->stok -= $item->quantity;
                $produk->save();
            }

            $order->status = 'completed';
            $order->save();

            Alert::toast('Pesanan berhasil diselesaikan.', 'success');
            return redirect()->route('orders.detail', $order->id);
        });

        return $redirect;

    } catch (\Exception $e) {
        Alert::toast('Terjadi error: ' . $e->getMessage(), 'error');
        return redirect()->route('order.myOrders');
    }
}

}

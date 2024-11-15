<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('updated_at', 'asc')->get();
        return view('index', [
            'judul' => 'Homepage SIPEKA',
            'index' => $produk,
        ]);
    }

    public function indexadmin()
    {
        $order = Order::orderBy('updated_at', 'asc')->get();
        return view('backend.v_order.index', [
            'judul' => 'Homepage SIPEKA',
            'order' => $order,
        ]);
    }

    public function order(string $id)
    {
        // $kategori = Produk::with(relations: 'kategori')->findOrFail($id);
        $produk = Produk::with(relations: 'fotoProduk')->findOrFail($id);
        $prod = Produk::inRandomOrder()->take(4)->get(); // Ambil 4 produk secara acak
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('order', [
            'judul' => 'Order Karangan Bunga',
            'produk' => $produk,
            'kategori' => $kategori,
            'prod' => $prod,
        ]);
    }
    public function create(string $id)
    {
        $produk = Produk::with(relations: 'order')->findOrFail($id);
        return view('formorder', [
            'judul' => 'Form Order Karangan Bunga',
            'produk' => $produk,
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->has('produk_id')) {
            return back()->withErrors('Produk ID tidak ditemukan.');
        }
        $request->request->add(['total_price' => $request->qty * 150000, 'status' => 'unpaid']);
        $order = Order::create($request->all());

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->id, // Gunakan id sebagai order_id
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'name' => $request->nama,
                'phone' => $request->no_telepon,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return redirect()
            ->route('paymentorder', [
                'orderId' => $order->id,
                'produkId' => $request->produk_id,
                'snapToken' => $snapToken,
            ])
            ->with('success', 'Data berhasil disimpan.');
    }

    public function paymentorder(string $orderId, string $produkId, string $snapToken)
    {
        $order = Order::findOrFail($orderId);
        $produk = Produk::findOrFail($produkId);

        return view('paymentorder', [
            'judul' => 'Halaman Pembayaran Order Karangan Bunga',
            'order' => $order,
            'produk' => $produk,
            'snapToken' => $snapToken, // Kirimkan token ke view
        ]);
    }

    public function callback(Request $request){
        $serverkey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverkey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $order = Order::find($request->order_id);
                $order->update(attributes: ['status' => 'paid']);
            }
        }
    }
}

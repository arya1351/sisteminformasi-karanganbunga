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
        $request->request->add(['total_price' => $request->qty * 150000, 'status' => 'unpaid']);
        $order = Order::create($request->all());

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'name' => $request->nama,
                'phone' => $request->no_telepon,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('formorder',[  'judul' => 'Order Karangan Bunga',
        'order' => $order,
        'snapToken' => $snapToken, // Kirim token ke view;
    ]);
    }
}

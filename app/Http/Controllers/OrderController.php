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

    public function store(Request $request){
        
        $validatedData = $request->validate(
            [
                'produk_id' => 'required',
                'nama' => 'required|max:255|string',
                'alamat' => 'required',
                'no_telepon' => 'required|string|max:13',
                'qty' => 'required|integer|max:3',
            ],
        );
        Order::create($validatedData);
        return redirect()->route('successorder')->with('success', 'Data berhasil tersimpan');
    }
}

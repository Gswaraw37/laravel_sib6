<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();

        return view('front.home', compact('produk'));
    }

    public function addToCart($id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session()->get('cart', []);
        // session library yang menyimpan sebuah history

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            // increment adalah penambahan value secara berkala
        } else {
            $cart[$id] = [
                "nama" => $produk->nama,
                "quantity" => 1,
                "harga_jual" => $produk->harga_jual,
                "foto" => $produk->foto,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan ke Cart');
    }

    public function detail($id)
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->findOrFail($id);
        
        return view('front.detail', compact('produk'));
    }

    public function cart()
    {
        // panggil detail produk yang sudah masuk kedalam cart
        $produk = Produk::all();
        $cart = session()->get('cart');

        // hitung total harga
        $total = 0;
        if($cart){
            foreach ($cart as $key => $produk) {
                $total += $produk['harga_jual'] * $produk['quantity'];
            }

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $total,
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    // 'last_name' => 'pratama',
                    'email' => Auth::user()->email,
                    // 'phone' => '08111222333',
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // session()->forget('cart');

            return view('front.shop_cart', compact([
                'produk',
                'cart',
                'total',
                'snapToken',
            ]));
        }

        return view('front.home', compact([
            'produk',
        ])); 
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id["quantity"] = $request->quantity];
            session()->put('cart', $cart);
            session()->with('success', 'Cart Terupdate');
        }
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->with('success', 'Cart Delete');
    }
}

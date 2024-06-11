<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $produk = Produk::count();
        $pelanggan = Pelanggan::count();
        $jenis_produk = JenisProduk::count();
        $kartu = Kartu::count();
        $produkData = Produk::select('kode', 'harga_jual')->get();
        $jenis_kelamin = DB::table('pelanggan')
        ->selectRaw('jk, count(jk) as jumlah')
        ->groupBy('jk')
        ->get();

        return view('admin.dashboard', compact([
            'produk',
            'pelanggan',
            'jenis_produk',
            'kartu',
            'produkData',
            'jenis_kelamin',
        ]));
    }
}

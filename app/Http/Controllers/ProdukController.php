<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // index untuk produk
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();

        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_produk = DB::table('jenis_produk')->get();

        return view('admin.produk.create', compact('jenis_produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:produk|max:10',
            'nama' => 'required|max:45',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'min_stok' => 'required|numeric',
            'foto' => 'nullable|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],
        [
            'kode.max' => 'kode maksimal 10 karakter',
            'kode.required' => 'Kode wajib diisi',
            'kode.unique' => 'Kode tidak boleh sama',
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'foto.max' => 'Foto maksimal 2 MB',
            'foto.mimes' => 'File ekstensi hanya bisa jpg, png, jpeg, gif, svg',
            'foto.file' => 'File harus berbentuk image',
        ]);

        //proses upload foto
        //jika file foto ada yang terupload
        if(!empty($request->foto)){
            //maka proses berikut yang dijalankan
            $fileName = 'foto-' . uniqid() . '.' . $request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img'), $fileName);
        } else {
            $fileName = '';
        }

        // tambah data produk
        DB::table('produk')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'min_stok' => $request->min_stok,
            'jenis_produk_id' => $request->jenis_produk_id,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
        ]);

        // Alert::success('Tambah Produk', 'Berhasil Menambahkan Produk');
        return redirect('admin/produk')->with('success', 'Berhasil Menambahkan Produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->where('produk.id', $id)
        ->get();

        return view('admin.produk.detail', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //jenis_produk
        $jenis_produk = DB::table('jenis_produk')->get();
        $produk = DB::table('produk')->where('id', $id)->get();

        return view('admin.produk.edit', compact([
            'jenis_produk',
            'produk',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //foto lama
        $fotoLama = DB::table('produk')->select('foto')->where('id', $id)->get();
        foreach ($fotoLama as $f1) {
            $fotoLama = $f1->foto;
        }

        // jika foto sudah ada yang terupload
        if ($request->foto) {
            // hapus foto lama
            if(!empty($fotoLama->foto)) unlink(public_path('admin/img' . $fotoLama->foto));
            //maka proses berikut yang dijalankan
            $fileName = 'foto-' . uniqid() . '.' . $request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img'), $fileName);
        } else {
            $fileName = $fotoLama;
        }

        DB::table('produk')->where('id', $id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'min_stok' => $request->min_stok,
            'jenis_produk_id' => $request->jenis_produk_id,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
        ]);

        Alert::success('Update Produk', 'Produk Berhasil Diupdate');
        return redirect('admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('produk')->where('id', $id)->delete();

        return redirect('admin/produk');
    }

    public function produkApi()
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Produk',
            'data' => $produk,
        ], 200);
    }

    public function produkApiDetail($id)
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->where('produk.id', $id)
        ->first();

        if ($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Produk',
                'data' => $produk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'Message' => 'Produk Tidak Ditemukan',
            ], 404);
        }
    }
}

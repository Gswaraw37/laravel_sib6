@extends('admin.layouts.app')
@section('konten')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Produk</h1>
@foreach ($produk as $p)
    <form abframeid="iframe.0.9274323699700593" abineguid="6CBCF04EEF434DF783A5C40E835D891D" action="{{ route('produk.update', $p->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="kode" class="col-4 col-form-label">Kode</label> 
            <div class="col-8">
                <input id="kode" name="kode" type="text" class="form-control" value="{{ $p->kode }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-4 col-form-label">Nama</label> 
            <div class="col-8">
                <input id="nama" name="nama" type="text" class="form-control" value="{{ $p->nama }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="harga_beli" class="col-4 col-form-label">Harga Beli</label> 
            <div class="col-8">
                <input id="harga_beli" name="harga_beli" type="text" class="form-control" value="{{ $p->harga_beli }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="harga_jual" class="col-4 col-form-label">Harga Jual</label> 
            <div class="col-8">
                <input id="harga_jual" name="harga_jual" type="text" class="form-control" value="{{ $p->harga_jual }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="stok" class="col-4 col-form-label">Stok</label> 
            <div class="col-8">
                <input id="stok" name="stok" type="text" class="form-control" value="{{ $p->stok }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="min_stok" class="col-4 col-form-label">Minimal Stok</label> 
            <div class="col-8">
                <input id="min_stok" name="min_stok" type="text" class="form-control" value="{{ $p->min_stok }}">
            </div>
        <div class="form-group row">
            <label for="jenis_produk_id" class="col-4 col-form-label">Jenis Produk</label> 
            <div class="col-8">
                <select id="jenis_produk_id" name="jenis_produk_id" class="custom-select">
                    @foreach ($jenis_produk as $j)
                    @php
                        $sel = ($j->id == $p->jenis_produk_id) ? 'selected' : '';
                    @endphp
                        <option value="{{ $j->id }}" {{ $sel }}>{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label> 
            <div class="col-8">
            <textarea id="deskripsi" name="deskripsi" cols="40" rows="5" class="form-control">{{ $p->deskripsi }}</textarea>
            </div>
        </div> 
        <div class="form-group row">
            <label for="foto" class="col-4 col-form-label">Foto</label> 
            <div class="col-8">
                @if(!empty($p->foto))
                    <div class="mb-3">
                        <img id="preview" src="{{ asset('admin/img/' . $p->foto) }}" alt="Product Image" class="img-fluid" style="max-width: 200px;">
                    </div>
                    <p>Current file: {{ $p->foto }}</p>
                @else
                    <div class="mb-3">
                        <img id="preview" src="{{ asset('admin/img/nophoto.jpg') }}" alt="Placeholder Image" class="img-fluid" style="max-width: 200px;">
                    </div>
                    <p>No file chosen</p>
                @endif
                <input id="foto" name="foto" type="file" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endforeach
@endsection
@extends('admin.layouts.app')
@section('konten')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Produk</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form abframeid="iframe.0.9274323699700593" abineguid="6CBCF04EEF434DF783A5C40E835D891D" action="/admin/produk" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="kode" class="col-4 col-form-label">Kode</label> 
        <div class="col-8">
            <input id="kode" name="kode" type="text" class="form-control @error('kode') is-invalid @enderror">
            @error('kode')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-4 col-form-label">Nama</label> 
        <div class="col-8">
            <input id="nama" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="harga_beli" class="col-4 col-form-label">Harga Beli</label> 
        <div class="col-8">
            <input id="harga_beli" name="harga_beli" type="text" class="form-control @error('harga_beli') is-invalid @enderror">
            @error('harga_beli')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="harga_jual" class="col-4 col-form-label">Harga Jual</label> 
        <div class="col-8">
            <input id="harga_jual" name="harga_jual" type="text" class="form-control @error('harga_jual') is-invalid @enderror">
            @error('harga_jual')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="stok" class="col-4 col-form-label">Stok</label> 
        <div class="col-8">
            <input id="stok" name="stok" type="text" class="form-control @error('stok') is-invalid @enderror">
            @error('stok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="min_stok" class="col-4 col-form-label">Minimal Stok</label> 
        <div class="col-8">
            <input id="min_stok" name="min_stok" type="text" class="form-control @error('min_stok') is-invalid @enderror">
            @error('min_stok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    <div class="form-group row">
        <label for="jenis_produk_id" class="col-4 col-form-label">Jenis Produk</label> 
        <div class="col-8">
            <select id="jenis_produk_id" name="jenis_produk_id" class="custom-select">
                @foreach ($jenis_produk as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label> 
        <div class="col-8">
          <textarea id="deskripsi" name="textarea" cols="40" rows="5" class="form-control @error('deskripsi') is-invalid @enderror"></textarea>
          @error('deskripsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> 
    <div class="form-group row">
        <label for="foto" class="col-4 col-form-label">Foto</label> 
        <div class="col-8">
            <input id="foto" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
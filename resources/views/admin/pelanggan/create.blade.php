@extends('admin.layouts.app')
@section('konten')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Produk</h1>
<form abframeid="iframe.0.9274323699700593" abineguid="6CBCF04EEF434DF783A5C40E835D891D" action="/admin/pelanggan" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
    <label for="kode" class="col-4 col-form-label">Kode</label> 
    <div class="col-8">
        <input id="kode" name="kode" type="text" class="form-control">
    </div>
    </div>
    <div class="form-group row">
    <label for="nama" class="col-4 col-form-label">Nama</label> 
    <div class="col-8">
        <input id="nama" name="nama" type="text" class="form-control">
    </div>
    </div>
    <div class="form-group row">
    <label for="jk" class="col-4 col-form-label">Jenis Kelamin</label> 
    <div class="col-8">
        @foreach ($gender as $g)
        @php
            $cek = (old('g') == $g) ? 'checked' : '';
        @endphp
            <div class="custom-control custom-radio custom-control-inline">
                <input name="jk" id="jk{{ $g }}" type="radio" class="custom-control-input" value="{{ $g }}" {{ $cek }}> 
                <label for="jk{{ $g }}" class="custom-control-label">{{ $g }}</label>
            </div>
        @endforeach
    </div>
    </div>
    <div class="form-group row">
    <label for="tmp_lahir" class="col-4 col-form-label">Tempat Lahir</label> 
    <div class="col-8">
        <input id="tmp_lahir" name="tmp_lahir" type="text" class="form-control">
    </div>
    </div>
    <div class="form-group row">
    <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label> 
    <div class="col-8">
        <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control">
    </div>
    </div>
    <div class="form-group row">
    <label for="email" class="col-4 col-form-label">Email</label> 
    <div class="col-8">
        <input id="email" name="email" type="email" class="form-control">
    </div>
    </div>
    <div class="form-group row">
    <label for="kartu_id" class="col-4 col-form-label">Pilihan Kartu</label> 
    <div class="col-8">
        <select id="kartu_id" name="kartu_id" class="custom-select">
            @foreach ($kartu as $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>
    </div> 
    <div class="form-group row">
    <div class="offset-4 col-8">
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
</form>
@endsection
@extends('admin.layouts.app')
@section('konten')
@if(Auth::user()->role != 'staff' && Auth::user()->role != 'manager')
<div class="container-fluid px-4">
    <h1 class="mt-4">Kartu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Kartu</li>
    </ol>
    {{-- <div class="card mb-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div> --}}
    <div class="card mb-4">
        <div class="card-header">
            <a href="" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-square-plus"></i></a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Diskon</th>
                        <th>Iuran</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Diskon</th>
                        <th>Iuran</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($kartu as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->kode }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->diskon }}</td>
                            <td>{{ $k->iuran }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kartu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/admin/kartu/store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="kode" id="kode" aria-describedby="emailHelp" placeholder="Tambahkan Kode">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp" placeholder="Tambahkan Nama">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="diskon" id="diskon" aria-describedby="emailHelp" placeholder="Tambahkan Diskon">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="iuran" id="iuran" aria-describedby="emailHelp" placeholder="Tambahkan Iuran">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@else
@php
    abort(403, 'Forbidden');
@endphp
@endif
@endsection
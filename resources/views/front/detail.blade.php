@extends('front.layouts.app')
@section('content')

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                @empty($produk->foto) 
                    <img class="card-img-top mb-5 mb-md-0" src="{{url('admin/img/nophoto.jpg')}}" alt="..." />
                @else
                    <img class="card-img-top mb-5 mb-md-0" src="{{url('admin/img')}}/{{$produk->foto}}" alt="..." />
                @endempty
            </div>
            <div class="col-md-6">
                <div class="small mb-1">{{ $produk->jenis_produk->nama  }}</div>
                <h1 class="display-5 fw-bolder">{{ $produk->nama }}</h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">$45.00</span>
                    <span>Rp{{ number_format($produk->harga_jual,0,',','.') }}</span>
                </div>
                <p class="lead">{{ $produk->deskripsi }}</p>
                @auth
                    <div class="d-flex">
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <a class="btn btn-outline-dark mt-auto" href="{{ route('add.to.cart', $produk->id) }}">
                                <i class="bi-cart-fill me-1"></i>
                                    Add To Cart
                            </a>
                        </button>
                    </div>
                @else
                    <a class="btn btn-outline-dark mt-auto" href="{{ route('login') }}">Add To Cart?</a>
                @endauth
            </div>
        </div>
    </div>
</section>

@endsection
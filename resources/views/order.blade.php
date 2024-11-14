@extends('app')
@section('content')
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <div>
                        <a class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <img class="card-img-top mb-5 mb-md-0 rounded"
                                src="{{ asset('storage/img-produk/' . $produk->foto) }}" alt="..." />
                    </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="small mb-1"><span
                            class="fs-5 mb-5">{{ $produk->kategori ? $produk->kategori->nama_kategori : 'Kategori tidak tersedia' }}</span>
                    </div>
                    <h1 class="display-5 fw-bolder">{{ $produk->nama_produk }}</h1>
                    <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through">RP
                            {{ number_format(($produk->harga * 125) / 100, 0, ',', '.') }}</span>
                        <span>RP {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('formorder', $produk->id) }}" class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Order
                        </a>
                    </div>
                </div>
                <div class="py-4">
                    <p class="lead" id="ckeditor">{!! $produk->detail !!}</p>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close border border-secondary" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/img-produk/' . $produk->foto) }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            @foreach ($produk->fotoProduk as $gambar)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/img-produk/' . $gambar->foto) }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($prod as $prod)
                    
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/img-produk/' . $prod->foto) }}"
                            alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $prod->nama_produk }}</h5>
                                <!-- Product price-->
                                <span class="text-decoration-line-through">RP
                                    {{ number_format(($produk->harga * 125) / 100, 0, ',', '.') }}</span>
                                <span>RP {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Order</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
   @endsection
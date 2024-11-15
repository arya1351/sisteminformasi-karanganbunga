@extends('app')
@section('content')
    <!-- contentAwal -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('orderstore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title"> {{ $judul }} </h4>
                            <div class="row">
                                <div class="px-4 mx-4 d-flex">
                                    <img src="{{ asset('storage/img-produk/' . $produk->foto) }}" class="foto-preview rounded" width="300px">
                                    <div class="px-4">
                                        <div class="row">
                                            <h5>Nama Produk</h5>
                                             <h1 class="fs-2">{{ $produk->nama_produk }}</h1>
                                        </div>
                                        <div class="row">
                                            <h5>Harga/Pcs</h5>
                                    <p>{{ $produk->harga }}</p>
                                        </div>
                                        <div class="row">
                                            <h5>Deskripsi</h5>
                                    <p>{!! $produk->detail !!}</p>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                                <div class="form-group">
                                    <label>Nama Pemesan</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan Nama">
                                    @error('nama')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label><br>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="ckeditor">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Nomer Telepon</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)" name="no_telepon"
                                        value="{{ old('no_telepon') }}"
                                        class="form-control @error('no_telepon') is-invalid @enderror"
                                        placeholder="Masukkan Nomer Telepon">
                                    @error('no_telepon')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Total Order</label>
                                    <input type="number" onkeypress="return hanyaAngka(event)" name="qty"
                                        value="{{ old('qty') }}"
                                        class="form-control @error('qty') is-invalid @enderror"
                                        placeholder="Masukkan Quantity">
                                    @error('qty')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Total harga</label>
                                    <input type="text" name="total_price" value="{{ $produk->harga }}"
                                        class="form-control @error('total_price') is-invalid @enderror"
                                        placeholder="{{ $produk->harga }}" readonly>
                                    @error('total_price')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" id="pay-button" class="btn btn-primary">Bayar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection

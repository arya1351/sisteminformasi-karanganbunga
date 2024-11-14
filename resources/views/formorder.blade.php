@extends('app')
@section('content')
      <!-- contentAwal -->

      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('orderstore') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title"> {{ $judul }} </h4>
                            <div class="row">

                                <div class="form-group">
                                    <label>Nama Barang yang di pesan</label>
                                    <input type="text" name="produk_id" value="{{ ($produk->id) }}"
                                        class="form-control @error('produk_id') is-invalid @enderror"
                                        placeholder="{{ $produk->nama_produk }}" readonly>
                                    @error('produk_id')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                    <div class="form-group">
                                        <label>Nama</label>
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
                                        <input type="no_telepon" onkeypress="return hanyaAngka(event)" name="no_telepon"
                                            value="{{ old('no_telepon') }}"
                                            class="form-control 
                                        @error('no_telepon') is-invalid @enderror"
                                            placeholder="Masukkan Nomer Telepon">
                                        @error('no_telepon')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Total Order</label>
                                        <input type="integer" onkeypress="return hanyaAngka(event)" name="qty"
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
                                        <input type="integer" name="total_price" value="{{ ($produk->harga*qty) }}"
                                            class="form-control @error('produk_id') is-invalid @enderror"
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection
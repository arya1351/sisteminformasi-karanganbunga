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
                                <div class="form-group">
                                    <label>Nama Barang yang di pesan</label>
                                    <input type="text" name="produk_id" value="{{ $produk->id }}"
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


     <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
  <div id="snap-container"></div>

  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.embed('{{ $snapToken }}', {
        embedId: 'snap-container',
        onSuccess: function (result) {
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });
  </script>
    <!-- contentAkhir -->
@endsection

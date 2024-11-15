@extends('app')
@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> {{ $judul }} </h4>
                        <div class="row">
                            <div class="table-responsive">
                                <table id="zero_config" class="table-striped table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nomer Telepon</th>
                                            <th>Quantity</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @if ($order)
                                            <tr>
                                                <td> {{ $no++ }}</td>
                                                <td>{{ $order->nama }}</td>
                                                <td>{{ $order->alamat }}</td>
                                                <td>{{ $order->no_telepon }}</td>
                                                <td>{{ $order->qty }}</td>
                                                <td>{{ $order->total_price }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4">Data order tidak ditemukan</td>
                                            </tr>
                                        @endif
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <a class="btn btn-primary" id="pay-button">Bayar</a>
                            </div>
                            <div id="snap-container"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->


        <script type="text/javascript">
            var payButton = document.getElementById('pay-button');
            var paymentInProgress = false;

            payButton.addEventListener('click', function() {
              
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        alert("Payment success!");
                        console.log(result);
                        paymentInProgress = false;
                    },
                    onPending: function(result) {
                        alert("Waiting for your payment!");
                        console.log(result);
                        paymentInProgress = false;
                    },
                    onError: function(result) {
                        alert("Payment failed!");
                        console.log(result);
                        paymentInProgress = false;
                    },
                   
                });
            });
        </script>
        <!-- contentAkhir -->
    @endsection

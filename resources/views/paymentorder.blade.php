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
                                <div class="table-responsive">
                                    <table id="zero_config" class="table-striped table-bordered table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Email</th>
                                                <th>Nama</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($order as $order)
                                                <tr>
                                                    <td> {{ $order->nama }} </td>
                                                    <td> {{ $order->alamat }} </td>
                                                    <td> {{ $order->no_telepon }} </td>
                                                    <td> {{ $order->total_price }} </td>
                                                    <td>

                                                        {{-- <form method="POST"
                                                            action="{{ route('backend.user.destroy', $order->id) }}"
                                                            style="display: inline-block;">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm 
                                                            show_confirm"
                                                                data-konf-delete="{{ $order->nama }}" title='Hapus Data'>
                                                                <i class="fas fa-trash"></i> Hapus</button>
                                                        </form> --}}

                                                    </td>
                                                </tr>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Bayar</button>

                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection

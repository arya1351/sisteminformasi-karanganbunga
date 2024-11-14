@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="row">

        <div class="col-12">
            <a href="{{ route('backend.produk.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                    Tambah</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $judul }} </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No telepon</th>
                                    <th>Jumlah</th>
                                    <th>Status Pembelian</th>
                                    <th>Nomer Resi</th>
                                    <th>Status Barang</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($order as $order)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $order->nama }} </td>
                                        <td>{{ $order->no_telepon }} </td>
                                        <td> {{ $order->qty }} </td>
                                        <td> {{ $order->status }} </td>
                                        <td> {{ $order->no_resi }} </td>
                                        <td> {{ $order->selling }} </td>
                                        <td>
                                            <a href="{{ route('backend.produk.edit', $order->id) }}" title="Ubah Data">
                                                <button type="button" class="btn btn-cyan btn-sm"><i
                                                        class="far fa-edit"></i> Ubah</button>
                                            </a>
                                            <a href="{{ route('backend.produk.show', $order->id) }}" title="Ubah Data">
                                                <button type="button" class="btn btn-warning btn-sm"><i
                                                        class="fas fa-plus"></i> Gambar</button>
                                            </a>

                                            <form method="POST" action="{{ route('backend.produk.destroy', $order->id) }}"
                                                style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $order->nama }}" title='Hapus Data'>
                                                    <i class="fas fa-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="form-group mb-3">
                <a href="{{ url('kategori-items') }}" class="btn btn-secondary">
                    Kembali ke Daftar Kategori
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    Detail Kategori
                </div>

                <div class="card-body">

                    <table class="mb-4">
                        <tr>
                            <th>Nama Kategori</th>
                            <td>:</td>
                            <td>{{ $kategori->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td>:</td>
                            <td>{{ $kategori->kode }}</td>
                        </tr>
                    </table>

                    <h5>Daftar Item dalam Kategori Ini:</h5>

                    @if($kategori->items->count() == 0)
                        <p class="text-muted">Belum ada item pada kategori ini.</p>
                    @else
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>Nama Item</th>
                                    <th>Harga Beli</th>
                                    <th>Laba (%)</th>
                                    <th>Harga Jual</th>
                                    <th>Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori->items as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->harga_beli }}</td>
                                        <td>{{ $item->laba }}</td>
                                        <td>{{ $item->harga_beli + $item->harga_beli * $item->laba / 100 }}</td>
                                        <td>{{ $item->supplier }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

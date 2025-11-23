@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{ url('kategori-items') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detail Kategori</span>
                    {{-- TOMBOL DOWNLOAD PDF --}}
                    <a href="{{ url('kategori-items/print/' . $kategori->id) }}" class="btn btn-sm btn-danger" target="_blank">
                        <i class="fa fa-file-pdf"></i> Download PDF
                    </a>
                </div>

                <div class="card-body">
                    {{-- Detail Kategori --}}
                    <table class="table table-borderless">
                        <tr>
                            <th width="150px">Nama Kategori</th>
                            <td width="10px">:</td>
                            <td>{{ $kategori->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kode Kategori</th>
                            <td>:</td>
                            <td>{{ $kategori->kode }}</td>
                        </tr>
                    </table>

                    <hr>
                    
                    {{-- List Item Terkait --}}
                    <h5 class="mt-4 mb-3">Item dalam Kategori Ini</h5>
                    @if($items->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->kode ?? '-' }}</td>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning">Tidak ada item di kategori ini.</div>
                    @endif

                    <div class="mt-4">
                        <a class="btn btn-info" href="{{ url('kategori-items/edit/'.$kategori->id) }}">Edit</a>
                        <a class="btn btn-danger" href="{{ url('kategori-items/delete/'.$kategori->id) }}" onclick="return confirm('Yakin hapus?');">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
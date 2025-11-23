@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Tombol Tambah (Sesuai style master_items/index/index.blade.php) --}}
            <div class="form-group mb-2">
                <a href="{{ url('kategori-items/create') }}" class="btn btn-secondary">+ Kategori Baru</a>
            </div>

            <div class="card">
                <div class="card-header">Daftar Kategori Item</div>

                <div class="card-body">
                    {{-- SECTION FILTER (Menggunakan GET Request sesuai Controller) --}}
                    <div id="filter-container" class="mb-3 border-bottom pb-3">
                        <h4>Filter</h4>
                        <form action="{{ url('kategori-items') }}" method="GET">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" class="form-control" name="kode" value="{{ request('kode') }}" placeholder="Cari Kode...">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ request('nama') }}" placeholder="Cari Nama...">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- SECTION TABLE (Sesuai style master_items/index/table.blade.php) --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $key => $item)
                                <tr>
                                    {{-- Menghitung nomor urut berdasarkan pagination --}}
                                    <td>{{ $data->firstItem() + $key }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <a href="{{ url('kategori-items/show/'.$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                        <a href="{{ url('kategori-items/edit/'.$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ url('kategori-items/delete/'.$item->id) }}" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin ingin menghapus kategori ini?')">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $data->links() }} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
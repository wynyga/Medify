@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{ url('kategori-items') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            </div>
            
            <div class="card">
                <div class="card-header">
                    {{ $method == 'new' ? 'Buat Kategori Baru' : 'Edit Kategori' }}
                </div>

                <div class="card-body">
                    {{-- Penentuan URL Action berdasarkan Method --}}
                    <form method="POST" action="{{ $method == 'new' ? url('kategori-items/store') : url('kategori-items/update/'.$kategori->id) }}">
                        @csrf
                        
                        {{-- Field Kode --}}
                        <div class="form-group mb-3">
                            <label>Kode Kategori</label>
                            <input type="text" 
                                   class="form-control @error('kode') is-invalid @enderror" 
                                   name="kode" 
                                   required 
                                   value="{{ old('kode', $kategori->kode ?? '') }}">
                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Field Nama --}}
                        <div class="form-group mb-3">
                            <label>Nama Kategori</label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   name="nama" 
                                   required 
                                   value="{{ old('nama', $kategori->nama ?? '') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">
                            {{ $method == 'new' ? 'Simpan Baru' : 'Simpan Perubahan' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
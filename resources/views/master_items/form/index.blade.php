@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('master-items')}}" class="btn btn-secondary">Kembali ke Daftar Item</a>
            </div>
            <div class="card">
                <div class="card-header">
                    {{ $method == 'new' ? 'Buat Master Item Baru' : 'Edit Master Item' }}
                </div>

                <div class="card-body">
                    @include('master_items.form.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
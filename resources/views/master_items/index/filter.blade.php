<div id="filter-wrapper"> <!-- Ubah ID luar agar beda -->
    <h4>Filter</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-2"> 
                <label>Kode</label>
                <input type="text" class="form-control" id="filter-kode">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-2"> 
                <label>Nama</label>
                <input type="text" class="form-control" id="filter-nama">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-2">
                <label>Kategori</label>
                <select class="form-control" id="filter-kategori">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->kode }} - {{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group mb-2"> 
                <label>Harga Min</label>
                <input type="number" class="form-control" id="filter-harga-min">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group mb-2"> 
                <label>Harga Max</label>
                <input type="number" class="form-control" id="filter-harga-max">
            </div>
        </div>
    </div>
    <button class="btn btn-primary mt-1 btn-get-data">Filter</button>
    <span id="loading-filter" style="display: none; margin-left: 10px;">Loading...</span>
</div>
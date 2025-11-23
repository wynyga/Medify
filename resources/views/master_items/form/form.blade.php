<form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" required readonly value="{{$item->kode ?? ''}}">
    </div>
    @endif

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required value="{{$item->nama ?? ''}}">
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required value="{{$item->harga_beli ?? ''}}">
    </div>

    <div class="form-group">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required value="{{$item->laba ?? ''}}">
    </div>

    <div class="form-group mb-3">
        <label>Foto Barang</label>
        @if(!empty($item->foto))
            <div class="mb-2">
                <img src="{{ asset($item->foto) }}" alt="Foto Barang" style="max-height: 150px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
            </div>
        @endif
        <input type="file" class="form-control" name="foto" accept="image/*">
        @if(!empty($item->foto))
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
        @endif
    </div>
    
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="kategori[]" multiple>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}"
                    @if(!empty($item) && $item->kategori->contains($k->id)) selected @endif>
                    {{ $k->nama }} ({{ $k->kode }})
                </option>
            @endforeach
        </select>
        <small class="text-muted">Tekan CTRL untuk memilih lebih dari satu kategori.</small>
    </div>

    @php $selected = $item->supplier ?? ''; @endphp
    <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Tokopaedi') selected @endif>Tokopaedi</option>
            <option @if($selected == 'Bukulapuk') selected @endif>Bukulapuk</option>
            <option @if($selected == 'TokoBagas') selected @endif>TokoBagas</option>
            <option @if($selected == 'E Commurz') selected @endif>E Commurz</option>
            <option @if($selected == 'Blublu') selected @endif>Blublu</option>
        </select>
    </div>

    @php $selected = $item->jenis ?? ''; @endphp
    <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Obat') selected @endif>Obat</option>
            <option @if($selected == 'Alkes') selected @endif>Alkes</option>
            <option @if($selected == 'Matkes') selected @endif>Matkes</option>
            <option @if($selected == 'Umum') selected @endif>Umum</option>
            <option @if($selected == 'ATK') selected @endif>ATK</option>
        </select>
    </div>

    <button class="btn btn-primary mt-3">Submit</button>

</form>
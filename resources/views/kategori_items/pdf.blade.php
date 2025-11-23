<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kategori Item</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details-table { width: 100%; margin-bottom: 20px; }
        .details-table td { padding: 5px; }
        .items-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .items-table th, .items-table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .items-table th { background-color: #f2f2f2; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; color: #555; }
        .page-number:before { content: counter(page); }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Detail Kategori Item</h2>
    </div>

    {{-- 1 & 2. Nama dan Kode Kategori --}}
    <table class="details-table">
        <tr>
            <td width="150"><strong>Nama Kategori</strong></td>
            <td width="10">:</td>
            <td>{{ $kategori->nama }}</td>
        </tr>
        <tr>
            <td><strong>Kode Kategori</strong></td>
            <td>:</td>
            <td>{{ $kategori->kode }}</td>
        </tr>
    </table>

    <hr>

    {{-- 3. Tabel List Item --}}
    <h3>Daftar Item</h3>
    @if($items->count() > 0)
    <table class="items-table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $item->kode ?? '-' }}</td>
                <td>{{ $item->nama }}</td>
                <td>Rp {{ number_format($item->harga_beli + ($item->harga_beli * $item->laba / 100), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p><i>Tidak ada item dalam kategori ini.</i></p>
    @endif

    {{-- 4. Footer dengan Tanggal Cetak --}}
    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i:s') }}
    </div>

</body>
</html>
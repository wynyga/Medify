<?php

namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Pastikan pakai 's'
use Maatwebsite\Excel\Concerns\WithMapping;  // Pastikan 'pp' (double p)
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MasterItemExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $rowNumber = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data beserta relasi kategori agar query efisien
        return MasterItem::with('kategori')->get();
    }

    /**
     * LOGIKA MAPPING DATA
     */
    public function map($item): array
    {
        $this->rowNumber++;

        // Hitung Harga Jual
        $hargaJual = $item->harga_beli + ($item->harga_beli * $item->laba / 100);

        // Ambil Nama Kategori dipisah koma
        // Jika item tidak punya kategori, handle agar tidak error
        $kategoriList = $item->kategori ? $item->kategori->pluck('nama')->implode(', ') : '-';

        return [
            $this->rowNumber,       // 1. No
            $kategoriList,          // 2. Nama Kategori
            $item->nama,            // 3. Nama Items
            $item->supplier,        // 4. Nama Supplier
            $item->harga_beli,      // 5. Harga
            $item->laba,            // 6. Laba
            $hargaJual,             // 7. Harga Jual
        ];
    }

    /**
     * JUDUL KOLOM EXCEL
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Kategori',
            'Nama Items',
            'Nama Supplier',
            'Harga Beli',
            'Laba (%)',
            'Harga Jual',
        ];
    }
}
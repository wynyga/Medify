<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterItem;
use Illuminate\Support\Facades\DB;

class MasterItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = ['Tokopaedi', 'Bukulapuk', 'TokoBagas', 'E Commurz', 'Blublu'];
        $jenis_list = ['Obat', 'Alkes', 'Matkes', 'Umum', 'ATK'];
        $staticItems = [
            [
                'nama' => 'Paracetamol 500mg',
                'harga_beli' => 5000,
                'laba' => 10,
                'jenis' => 'Obat',
                'supplier' => 'Tokopaedi'
            ],
            [
                'nama' => 'Stetoskop Littmann',
                'harga_beli' => 1500000,
                'laba' => 20,
                'jenis' => 'Alkes',
                'supplier' => 'Blublu'
            ],
            [
                'nama' => 'Kertas HVS A4',
                'harga_beli' => 45000,
                'laba' => 5,
                'jenis' => 'ATK',
                'supplier' => 'TokoBagas'
            ],
        ];

        foreach ($staticItems as $index => $item) {
            $id = $index + 1;
            $kode = str_pad($id, 5, '0', STR_PAD_LEFT);

            MasterItem::create([
                'kode'       => $kode,
                'nama'       => $item['nama'],
                'harga_beli' => $item['harga_beli'],
                'laba'       => $item['laba'],
                'jenis'      => $item['jenis'],
                'supplier'   => $item['supplier'],
            ]);
        }
        for ($i = 4; $i <= 20; $i++) {
            $kode = str_pad($i, 5, '0', STR_PAD_LEFT);
            
            MasterItem::create([
                'kode'       => $kode,
                'nama'       => 'Barang Contoh ' . $i,
                'harga_beli' => rand(1000, 100000), 
                'laba'       => rand(5, 50),        
                'jenis'      => $jenis_list[array_rand($jenis_list)], 
                'supplier'   => $suppliers[array_rand($suppliers)],   
            ]);
        }
    }
}
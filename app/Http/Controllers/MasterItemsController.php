<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use App\Models\KategoriItem; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Exports\MasterItemExport; 
use Maatwebsite\Excel\Facades\Excel;


class MasterItemsController extends Controller
{
    public function index()
    {
        $kategori = \App\Models\KategoriItem::orderBy('nama')->get();

        return view('master_items.index.index', compact('kategori'));
    }

    public function search(Request $request)
    {
        $kategori = $request->kategori;
        $kode = $request->kode;
        $nama = $request->nama;
        $hargamin = $request->hargamin;
        $hargamax = $request->hargamax;
        $data_search = MasterItem::with('kategori');

        if (!empty($kode)) {
            $data_search = $data_search->where('kode', $kode);
        }
        
        if (!empty($nama)) {
            $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        }

        if (!empty($hargamin)) {
            $data_search = $data_search->where('harga_beli', '>=', $hargamin);
        }
        
        if (!empty($hargamax)) {
            $data_search = $data_search->where('harga_beli', '<=', $hargamax);
        }
        if (!empty($kategori)) {
            $data_search = $data_search->whereHas('kategori', function($q) use ($kategori) {
                $q->where('kategori_items.id', $kategori);
            });
        }

        $data_search = $data_search
            ->select('id', 'kode', 'nama', 'jenis', 'harga_beli', 'laba', 'supplier', 'foto')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = new MasterItem();   
        } else {
            $item = MasterItem::with('kategori')->find($id);
        }

        return view('master_items.form.index', [
            'item' => $item,
            'method' => $method,
            'kategori' => KategoriItem::all() 
        ]);
    }

    public function singleView($kode)
    {
        $data['data'] = MasterItem::where('kode', $kode)->first();
        return view('master_items.single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        $request->validate([
            'nama' => 'required',
            'harga_beli' => 'required|integer',
            'laba' => 'required|integer',
            'supplier' => 'required',
            'jenis' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'array'
        ]);

       
        if ($method == 'new') {
            $data_item = new MasterItem;
            $kode = MasterItem::count('id') + 1;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
        } else {
            $data_item = MasterItem::find($id);
            $kode = $data_item->kode;
        }

      
        $data_item->nama = $request->nama;
        $data_item->harga_beli = $request->harga_beli;
        $data_item->laba = $request->laba;
        $data_item->kode = $kode;
        $data_item->supplier = $request->supplier;
        $data_item->jenis = $request->jenis;
        $data_item->save();

      
        if ($request->hasFile('foto')) {
            if ($method != 'new' && $data_item->foto) {
                $old_path = public_path($data_item->foto);
                if (File::exists($old_path)) {
                    File::delete($old_path);
                }
            }

            $file = $request->file('foto');
            $filename = 'item_' . $data_item->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/master_items');
            $file->move($destinationPath, $filename);

            $data_item->foto = '/uploads/master_items/' . $filename;
            $data_item->save();
        }

      
        if ($request->kategori) {
            $data_item->kategori()->sync($request->kategori);
        }

        return redirect('master-items');
    }

    public function delete($id)
    {
        $item = MasterItem::findOrFail($id);

        if ($item->foto) {
            $path = public_path($item->foto);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $item->delete();
        return redirect('master-items');
    }

    public function updateRandomData()
    {
        $data = MasterItem::get();
        foreach($data as $item)
        {
            $kode = str_pad($item->id, 5, '0', STR_PAD_LEFT);

            $item->harga_beli = rand(100,1000000);
            $item->laba = rand(10,99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi','Bukulapuk','TokoBagas','E Commurz','Blublu'];
        return $array[rand(0,4)];
    }

    private function getRandomJenis()
    {
        $array = ['Obat','Alkes','Matkes','Umum','ATK'];
        return $array[rand(0,4)];
    }

    public function exportExcel()
    {
        // Nama file saat didownload
        $nama_file = 'laporan_master_items_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        return Excel::download(new MasterItemExport, $nama_file);
    }

}

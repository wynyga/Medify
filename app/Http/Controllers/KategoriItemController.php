<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriItem;
use App\Models\MasterItem;

class KategoriItemController extends Controller
{
    // =========================
    // LIST + FILTER
    // =========================
    public function index(Request $request)
    {
        $query = KategoriItem::query();

        if ($request->nama) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->kode) {
            $query->where('kode', 'like', '%' . $request->kode . '%');
        }

        $data = $query->paginate(10);

        return view('kategori_items.index', compact('data'));
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        return view('kategori_items.form', [
            'method' => 'new',
            'kategori' => new KategoriItem()
        ]);
    }

    // =========================
    // SAVE CREATE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:kategori_items,kode'
        ]);

        KategoriItem::create([
            'nama' => $request->nama,
            'kode' => $request->kode
        ]);

        return redirect('kategori-items')->with('success', 'Kategori berhasil dibuat.');
    }

    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $kategori = KategoriItem::findOrFail($id);

        return view('kategori_items.form', [
            'method' => 'edit',
            'kategori' => $kategori
        ]);
    }

    // =========================
    // SAVE EDIT
    // =========================
    public function update(Request $request, $id)
    {
        $kategori = KategoriItem::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:kategori_items,kode,' . $kategori->id
        ]);

        $kategori->update([
            'nama' => $request->nama,
            'kode' => $request->kode
        ]);

        return redirect('kategori-items')->with('success', 'Kategori berhasil diperbarui.');
    }

// =========================
    // DELETE
    // =========================
    public function delete($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        $kategori->items()->detach(); 
        
        $kategori->delete();

        return redirect('kategori-items')->with('success', 'Kategori berhasil dihapus.');
    }

    // =========================
    // SINGLE VIEW
    // =========================
    public function show($id)
    {
        $kategori = KategoriItem::with('items')->findOrFail($id); 
        $items = $kategori->items;
        return view('kategori_items.single', compact('kategori', 'items'));
    }

}

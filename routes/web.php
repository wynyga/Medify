<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterItemsController; 
use App\Http\Controllers\KategoriItemController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================================================================
// PUBLIC & AUTH
// ========================================================================
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


// ========================================================================
// GROUP: MASTER ITEMS
// ========================================================================
Route::prefix('master-items')->group(function () {
    
    // List & Search
    Route::get('/', [MasterItemsController::class, 'index']);
    Route::get('/search', [MasterItemsController::class, 'search']);
    
    // Fitur Tambahan (Export & Random Data)
    // Ditaruh di atas route parameter agar tidak konflik
    Route::get('/update-random-data', [MasterItemsController::class, 'updateRandomData']);
    Route::get('/export/excel', [MasterItemsController::class, 'exportExcel']);
    
    // Single View & Actions
    Route::get('/view/{kode}', [MasterItemsController::class, 'singleView']);
    Route::get('/delete/{id}', [MasterItemsController::class, 'delete']);
    
    // Form Create/Edit
    Route::get('/form/{method}/{id?}', [MasterItemsController::class, 'formView']);
    Route::post('/form/{method}/{id?}', [MasterItemsController::class, 'formSubmit']);
});


// ========================================================================
// GROUP: KATEGORI ITEMS
// ========================================================================
Route::prefix('kategori-items')->group(function () {
    
    // List
    Route::get('/', [KategoriItemController::class, 'index']);
    
    // Create
    Route::get('/create', [KategoriItemController::class, 'create']);
    Route::post('/store', [KategoriItemController::class, 'store']);
    
    // Edit
    Route::get('/edit/{id}', [KategoriItemController::class, 'edit']);
    Route::post('/update/{id}', [KategoriItemController::class, 'update']);
    
    // Actions
    Route::get('/delete/{id}', [KategoriItemController::class, 'delete']);
    Route::get('/show/{id}', [KategoriItemController::class, 'show']);
    
    // Print PDF
    Route::get('/print/{id}', [KategoriItemController::class, 'printPdf']);
});
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{
    /**
     * Menampilkan daftar semua item portofolio di halaman index (/portfolio).
     */
    public function index()
    {
        // Ambil semua item portofolio yang akan ditampilkan di grid
        $items = PortfolioItem::orderBy('project_date', 'desc')->get();
        
        // Ambil semua kategori unik untuk tombol filter
        $categories = PortfolioItem::select('category')->distinct()->pluck('category');
        
        // Kirim variabel $items dan $categories ke view portfolio.blade.php
        return view('portfolio', compact('items', 'categories'));
    }

    /**
     * Menampilkan halaman detail (review) portofolio berdasarkan slug.
     */
    public function show($slug)
    {
        // Mencari item portofolio berdasarkan slug, jika tidak ada akan menampilkan 404.
        $item = PortfolioItem::where('slug', $slug)->firstOrFail();
        
        // Mengirim data $item ke view portfolio/detail.blade.php
        return view('admin.portfolio.detail', compact('item')); 
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PortfolioController extends Controller
{
    /**
     * Menampilkan daftar semua item portofolio (admin/portfolio).
     */
    public function index()
    {
        // GANTI: Urutkan berdasarkan ID (entri terbaru) sebagai prioritas utama
        $items = PortfolioItem::orderBy('id', 'desc')->paginate(10);
        
        // Hapus kode debug jika sudah tidak digunakan
        // dd($items->count(), $items->first()); 

        return view('admin.portfolio.index', compact('items')); 
    }

    /**
     * Menampilkan form untuk membuat item portofolio baru (admin/portfolio/create).
     */
    public function create()
    {
        // Kategori bisa diatur di sini atau diambil dari database jika ada model Category terpisah
        $categories = ['3D Game', 'Unity Project', 'Web Design', 'UI/UX', 'Illustration'];
        return view('admin.portfolio.create', compact('categories'));
    }

    /**
     * Menyimpan item portofolio baru ke database.
     */
    public function store(Request $request)
    {
        // Pastikan validasi berjalan dengan baik
        $request->validate([
            'title' => 'required|string|max:255|unique:portfolio_items,title',
            'category' => 'required|string|max:100',
            'description_short' => 'required|string|max:500',
            'description_detail' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
        ]);

        // 1. Proses File Upload GAMBAR UTAMA
        $imagePath = $request->file('main_image')->store('portfolio_images', 'public');
        
        // 2. Buat Slug unik
        $slug = Str::slug($request->title);
        $count = 2;
        while (PortfolioItem::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->title) . '-' . $count++;
        }
        
        // 3. Siapkan data yang bersih (Hanya field yang ada di $fillable)
        $data = $request->except(['_token', 'main_image']); // Ambil semua kecuali token dan file
        
        // 4. Tambahkan field hasil proses file upload dan slug
        $data['main_image_path'] = $imagePath;
        $data['slug'] = $slug;
        $data['project_date'] = $request->project_date ? \Carbon\Carbon::parse($request->project_date) : null;
        
        // 5. Simpan Data
        PortfolioItem::create($data); 

        return redirect()->route('admin.portfolio.index')
                        ->with('success', 'Item portofolio baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit item portofolio (admin/portfolio/{id}/edit).
     */
    public function edit(PortfolioItem $portfolio)
    {
        $categories = ['3D Game', 'Unity Project', 'Web Design', 'UI/UX', 'Illustration'];
        return view('admin.portfolio.edit', ['item' => $portfolio, 'categories' => $categories]);
    }

    /**
     * Memperbarui data item portofolio di database.
     */
    public function update(Request $request, PortfolioItem $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:portfolio_items,title,' . $portfolio->id,
            'category' => 'required|string|max:100',
            'description_short' => 'required|string|max:500',
            'description_detail' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
        ]);

        $data = $request->only([
            'title', 'category', 'description_short', 'description_detail', 
            'client_name', 'project_date', 'project_url'
        ]);
        
        // Perbarui Slug jika judul berubah
        if ($request->title !== $portfolio->title) {
             $data['slug'] = Str::slug($request->title);
        }

        // 1. Proses File Upload Gambar Utama (jika ada file baru)
        if ($request->hasFile('main_image')) {
            // Hapus gambar lama
            if ($portfolio->main_image_path) {
                Storage::disk('public')->delete($portfolio->main_image_path);
            }
            // Upload gambar baru
            $data['main_image_path'] = $request->file('main_image')->store('portfolio_images', 'public');
        }

        // 2. Konversi Tanggal
        $data['project_date'] = $request->project_date ? Carbon::parse($request->project_date) : null;


        // 3. Perbarui Data
        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')
                         ->with('success', 'Item portofolio berhasil diperbarui.');
    }

    /**
     * Menghapus item portofolio dari database.
     */
    public function destroy(PortfolioItem $portfolio)
    {
        // 1. Hapus Gambar dari Storage
        if ($portfolio->main_image_path) {
            Storage::disk('public')->delete($portfolio->main_image_path);
        }

        // 2. Hapus Data dari Database
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
                         ->with('success', 'Item portofolio berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Menampilkan daftar semua proyek (admin/projects).
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Menampilkan form untuk membuat proyek baru (admin/projects/create).
     */
    public function create()
    {
        // Daftar kategori (bisa diambil dari database atau hardcode)
        $categories = [
            'Theme Developer', 
            'Plugin Developer', 
            'Website Developer', 
            'Website Property'
        ];
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Menyimpan proyek baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ], [
            'image.required' => 'Gambar portofolio wajib diunggah.',
            'image.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ]);

        // 1. Proses File Upload
        $imagePath = $request->file('image')->store('projects', 'public');

        // 2. Simpan Data ke Database
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Proyek baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail proyek tertentu (tidak wajib di CMS, tapi disertakan).
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Menampilkan form untuk mengedit proyek (admin/projects/{id}/edit).
     */
    public function edit(Project $project)
    {
        $categories = [
            'Theme Developer', 
            'Plugin Developer', 
            'Website Developer', 
            'Website Property'
        ];
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Memperbarui data proyek di database.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 'nullable' karena file bisa tidak diubah
        ]);

        $imagePath = $project->image;

        // 1. Cek apakah ada file baru diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            
            // Upload gambar baru
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        // 2. Perbarui Data di Database
        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Proyek berhasil diperbarui.');
    }

    /**
     * Menghapus proyek dari database.
     */
    public function destroy(Project $project)
    {
        // 1. Hapus Gambar dari Storage
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        // 2. Hapus Data dari Database
        $project->delete();

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Proyek berhasil dihapus.');
    }
}
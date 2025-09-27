<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Menampilkan daftar semua testimoni (admin/testimonials).
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Menampilkan form untuk membuat testimoni baru (admin/testimonials/create).
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Menyimpan testimoni baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Testimonial::create($request->all());

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit testimoni (admin/testimonials/{id}/edit).
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Memperbarui data testimoni di database.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $testimonial->update($request->all());

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Menghapus testimoni dari database.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimoni berhasil dihapus.');
    }
}
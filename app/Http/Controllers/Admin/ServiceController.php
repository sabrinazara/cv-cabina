<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar semua layanan (admin/services).
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Menampilkan form untuk membuat layanan baru (admin/services/create).
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Menyimpan layanan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255', // Asumsi ikon adalah string (misalnya, kelas Font Awesome)
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')
                         ->with('success', 'Layanan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit layanan (admin/services/{id}/edit).
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Memperbarui data layanan di database.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')
                         ->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Menghapus layanan dari database.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
                         ->with('success', 'Layanan berhasil dihapus.');
    }
}
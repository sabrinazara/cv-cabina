<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    /**
     * Menampilkan daftar semua keahlian (admin/skills).
     */
    public function index()
    {
        $skills = Skill::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Menampilkan form untuk membuat keahlian baru (admin/skills/create).
     */
    public function create()
    {
        $kategoriList = Skill::getKategoriList();
        return view('admin.skills.create', compact('kategoriList'));
    }

    /**
     * Menyimpan keahlian baru ke database.
     * Dengan validasi: wajib diisi dan nama unik
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:skills,nama',
            'kategori' => 'required|string|in:' . implode(',', Skill::KATEGORI),
            'level' => 'nullable|integer|min:0|max:100',
            'deskripsi' => 'nullable|string',
        ], [
            'nama.required' => 'Nama keahlian wajib diisi.',
            'nama.unique' => 'Nama keahlian sudah ada. Silakan gunakan nama lain.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',
            'level.integer' => 'Level harus berupa angka.',
            'level.min' => 'Level minimal 0.',
            'level.max' => 'Level maksimal 100.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.skills.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data
        Skill::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'level' => $request->level ?? 50,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Keahlian baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit keahlian (admin/skills/{id}/edit).
     */
    public function edit(Skill $skill)
    {
        $kategoriList = Skill::getKategoriList();
        return view('admin.skills.edit', compact('skill', 'kategoriList'));
    }

    /**
     * Memperbarui data keahlian di database.
     * Dengan validasi: wajib diisi dan nama unik (kecuali data sendiri)
     */
    public function update(Request $request, Skill $skill)
    {
        // Validasi inputan
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:skills,nama,' . $skill->id,
            'kategori' => 'required|string|in:' . implode(',', Skill::KATEGORI),
            'level' => 'nullable|integer|min:0|max:100',
            'deskripsi' => 'nullable|string',
        ], [
            'nama.required' => 'Nama keahlian wajib diisi.',
            'nama.unique' => 'Nama keahlian sudah ada. Silakan gunakan nama lain.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',
            'level.integer' => 'Level harus berupa angka.',
            'level.min' => 'Level minimal 0.',
            'level.max' => 'Level maksimal 100.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.skills.edit', $skill)
                ->withErrors($validator)
                ->withInput();
        }

        // Update data
        $skill->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'level' => $request->level ?? 50,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil diperbarui.');
    }

    /**
     * Menghapus keahlian dari database.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil dihapus.');
    }
}


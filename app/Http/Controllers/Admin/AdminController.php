<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Menampilkan form edit profile (admin/profile).
     */
    public function profileEdit()
    {
        // Ambil data pertama, atau buat instance kosong jika belum ada
        $profile = ProfileSetting::first() ?? new ProfileSetting();
        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Menyimpan atau memperbarui data profile.
     */
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cv_link' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari atau buat entri ProfileSetting
        $profile = ProfileSetting::first();
        if (!$profile) {
            $profile = new ProfileSetting();
        }

        $photoPath = $profile->photo;

        // 1. Cek apakah ada file foto baru diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }

            // Upload foto baru
            $photoPath = $request->file('photo')->store('profile', 'public');
        }

        // 2. Simpan/Update Data
        $profile->name = $request->name;
        $profile->title = $request->title;
        $profile->description = $request->description;
        $profile->cv_link = $request->cv_link;
        $profile->photo = $photoPath;
        $profile->save();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Pengaturan profil berhasil diperbarui.');
    }
}
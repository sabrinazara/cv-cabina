@extends('layouts.app') 
{{-- Asumsi 'layouts.app' adalah layout yang berisi navigasi admin --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Selamat Datang di Dashboard Admin</h2>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <p class="mb-8 text-lg text-gray-700">Gunakan menu navigasi di atas atau kartu di bawah ini untuk mengelola konten Portofolio Anda.</p>
    
    {{-- Mengubah grid-cols-3 menjadi grid-cols-4 jika Anda memiliki 4 kartu, atau tetap 3 --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6"> 
        
        {{-- Card 1: Portfolio Items BARU (Menggantikan Projects Lama) --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-xl font-semibold mb-3 text-teal-600">Proyek Portofolio</h4>
            <p class="text-gray-600 mb-4">Kelola item portofolio, detail review, dan gambar utamanya.</p>
            <a href="{{ route('admin.portfolio.index') }}" class="text-blue-500 hover:underline font-medium">Lihat Semua &rarr;</a>
            {{-- Mengarah ke: /admin/portfolio --}}
        </div>
        
        {{-- Card 2: Services --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-xl font-semibold mb-3 text-teal-600">Layanan</h4>
            <p class="text-gray-600 mb-4">Tambah, edit, atau hapus layanan yang Anda tawarkan.</p>
            <a href="{{ route('admin.services.index') }}" class="text-blue-500 hover:underline font-medium">Lihat Semua &rarr;</a>
        </div>
        
        {{-- Card 3: Testimonials --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-xl font-semibold mb-3 text-teal-600">Testimoni Klien</h4>
            <p class="text-gray-600 mb-4">Kelola testimoni yang muncul di halaman utama dan Testimonial.</p>
            <a href="{{ route('admin.testimonials.index') }}" class="text-blue-500 hover:underline font-medium">Lihat Semua &rarr;</a>
        </div>

        {{-- Card 4: Profile Settings --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-xl font-semibold mb-3 text-teal-600">Pengaturan Profil</h4>
            <p class="text-gray-600 mb-4">Perbarui data diri, foto profil, dan link CV Anda.</p>
            <a href="{{ route('admin.profile.edit') }}" class="text-blue-500 hover:underline font-medium">Edit Profil &rarr;</a>
        </div>
    </div>
</div>
@endsection
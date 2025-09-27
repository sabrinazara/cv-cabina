@extends('layouts.app') 

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Pengaturan Profil & Data Diri</h2>
    
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Form menggunakan rute PUT 'admin.profile.update' --}}
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT') 

        {{-- Kolom Nama --}}
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name', $profile->name) }}" required>
            @error('name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kolom Title/Jabatan --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Jabatan / Title (Contoh: WordPress Developer)</label>
            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" value="{{ old('title', $profile->title) }}" required>
            @error('title')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Kolom Deskripsi (About/Our Story) --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Profil (Halaman About/Story)</label>
            <textarea name="description" id="description" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description', $profile->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kolom Link CV --}}
        <div class="mb-4">
            <label for="cv_link" class="block text-gray-700 text-sm font-bold mb-2">Link Download CV (URL)</label>
            <input type="url" name="cv_link" id="cv_link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cv_link') border-red-500 @enderror" value="{{ old('cv_link', $profile->cv_link) }}" placeholder="Contoh: https://drive.google.com/link-cv-anda">
            @error('cv_link')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kolom Foto Profil --}}
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Saat Ini</label>
            @if ($profile->photo)
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="Foto Profil" class="h-24 w-24 object-cover rounded-full mb-2">
            @else
                <p class="text-gray-500 text-sm mb-2">Belum ada foto profil diunggah.</p>
            @endif
            
            <label for="photo" class="block text-gray-700 text-sm font-bold mb-2 mt-4">Ganti Foto Profil (Opsional)</label>
            <input type="file" name="photo" id="photo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('photo') border-red-500 @enderror">
            @error('photo')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-start mt-6">
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-700">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
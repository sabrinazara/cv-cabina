@extends('layouts.app') 

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Edit Item Portofolio: {{ $item->title }}</h2>
    
    <form action="{{ route('admin.portfolio.update', $item) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT') {{-- Menggunakan method PUT untuk update --}}

        {{-- Row 1: Judul dan Kategori --}}
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Proyek</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" value="{{ old('title', $item->title) }}" required>
                @error('title') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="category" id="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category') border-red-500 @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $item->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
            </div>
        </div>
        
        {{-- Row 2: Deskripsi Singkat dan Detail --}}
        <div class="mb-6">
            <label for="description_short" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat (Tampil di Index Halaman Portofolio)</label>
            <textarea name="description_short" id="description_short" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description_short') border-red-500 @enderror" required>{{ old('description_short', $item->description_short) }}</textarea>
            @error('description_short') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="description_detail" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Detail (Tampil di Halaman Review)</label>
            <textarea name="description_detail" id="description_detail" rows="8" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description_detail') border-red-500 @enderror" required>{{ old('description_detail', $item->description_detail) }}</textarea>
            @error('description_detail') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>

        {{-- Row 3: Detail Proyek --}}
        @php
            // Format tanggal agar sesuai dengan input type="date" (YYYY-MM-DD)
            $projectDate = $item->project_date ? \Carbon\Carbon::parse($item->project_date)->format('Y-m-d') : null;
        @endphp
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="client_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Klien (Opsional)</label>
                <input type="text" name="client_name" id="client_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('client_name', $item->client_name) }}">
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="project_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai (Opsional)</label>
                <input type="date" name="project_date" id="project_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('project_date', $projectDate) }}">
            </div>
            <div class="w-full md:w-1/3 px-3">
                <label for="project_url" class="block text-gray-700 text-sm font-bold mb-2">Link Live Demo (URL Opsional)</label>
                <input type="url" name="project_url" id="project_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('project_url', $item->project_url) }}">
            </div>
        </div>

        {{-- Row 4: Gambar Utama --}}
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Saat Ini</label>
            @if ($item->main_image_path)
                <img src="{{ asset('storage/' . $item->main_image_path) }}" alt="Gambar Proyek" class="h-32 w-32 object-cover rounded mb-2">
            @endif
            
            <label for="main_image" class="block text-gray-700 text-sm font-bold mb-2 mt-4">Ganti Gambar Utama (Opsional)</label>
            <input type="file" name="main_image" id="main_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('main_image') border-red-500 @enderror">
            @error('main_image') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>


        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-700">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.portfolio.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.organizations.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h2 class="text-3xl font-bold">Tambah Data Organisasi</h2>
    </div>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.organizations.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Kolom Organization Name --}}
            <div class="mb-4">
                <label for="organization_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Organisasi *</label>
                <input type="text" name="organization_name" id="organization_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('organization_name') border-red-500 @enderror" value="{{ old('organization_name') }}" placeholder="Contoh: Himpunan Mahasiswa Informatika" required>
                @error('organization_name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kolom Position --}}
            <div class="mb-4">
                <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Jabatan/Posisi</label>
                <input type="text" name="position" id="position" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('position') border-red-500 @enderror" value="{{ old('position') }}" placeholder="Contoh: Ketua Umum">
                @error('position')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kolom Website --}}
            <div class="mb-4">
                <label for="website" class="block text-gray-700 text-sm font-bold mb-2">Website Organisasi</label>
                <input type="url" name="website" id="website" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('website') border-red-500 @enderror" value="{{ old('website') }}" placeholder="https://organisasi.ac.id">
                @error('website')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kolom Urutan --}}
            <div class="mb-4">
                <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Urutan Tampilan</label>
                <input type="number" name="order" id="order" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('order') border-red-500 @enderror" value="{{ old('order', 0) }}" placeholder="Angka kecil akan tampil duluan">
                @error('order')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kolom Start Date --}}
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai *</label>
                <input type="date" name="start_date" id="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('start_date') border-red-500 @enderror" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kolom End Date --}}
            <div class="mb-4">
                <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('end_date') border-red-500 @enderror" value="{{ old('end_date') }}">
                <p class="text-gray-500 text-xs mt-1">Kosongkan jika masih berlangsung</p>
                @error('end_date')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Checkbox Sedang Berlangsung --}}
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_current" id="is_current" value="1" {{ old('is_current') ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm font-bold">Sedang Berlangsung (Saat ini masih menjalani)</span>
            </label>
        </div>

        {{-- Kolom Logo --}}
        <div class="mb-4">
            <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logo Organisasi</label>
            <input type="file" name="logo" id="logo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('logo') border-red-500 @enderror" accept="image/*">
            <p class="text-gray-500 text-xs mt-1">Format: JPG, PNG, GIF, SVG. Maks: 2MB</p>
            @error('logo')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kolom Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" placeholder="Deskripsi tugas dan tanggung jawab">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-start mt-6">
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-700">
                Simpan Data
            </button>
            <a href="{{ route('admin.organizations.index') }}" class="ml-4 bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection


@extends('layouts.app') 

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Tambah Testimoni Baru</h2>
    
    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="client_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Klien</label>
            <input type="text" name="client_name" id="client_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('client_name') border-red-500 @enderror" value="{{ old('client_name') }}" required>
            @error('client_name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="client_title" class="block text-gray-700 text-sm font-bold mb-2">Jabatan Klien (Contoh: Designer)</label>
            <input type="text" name="client_title" id="client_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('client_title') border-red-500 @enderror" value="{{ old('client_title') }}" required>
            @error('client_title')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Isi Testimoni</label>
            <textarea name="content" id="content" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror" required>{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-green-700">
                Simpan Testimoni
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
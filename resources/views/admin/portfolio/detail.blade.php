{{-- resources/views/portfolio/detail.blade.php --}}
@extends('layouts.app')

@section('title', $item->title . ' Review')

@section('content')
    <div class="container mx-auto px-6 py-16">
        <h1 class="text-4xl font-bold text-teal-600 mb-4">{{ $item->title }}</h1>
        
        <div class="mb-8 p-4 bg-gray-50 rounded-lg shadow-sm">
            <p><strong>Kategori:</strong> {{ $item->category }}</p>
            <p><strong>Klien:</strong> {{ $item->client_name ?? '-' }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $item->project_date ? \Carbon\Carbon::parse($item->project_date)->format('F Y') : '-' }}</p>
            @if ($item->project_url)
                <p><strong>Lihat Demo:</strong> <a href="{{ $item->project_url }}" target="_blank" class="text-blue-500 hover:underline">Kunjungi Situs &rarr;</a></p>
            @endif
        </div>

        {{-- Gambar Utama --}}
        <img src="{{ asset('storage/' . $item->main_image_path) }}" alt="{{ $item->title }}" class="w-full h-auto rounded-lg mb-1 shadow-xl">

        {{-- Deskripsi Detail (Review) --}}
        <h2 class="text-3xl font-semibold mb-4 border-b pb-2">Deskripsi Detail Proyek</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            {!! nl2br(e($item->description_detail)) !!} 
        </div>
        
        <div class="mt-12 text-center">
            <a href="{{ route('portfolio') }}" class="text-teal-600 font-semibold hover:underline">&larr; Kembali ke Portofolio</a>
        </div>
    </div>
@endsection
{{-- resources/views/portfolio/detail.blade.php --}}
@extends('layouts.app')

@section('title', ($item->title ?? 'Portfolio') . ' Review')

@section('content')
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-12 lg:py-16">

    {{-- Top Bar: Back + Title --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <a href="{{ route('portfolio') }}"
         class="inline-flex w-fit items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
        <span aria-hidden="true">←</span>
        Kembali ke Portofolio
      </a>

      <div class="text-left sm:text-right">
        <p class="text-xs font-semibold tracking-widest text-teal-600">PORTFOLIO DETAIL</p>
      </div>
    </div>

    {{-- Title --}}
    <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
      {{ $item->title }}
    </h1>
    <p class="mt-2 text-base text-gray-600">
      Detail informasi proyek, kategori, klien, tanggal, dan deskripsi lengkap.
    </p>

    {{-- Info Card --}}
    <div class="mt-8 rounded-2xl border border-gray-100 bg-gray-50 p-6 shadow-sm">
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div>
          <p class="text-xs font-semibold text-gray-500">Kategori</p>
          <p class="mt-1 font-semibold text-gray-900">{{ $item->category ?? '-' }}</p>
        </div>

        <div>
          <p class="text-xs font-semibold text-gray-500">Klien</p>
          <p class="mt-1 font-semibold text-gray-900">{{ $item->client_name ?? '-' }}</p>
        </div>

        <div>
          <p class="text-xs font-semibold text-gray-500">Tanggal Selesai</p>
          <p class="mt-1 font-semibold text-gray-900">
            {{ $item->project_date ? \Carbon\Carbon::parse($item->project_date)->format('F Y') : '-' }}
          </p>
        </div>

        <div>
          <p class="text-xs font-semibold text-gray-500">Demo / URL</p>
          @if (!empty($item->project_url))
            <a href="{{ $item->project_url }}"
               target="_blank"
               rel="noopener noreferrer"
               class="mt-1 inline-flex items-center gap-2 font-semibold text-teal-700 hover:underline">
              Kunjungi Situs
              <span aria-hidden="true">↗</span>
            </a>
          @else
            <p class="mt-1 font-semibold text-gray-900">-</p>
          @endif
        </div>
      </div>
    </div>

    {{-- Main Image --}}
    <div class="mt-8 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
      <img
        src="{{ asset('storage/' . $item->main_image_path) }}"
        alt="{{ $item->title }}"
        class="w-full object-cover"
      />
    </div>

    {{-- Description --}}
    <div class="mt-10">
      <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">
        Deskripsi Detail Proyek
      </h2>
      <p class="mt-2 text-gray-600">
        Penjelasan lengkap mengenai tujuan, proses, dan hasil dari proyek ini.
      </p>

      <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="prose max-w-none text-gray-700 leading-relaxed">
          @if (!empty($item->description_detail))
            {!! nl2br(e($item->description_detail)) !!}
          @else
            <p class="text-gray-500">Deskripsi detail belum tersedia.</p>
          @endif
        </div>
      </div>
    </div>

    {{-- Bottom Back --}}
    {{-- <div class="mt-12 text-center">
      <a href="{{ route('portfolio') }}"
         class="inline-flex items-center gap-2 font-semibold text-teal-700 hover:underline">
        <span aria-hidden="true">←</span> Kembali ke Portofolio
      </a>
    </div> --}}

  </div>
</section>
@endsection

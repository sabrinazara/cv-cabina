@extends('layouts.app') 
{{-- Layouts/app.blade.php yang digunakan di sini adalah layout frontend --}}

@section('title', 'Testimony Client')

@section('content')

{{-- HEADER --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16 lg:py-20 text-center">
    <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
      Testimony <span class="text-teal-600">Client</span>
    </h2>
    <p class="mt-3 text-base leading-relaxed text-gray-600">
      Simak apa kata klien setelah bekerja sama.
    </p>
  </div>
</section>

{{-- TESTIMONIAL GRID --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-16">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
      @forelse ($testimonials as $testimonial)
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          
          {{-- Avatar + Nama --}}
          <div class="flex items-center gap-4">
            <div class="flex h-14 w-14 items-center justify-center overflow-hidden rounded-full bg-gray-100 ring-1 ring-gray-200">
              <i class="fas fa-user-circle text-4xl text-gray-400"></i>
            </div>
            <div class="text-left">
              <div class="font-bold text-gray-900">{{ $testimonial->client_name }}</div>
              <div class="text-sm font-medium text-teal-600">{{ $testimonial->client_title }}</div>
            </div>
          </div>

          {{-- Content --}}
          <p class="mt-5 text-sm italic leading-relaxed text-gray-700">
            “{{ $testimonial->content }}”
            {{-- Kalau mau lebih rapi (opsional), ganti jadi:
            “{{ Str::limit($testimonial->content, 180) }}”
            --}}
          </p>

        </div>
      @empty
        <p class="md:col-span-3 text-center text-gray-500">
          Belum ada testimoni yang ditambahkan. Silakan isi melalui CMS.
        </p>
      @endforelse
    </div>
  </div>
</section>

@endsection

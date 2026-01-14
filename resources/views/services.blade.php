@extends('layouts.app')

@section('title', 'Our Services')

@section('content')

{{-- HEADER --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16 lg:py-20 text-center">
    <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
      My <span class="text-teal-600">Services</span>
    </h2>
    <p class="mt-4 text-base leading-relaxed text-gray-600">
      Layanan yang saya sediakan untuk membantu kebutuhan pengembangan dan desain produk digital.
    </p>
  </div>
</section>

{{-- SERVICE LIST --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-16">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
      @forelse ($services as $service)
        <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          
          <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-700 transition group-hover:bg-teal-100">
            <i class="{{ $service->icon ?? 'fas fa-cogs' }} text-2xl"></i>
          </div>

          <h4 class="text-xl font-semibold text-gray-900">
            {{ $service->title }}
          </h4>

          <p class="mt-2 text-sm leading-relaxed text-gray-600">
            {{ $service->description }}
          </p>

        </div>
      @empty
        <p class="md:col-span-3 text-center text-gray-500">
          Belum ada layanan yang ditambahkan. Silakan isi melalui CMS.
        </p>
      @endforelse
    </div>
  </div>
</section>

{{-- TESTIMONIAL --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16 text-center">
    
    <div class="mx-auto max-w-3xl">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">TESTIMONIAL</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Simak Apa Kata Klien</h2>
      <p class="mt-3 text-gray-600">
        Ulasan singkat dari klien yang pernah bekerja sama.
      </p>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
      @forelse ($testimonials as $testimonial)
        <div class="rounded-2xl border border-gray-100 bg-white p-6 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          <p class="text-sm italic leading-relaxed text-gray-700">
            “{{ Str::limit($testimonial->content, 150) }}”
          </p>

          <div class="mt-5 border-t border-gray-100 pt-4">
            <div class="font-bold text-gray-900">{{ $testimonial->client_name }}</div>
            <div class="text-sm text-teal-600">{{ $testimonial->client_title }}</div>
          </div>
        </div>
      @empty
        <p class="md:col-span-3 text-center text-gray-500">Belum ada testimoni yang ditambahkan.</p>
      @endforelse
    </div>

  </div>
</section>

@endsection

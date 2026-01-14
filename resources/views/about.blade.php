@extends('layouts.app') 
{{-- Layouts/app.blade.php yang digunakan di sini adalah layout frontend --}}

@section('title', 'About Us - Our Story')

@section('content')

{{-- OUR STORY --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16 lg:py-20">
    
    {{-- Header --}}
    <div class="mx-auto max-w-3xl text-center">
      <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
        My <span class="text-teal-600">Story</span>
      </h2>
      <p class="mt-4 text-base leading-relaxed text-gray-600">
        Mengenal lebih dekat perjalanan, pengalaman, dan bidang yang saya tekuni.
      </p>
    </div>

    {{-- Content --}}
    <div class="mt-12 grid items-start gap-10 lg:grid-cols-12">
      
      {{-- Foto --}}
      <div class="lg:col-span-4 flex justify-center lg:justify-start">
        @if ($profile->photo ?? null)
          <img
            src="{{ asset('storage/' . $profile->photo) }}"
            alt="{{ $profile->name ?? 'Profile Photo' }}"
            class="w-72 rounded-2xl object-cover shadow-xl ring-1 ring-gray-200 transition duration-300 hover:scale-[1.02]"
          />
        @else
          <div class="flex h-72 w-72 items-center justify-center rounded-2xl bg-gray-100 text-gray-500 shadow-inner ring-1 ring-gray-200">
            <span class="text-sm">Foto belum tersedia</span>
          </div>
        @endif
      </div>

      {{-- Deskripsi --}}
      <div class="lg:col-span-8">
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
          <h3 class="text-xl font-semibold text-gray-900">
            {{ $profile->name ?? 'Tentang Saya' }}
          </h3>
          <p class="mt-4 text-base leading-relaxed text-gray-700">
            {{ $profile->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
          </p>

          {{-- Jika nanti ada field tambahan (misal long_description), tinggal aktifkan ini --}}
          {{-- 
          @if(!empty($profile->long_description))
            <p class="mt-4 text-base leading-relaxed text-gray-700">
              {{ $profile->long_description }}
            </p>
          @endif 
          --}}
        </div>
      </div>

    </div>
  </div>
</section>


{{-- ORGANIZATIONS --}}
@if($organizations->count() > 0)
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16">
    
    <div class="mx-auto max-w-3xl text-center">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">ORGANIZATIONS</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Organisasi & Komunitas</h2>
      <p class="mt-3 text-gray-600">
        Komunitas dan organisasi yang saya ikuti untuk terus berkembang.
      </p>
    </div>

    <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
      @foreach($organizations as $org)
        <div class="group rounded-2xl border border-gray-100 bg-white p-6 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          
          <div class="flex items-start gap-4">
            {{-- Logo --}}
            @if($org->logo_url)
              <img 
                src="{{ $org->logo_url }}" 
                alt="{{ $org->organization_name }}" 
                class="h-14 w-14 rounded-xl object-cover shadow-sm"
              />
            @else
              <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-teal-50 text-teal-600 shadow-sm">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
              </div>
            @endif

            <div class="flex-1 min-w-0">
              <h4 class="text-lg font-bold text-gray-900 truncate">
                {{ $org->organization_name }}
              </h4>
              
              @if($org->position)
                <p class="mt-1 text-sm text-teal-600 font-medium">
                  {{ $org->position }}
                </p>
              @endif

              {{-- Date Range --}}
              <p class="mt-2 text-xs text-gray-500">
                {{ $org->date_range }}
              </p>
            </div>
          </div>

          {{-- Description --}}
          @if($org->description)
            <p class="mt-4 text-sm text-gray-600 leading-relaxed line-clamp-3">
              {{ $org->description }}
            </p>
          @endif

          {{-- Website Link --}}
          @if($org->website)
            <a href="{{ $org->website }}" target="_blank" class="mt-4 inline-flex items-center text-sm text-teal-600 hover:text-teal-700 font-medium">
              Kunjungi Website
              <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
              </svg>
            </a>
          @endif

          {{-- Current Badge --}}
          @if($org->is_current)
            <span class="mt-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              Sedang Berlangsung
            </span>
          @endif
        </div>
      @endforeach
    </div>

  </div>
</section>
@endif


{{-- TESTIMONIAL --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-16">
    
    <div class="mx-auto max-w-3xl text-center">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">TESTIMONIAL</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Simak Apa Kata Klien</h2>
      <p class="mt-3 text-gray-600">
        Beberapa ulasan singkat dari klien yang pernah bekerja sama.
      </p>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
      @forelse ($testimonials as $testimonial)
        <div class="rounded-2xl border border-gray-100 bg-white p-6 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          <p class="text-sm italic leading-relaxed text-gray-700">
            "{{ Str::limit($testimonial->content, 150) }}"
          </p>

          <div class="mt-5 border-t border-gray-100 pt-4">
            <div class="font-bold text-gray-900">
              {{ $testimonial->client_name }}
            </div>
            <div class="text-sm text-teal-600">
              {{ $testimonial->client_title }}
            </div>
          </div>
        </div>
      @empty
        <p class="md:col-span-3 text-center text-gray-500">
          Belum ada testimoni yang ditambahkan.
        </p>
      @endforelse
    </div>

  </div>
</section>

@endsection


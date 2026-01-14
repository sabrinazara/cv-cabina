@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16 lg:py-20">
    <div class="grid items-center gap-10 lg:grid-cols-2">

      {{-- Left --}}
      <div class="text-center lg:text-left">
        <p class="inline-flex items-center gap-2 rounded-full bg-teal-50 px-4 py-2 text-sm font-medium text-teal-700">
          👋 Welcome all
        </p>

        <h1 class="mt-5 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
          {{ $profile->name ?? 'Sabrina Az Zahra' }},
          <span class="text-teal-600" id="typing-text"></span>
        </h1>

        <p class="mt-5 max-w-xl text-base leading-relaxed text-gray-600 lg:max-w-none">
          {{ $profile->description ?? 'Deskripsi default tentang diri Anda.' }}
        </p>

        <div class="mt-8 flex flex-col items-center gap-3 sm:flex-row sm:justify-center lg:justify-start">
          <a href="{{ route('about') }}"
             class="inline-flex items-center justify-center rounded-full bg-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
            Read More
          </a>
          <a href="#skills"
             class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
            See Skills
          </a>
        </div>
      </div>

      {{-- Right --}}
      <div class="relative mx-auto w-full max-w-md">
        {{-- Decorative blobs (Tailwind-only) --}}
        <div class="pointer-events-none absolute -inset-10 -z-10">
          <div class="absolute left-1/2 top-1/2 h-72 w-72 -translate-x-1/2 -translate-y-1/2 rounded-full bg-teal-200/40 blur-2xl"></div>
          <div class="absolute left-1/2 top-1/2 h-52 w-52 -translate-x-1/2 -translate-y-1/2 rounded-full bg-teal-400/20 blur-2xl"></div>
        </div>

        @if ($profile->photo ?? null)
          <img
            src="{{ asset('storage/' . $profile->photo) }}"
            alt="{{ $profile->name }}"
            class="mx-auto h-auto w-72 rounded-2xl object-cover shadow-xl ring-1 ring-gray-200 transition duration-300 hover:scale-[1.02]"
          />
        @else
          <div class="mx-auto flex h-72 w-72 items-center justify-center rounded-2xl bg-gray-100 text-gray-500 shadow-inner ring-1 ring-gray-200">
            <i class="fas fa-user-circle text-6xl"></i>
          </div>
        @endif
      </div>

    </div>
  </div>
</section>


{{-- SKILLS --}}
<section id="skills" class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16">
    <div class="mx-auto max-w-2xl text-center">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">SKILLS</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Keahlian yang Saya Miliki</h2>
      <p class="mt-3 text-gray-600">
        Daftar skill yang pernah saya pelajari dan gunakan dalam project.
      </p>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
      @forelse ($skills as $skill)

        @php
          // Pastikan ini sesuai field UAS: kategori_npm
          $cat = $skill->kategori_npm ?? $skill->kategori ?? 'Lainnya';

          // Mapping warna badge (Tailwind)
          $badge = match($cat) {
            'Programming Language' => 'bg-emerald-100 text-emerald-800 ring-emerald-200',
            'Web Development' => 'bg-blue-100 text-blue-800 ring-blue-200',
            'Mobile Development' => 'bg-orange-100 text-orange-800 ring-orange-200',
            'Database' => 'bg-purple-100 text-purple-800 ring-purple-200',
            'UI/UX Design' => 'bg-pink-100 text-pink-800 ring-pink-200',
            'Desain Grafis dan Multimedia' => 'bg-rose-100 text-rose-800 ring-rose-200',
            'Jaringan' => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
            'Data Analis' => 'bg-slate-100 text-slate-800 ring-slate-200',
            default => 'bg-gray-100 text-gray-800 ring-gray-200',
          };
        @endphp

        <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $badge }}">
            {{ $cat }}
          </span>

          <h4 class="mt-3 text-lg font-semibold text-gray-900">
            {{ $skill->nama ?? $skill->nama_keahlian ?? 'Nama Skill' }}
          </h4>

          <div class="mt-4">
            <div class="h-2.5 w-full rounded-full bg-gray-100">
              <div class="h-2.5 rounded-full bg-teal-600"
                   style="width: {{ $skill->level ?? 0 }}%"></div>
            </div>
            <div class="mt-2 text-xs text-gray-500">
              Level: <span class="font-semibold text-gray-700">{{ $skill->level ?? 0 }}%</span>
            </div>
          </div>
        </div>

      @empty
        <p class="col-span-full text-center text-gray-500">Belum ada keahlian yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>


{{-- SERVICES --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-16">
    <div class="mx-auto max-w-2xl text-center">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">SERVICES</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Yang Saya Kerjakan</h2>
      <p class="mt-3 text-gray-600">Beberapa layanan / bidang yang sering saya tangani.</p>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
      @forelse ($services as $service)
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-700">
            <i class="{{ $service->icon ?? 'fas fa-wrench' }} text-2xl"></i>
          </div>
          <h4 class="text-xl font-semibold text-gray-900">{{ $service->title }}</h4>
          <p class="mt-2 text-sm leading-relaxed text-gray-600">{{ Str::limit($service->description, 110) }}</p>
        </div>
      @empty
        <p class="md:col-span-3 text-center text-gray-500">Belum ada layanan yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>


{{-- PORTFOLIO --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-16 text-center">
    <div class="mx-auto max-w-2xl">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">PORTOFOLIO</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Project Saya</h2>
      <p class="mt-3 text-gray-600">Kumpulan project yang pernah saya kerjakan.</p>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse ($items as $item)
        <a href="{{ route('portfolio.show', $item->slug) }}"
           class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition hover:shadow-lg">
          <img src="{{ asset('storage/' . $item->main_image_path) }}"
               alt="{{ $item->title }}"
               class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">

          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 transition group-hover:opacity-100"></div>

          <div class="absolute bottom-0 left-0 right-0 p-5 text-left opacity-0 transition group-hover:opacity-100">
            <h4 class="text-lg font-bold text-white">{{ $item->title }}</h4>
            <p class="mt-1 text-sm text-white/80">Klik untuk melihat detail</p>
          </div>
        </a>
      @empty
        <p class="lg:col-span-3 text-center text-gray-500">Belum ada proyek yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>


{{-- TESTIMONIAL --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-16 text-center">
    <div class="mx-auto max-w-2xl">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">TESTIMONIAL</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Simak Apa Kata Klien</h2>
      <p class="mt-3 text-gray-600">Ulasan singkat dari klien yang pernah bekerja sama.</p>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
      @forelse ($testimonials->take(3) as $testimonial)
        <div class="rounded-2xl border border-gray-100 bg-white p-6 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          <p class="text-sm italic leading-relaxed text-gray-700">
            “{{ Str::limit($testimonial->content, 140) }}”
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


@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const textElement = document.getElementById('typing-text');
    const dataText = @json($profile->title ?? '3D Game Unity');

    let charIndex = 0;
    let isDeleting = false;
    let speed = 110;

    function type() {
      const current = dataText;

      if (isDeleting) {
        textElement.textContent = current.substring(0, charIndex - 1);
        charIndex--;
        speed = 60;
      } else {
        textElement.textContent = current.substring(0, charIndex + 1);
        charIndex++;
        speed = 110;
      }

      if (!isDeleting && charIndex === current.length) {
        speed = 1500;
        isDeleting = true;
      } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        speed = 400;
      }

      setTimeout(type, speed);
    }
    type();
  });
</script>
@endpush

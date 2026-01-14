@extends('layouts.app') 
{{-- Asumsi 'layouts.app' adalah layout yang berisi navigasi admin --}}

@section('content')
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-10">

    {{-- Header --}}
    <div class="mb-8">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900">
        Selamat Datang di Dashboard Admin
      </h2>
      <p class="mt-2 text-base leading-relaxed text-gray-600">
        Gunakan menu navigasi atau kartu di bawah ini untuk mengelola konten portofolio Anda.
      </p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
      <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-800 shadow-sm">
        <div class="flex items-start gap-3">
          <div class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100">
            <span class="text-green-700">✓</span>
          </div>
          <div>
            <p class="font-semibold">Berhasil</p>
            <p class="text-sm text-green-800">{{ session('success') }}</p>
          </div>
        </div>
      </div>
    @endif

    {{-- Cards --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">

      {{-- Card 1: Portfolio Items --}}
      <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <h4 class="text-lg font-semibold text-teal-700">Proyek Portofolio</h4>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
          Kelola item portofolio, detail review, dan gambar utamanya.
        </p>
        <a href="{{ route('admin.portfolio.index') }}"
           class="mt-4 inline-flex items-center gap-2 rounded-full bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
          Lihat Semua <span aria-hidden="true">→</span>
        </a>
      </div>

      {{-- Card 2: Services --}}
      <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <h4 class="text-lg font-semibold text-teal-700">Layanan</h4>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
          Tambah, edit, atau hapus layanan yang Anda tawarkan.
        </p>
        <a href="{{ route('admin.services.index') }}"
           class="mt-4 inline-flex items-center gap-2 rounded-full bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
          Lihat Semua <span aria-hidden="true">→</span>
        </a>
      </div>

      {{-- Card 3: Testimonials --}}
      <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <h4 class="text-lg font-semibold text-teal-700">Testimoni Klien</h4>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
          Kelola testimoni yang muncul di halaman utama dan halaman Testimonial.
        </p>
        <a href="{{ route('admin.testimonials.index') }}"
           class="mt-4 inline-flex items-center gap-2 rounded-full bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
          Lihat Semua <span aria-hidden="true">→</span>
        </a>
      </div>

      {{-- Card 4: Skills --}}
      <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <h4 class="text-lg font-semibold text-teal-700">Keahlian</h4>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
          Kelola keahlian berdasarkan kategori dan level kemampuan.
        </p>
        <a href="{{ route('admin.skills.index') }}"
           class="mt-4 inline-flex items-center gap-2 rounded-full bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
          Lihat Semua <span aria-hidden="true">→</span>
        </a>
      </div>

      {{-- Card 5: Education --}}
      {{-- <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <h4 class="text-lg font-semibold text-teal-700">Riwayat Pendidikan</h4>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
          Kelola data pendidikan dan riwayat akademik Anda.
        </p>
        <a href="{{ route('admin.education.index') }}"
           class="mt-4 inline-flex items-center gap-2 rounded-full bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
          Lihat Semua <span aria-hidden="true">→</span>
        </a>
      </div> --}}

      {{-- Card 6: Organizations --}}
      <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <h4 class="text-lg font-semibold text-teal-700">Organisasi</h4>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
          Kelola data organisasi dan komunitas yang Anda ikuti.
        </p>
        <a href="{{ route('admin.organizations.index') }}"
           class="mt-4 inline-flex items-center gap-2 rounded-full bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
          Lihat Semua <span aria-hidden="true">→</span>
        </a>
      </div>

      {{-- Card 7: Profile Settings --}}
      <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <h4 class="text-lg font-semibold text-teal-700">Pengaturan Profil</h4>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
          Perbarui data diri, foto profil, dan link CV Anda.
        </p>
        <a href="{{ route('admin.profile.edit') }}"
           class="mt-4 inline-flex items-center gap-2 rounded-full bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
          Edit Profil <span aria-hidden="true">→</span>
        </a>
      </div>

    </div>
  </div>
</section>
@endsection

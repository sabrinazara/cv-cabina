@extends('layouts.app') 
{{-- Layouts/app.blade.php yang digunakan di sini adalah layout frontend --}}

@section('title', 'Our Portfolio')

@section('content')

{{-- HEADER --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16 lg:py-20 text-center">
    <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
      My <span class="text-teal-600">Portfolio</span>
    </h2>
    <p class="mt-3 text-base leading-relaxed text-gray-600">
      Lihat semua hasil karya saya berdasarkan kategori yang tersedia.
    </p>
  </div>
</section>

{{-- FILTER + GRID --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-10">

    {{-- FILTER BUTTONS --}}
    <div class="flex flex-wrap items-center justify-center gap-3">
      <button
        type="button"
        data-filter="all"
        class="filter-btn rounded-full bg-teal-600 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700"
      >
        ALL
      </button>

      @foreach ($categories as $category)
        <button
          type="button"
          data-filter="{{ Str::slug($category) }}"
          class="filter-btn rounded-full bg-white px-5 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-200 transition hover:bg-gray-100"
        >
          {{ strtoupper($category) }}
        </button>
      @endforeach
    </div>

    {{-- GRID --}}
    <div id="portfolio-grid" class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse ($items as $item)
        <a
          href="{{ route('portfolio.show', $item->slug) }}"
          class="portfolio-item group block overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
          data-category="{{ Str::slug($item->category) }}"
        >
          {{-- IMAGE --}}
          <div class="relative overflow-hidden">
            <img
              src="{{ asset('storage/' . $item->main_image_path) }}"
              alt="{{ $item->title }}"
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105"
            />

            {{-- optional overlay hover (biar lebih modern) --}}
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-transparent opacity-0 transition group-hover:opacity-100"></div>
            <div class="pointer-events-none absolute bottom-0 left-0 right-0 p-5 opacity-0 transition group-hover:opacity-100">
              <div class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white backdrop-blur">
                {{ $item->category }}
              </div>
            </div>
          </div>

          {{-- CONTENT --}}
          <div class="p-5 text-left">
            <h4 class="text-lg font-semibold text-gray-900">
              {{ $item->title }}
            </h4>
            <p class="mt-1 text-sm font-medium text-teal-600">
              {{ $item->category }}
            </p>
            <p class="mt-2 text-sm leading-relaxed text-gray-600">
              {{ Str::limit($item->description_short, 80) }}
            </p>
          </div>
        </a>
      @empty
        <p class="lg:col-span-3 text-center text-gray-500">
          Belum ada proyek yang ditambahkan. Silakan isi melalui CMS.
        </p>
      @endforelse
    </div>

  </div>
</section>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    function setActiveButton(activeBtn) {
      filterButtons.forEach(btn => {
        // default (inactive)
        btn.classList.remove('bg-teal-600', 'text-white', 'shadow-sm');
        btn.classList.add('bg-white', 'text-gray-700', 'ring-1', 'ring-gray-200');
      });

      // active
      activeBtn.classList.add('bg-teal-600', 'text-white', 'shadow-sm');
      activeBtn.classList.remove('bg-white', 'text-gray-700', 'ring-1', 'ring-gray-200');
    }

    function applyFilter(filterValue) {
      portfolioItems.forEach(item => {
        const category = item.getAttribute('data-category');
        item.style.display = (filterValue === 'all' || category === filterValue) ? 'block' : 'none';
      });
    }

    // Init: set ALL active + show all
    const allBtn = document.querySelector('[data-filter="all"]');
    if (allBtn) {
      setActiveButton(allBtn);
      applyFilter('all');
    }

    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        const filterValue = this.getAttribute('data-filter');
        setActiveButton(this);
        applyFilter(filterValue);
      });
    });
  });
</script>
@endpush

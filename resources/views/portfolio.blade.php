@extends('layouts.app') 
{{-- Layouts/app.blade.php yang digunakan di sini adalah layout frontend --}}

@section('title', 'Our Portfolio')

@section('content')

    {{-- Header Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-2">My <span class="text-teal-600">Portfolio</span></h2>
            <p class="text-gray-600">Lihat Semua Hasil Karya Saya</p>
        </div>
    </section>
    
    {{-- Filtering Buttons (Gunakan JavaScript untuk fungsionalitas filter) --}}
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            {{-- Tombol Filter (TIDAK BERUBAH) --}}
            <div class="flex flex-wrap justify-center space-x-4 mb-8">
                <button data-filter="all" class="filter-btn bg-teal-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-teal-700 transition">ALL</button>
                @foreach ($categories as $category)
                    <button data-filter="{{ Str::slug($category) }}" class="filter-btn text-gray-600 bg-white border border-gray-300 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        {{ strtoupper($category) }}
                    </button>
                @endforeach
            </div>

            {{-- Grid Portofolio (KONTEN UTAMA YANG BERUBAH) --}}
            <div id="portfolio-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($items as $item) {{-- Pastikan nama variabelnya adalah $items, bukan $projects, sesuai PortfolioItemController --}}
                    {{-- BUNGKUS DENGAN LINK A HREF --}}
                    <a href="{{ route('portfolio.show', $item->slug) }}" 
                    class="portfolio-item rounded-lg shadow-lg overflow-hidden group transition duration-300 transform hover:scale-[1.02] block" 
                    data-category="{{ Str::slug($item->category) }}">
                        
                        {{-- Gambar Proyek --}}
                        <img src="{{ asset('storage/' . $item->main_image_path) }}" alt="{{ $item->title }}" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
                        
                        {{-- Keterangan di Bawah Gambar --}}
                        <div class="p-4 bg-white text-left">
                            <h4 class="text-xl font-semibold text-gray-800">{{ $item->title }}</h4>
                            <p class="text-sm text-teal-600">{{ $item->category }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->description_short, 60) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="md:col-span-3 text-gray-500">Belum ada proyek yang ditambahkan. Silakan isi melalui CMS.</p>
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

        // --- FUNGSI INIALISASI (BARU) ---
        function initializeFilter() {
            const allButton = document.querySelector('[data-filter="all"]');
            
            // Atur styling tombol 'ALL' aktif saat dimuat
            allButton.classList.add('bg-teal-600', 'text-white');
            allButton.classList.remove('text-gray-600', 'bg-white', 'border', 'border-gray-300');
            
            // Pastikan semua item terlihat saat dimuat (initial state)
            portfolioItems.forEach(item => {
                item.style.display = 'block';
            });
        }
        
        // Jalankan inisialisasi saat DOM siap
        initializeFilter();
        // ------------------------------------

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Hapus styling aktif dari semua tombol
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-teal-600', 'text-white');
                    btn.classList.add('text-gray-600', 'bg-white', 'border', 'border-gray-300');
                });
                
                // Tambahkan styling aktif ke tombol yang diklik
                this.classList.add('bg-teal-600', 'text-white');
                this.classList.remove('text-gray-600', 'bg-white', 'border', 'border-gray-300');


                const filterValue = this.getAttribute('data-filter');

                portfolioItems.forEach(item => {
                    // Sembunyikan semua item
                    item.style.display = 'none';

                    // Tampilkan item yang sesuai
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                    }
                });
            });
        });
        
    });
</script>
@endpush
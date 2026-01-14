@extends('layouts.app') 

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.skills.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h2 class="text-3xl font-bold text-gray-800">Edit Keahlian: {{ $skill->nama }}</h2>
    </div>
    
    <div class="bg-white shadow-lg rounded-lg">
        <div class="p-6">
            <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Keahlian -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Keahlian <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" 
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg p-3 border @error('nama') border-red-500 @enderror"
                        value="{{ old('nama', $skill->nama) }}" 
                        placeholder="Contoh: PHP, JavaScript, Laravel, dll."
                        required>
                    @error('nama')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" id="kategori" 
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg p-3 border @error('kategori') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori }}" {{ old('kategori', $skill->kategori) == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Level -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-2">
                        Level Keahlian (0-100%)
                    </label>
                    <div class="flex items-center gap-4">
                        <input type="range" name="level" id="level" min="0" max="100" value="{{ old('level', $skill->level) }}" 
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                        <span id="level-value" class="text-sm font-medium text-gray-700 min-w-[60px] text-center">{{ old('level', $skill->level) }}%</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Geser slider untuk menentukan tingkat keahlian</p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Keahlian
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg p-3 border @error('deskripsi') border-red-500 @enderror"
                        placeholder="Jelaskan keahlian ini...">{{ old('deskripsi', $skill->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('admin.skills.index') }}" 
                        class="bg-gray-300 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-400 transition duration-200 font-medium">
                        Batal
                    </a>
                    <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition duration-200 font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Update level value when slider changes
    document.getElementById('level').addEventListener('input', function(e) {
        document.getElementById('level-value').textContent = e.target.value + '%';
    });
</script>
@endpush
@endsection


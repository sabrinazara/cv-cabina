<?php
// database/migrations/*_create_portfolio_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Proyek
            $table->string('slug')->unique(); // Slug untuk URL Detail (review)
            $table->string('category'); // Kategori (misalnya: 3D Game, Web Dev)
            $table->text('description_short'); // Deskripsi Singkat untuk Halaman Index
            $table->longText('description_detail'); // Deskripsi Lengkap untuk Halaman Detail
            $table->string('main_image_path'); // Path Gambar Utama
            $table->json('gallery_images')->nullable(); // Path Gambar Galeri (JSON Array)
            $table->string('client_name')->nullable(); // Nama Klien
            $table->string('project_date')->nullable(); // Tanggal Selesai Proyek
            $table->string('project_url')->nullable(); // Link Live Demo (opsional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};

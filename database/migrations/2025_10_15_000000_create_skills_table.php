<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama keahlian
            $table->enum('kategori', [
                'Programming Language',
                'Web Development',
                'Mobile Development',
                'Database',
                'UI/UX Design',
                'Desain Grafis dan Multimedia',
                'Jaringan',
                'Data Analis'
            ]); // Kategori keahlian
            $table->integer('level')->default(50); // Level keahlian (0-100)
            $table->text('deskripsi')->nullable(); // Deskripsi keahlian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};


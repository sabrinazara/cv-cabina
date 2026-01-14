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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name'); // Nama organisasi/komunitas
            $table->string('position')->nullable(); // Jabatan/posisi
            $table->date('start_date'); // Tanggal mulai
            $table->date('end_date')->nullable(); // Tanggal selesai (nullable jika masih berlangsung)
            $table->text('description')->nullable(); // Deskripsi tugas dan tanggung jawab
            $table->boolean('is_current')->default(false); // Apakah sedang berlangsung
            $table->string('logo')->nullable(); // Path logo organisasi
            $table->string('website')->nullable(); // Link website organisasi
            $table->integer('order')->default(0); // Untuk urutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};


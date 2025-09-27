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
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Andreas David
            $table->string('title'); // Contoh: WordPress Developer
            $table->text('description')->nullable(); // Deskripsi di halaman About/Home
            $table->string('cv_link')->nullable(); // Link untuk tombol Download CV
            $table->string('photo')->nullable(); // Path foto profil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
    }
};

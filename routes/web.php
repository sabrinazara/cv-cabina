<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Frontend\PortfolioItemController;

/*
|--------------------------------------------------------------------------
| Public Routes (Frontend)
|--------------------------------------------------------------------------
| Rute untuk semua halaman yang dapat diakses publik
*/

// Halaman utama dan navigasi standar
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/testimonial', [FrontendController::class, 'testimonial'])->name('testimonial');

// Rute PORTFOLIO BARU (Menggantikan baris lama)
Route::get('/portfolio', [PortfolioItemController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioItemController::class, 'show'])->name('portfolio.show'); 


/*
|--------------------------------------------------------------------------
| Admin Routes (CMS/Backend)
|--------------------------------------------------------------------------
| Rute ini dilindungi oleh middleware 'auth' agar hanya user yang login yang bisa mengakses
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Gunakan view dashboard untuk admin
    })->name('dashboard');

    // CRUD Resource Routes Standar
    Route::resource('services', Admin\ServiceController::class);
    Route::resource('projects', Admin\ProjectController::class);
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::resource('skills', Admin\SkillController::class); // CRUD Keahlian

    // CRUD Resource Portofolio Item
    Route::resource('portfolio', PortfolioController::class); // admin/portfolio, admin/portfolio/create, dll.

    // CRUD Resource Organisasi
    Route::resource('organizations', Admin\OrganizationController::class);

    // Rute Khusus untuk Profile Setting
    Route::get('profile', [Admin\AdminController::class, 'profileEdit'])->name('profile.edit');
    Route::put('profile', [Admin\AdminController::class, 'profileUpdate'])->name('profile.update');
});


/*
|--------------------------------------------------------------------------
| Default Laravel Breeze Authentication Routes
|--------------------------------------------------------------------------
| Menggunakan file rute terpisah dari Breeze
*/

require __DIR__.'/auth.php';
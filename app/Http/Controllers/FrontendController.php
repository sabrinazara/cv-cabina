<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileSetting;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\PortfolioItem;
use App\Models\Skill;

class FrontendController extends Controller
{
    /**
     * Menampilkan Halaman Beranda (home-12.png)
     */
    public function home()
    {
        // Data Profile (Andreas David, WordPress Developer)
        $profile = ProfileSetting::first() ?? new ProfileSetting(); // Ambil yang pertama, atau buat instance kosong jika tabel kosong

        // Data Layanan (Yang Saya Kerjakan)
        $services = Service::all();

        // Data Portofolio (Hanya 6 proyek terbaru)
        // $projects = Project::latest()->take(6)->get();

        // Data Testimonial (Simak Apa Kata Klien)
        $testimonials = Testimonial::all();

        $items = PortfolioItem::orderBy('project_date', 'desc')->take(6)->get();

        // Data Keahlian (Skills)
        $skills = Skill::all();

        return view('home', compact('profile', 'services', 'testimonials', 'items', 'skills'));
    }

    /**
     * Menampilkan Halaman Tentang Kami (about-1.png)
     */
    public function about()
    {
        // Data Profile (untuk bagian Our Story)
        $profile = ProfileSetting::first() ?? new ProfileSetting();

        // Data Testimonial (Simak Apa Kata Klien)
        $testimonials = Testimonial::all();

        return view('about', compact('profile', 'testimonials'));
    }

    /**
     * Menampilkan Halaman Layanan (services.png)
     */
    public function services()
    {
        // Data Layanan (Yang Saya Kerjakan)
        $services = Service::all();

        // Data Testimonial (Simak Apa Kata Klien)
        $testimonials = Testimonial::all();

        return view('services', compact('services', 'testimonials'));
    }

    /**
     * Menampilkan Halaman Portofolio (portofolio.png)
     */
    public function portfolio()
    {
        // Data semua Proyek Portofolio
        $projects = Project::orderBy('created_at', 'desc')->get();

        // Untuk daftar kategori unik (All, Theme Developer, Plugin Developer, dll.)
        $categories = Project::select('category')->distinct()->pluck('category');

        return view('portfolio', compact('projects', 'categories'));
    }

    /**
     * Menampilkan Halaman Testimonial (testimonial.png)
     */
    public function testimonial()
    {
        // Data semua Testimonial
        $testimonials = Testimonial::all();

        return view('testimonial', compact('testimonials'));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'kategori',
        'level',
        'deskripsi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'level' => 'integer',
    ];

    /**
     * Constants untuk kategori keahlian
     */
    public const KATEGORI = [
        'Programming Language',
        'Web Development',
        'Mobile Development',
        'Database',
        'UI/UX Design',
        'Desain Grafis dan Multimedia',
        'Jaringan',
        'Data Analis',
    ];

    /**
     * Get badge color berdasarkan kategori
     * Menggunakan Tailwind CSS classes
     */
    public function getBadgeColor(): string
    {
        return match($this->kategori) {
            'Programming Language' => 'bg-blue-100 text-blue-800',
            'Web Development' => 'bg-green-100 text-green-800',
            'Mobile Development' => 'bg-purple-100 text-purple-800',
            'Database' => 'bg-yellow-100 text-yellow-800',
            'UI/UX Design' => 'bg-pink-100 text-pink-800',
            'Desain Grafis dan Multimedia' => 'bg-orange-100 text-orange-800',
            'Jaringan' => 'bg-red-100 text-red-800',
            'Data Analis' => 'bg-indigo-100 text-indigo-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get list kategori untuk dropdown
     */
    public static function getKategoriList(): array
    {
        return self::KATEGORI;
    }
}


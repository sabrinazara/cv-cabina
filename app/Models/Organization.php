<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_name',
        'position',
        'start_date',
        'end_date',
        'description',
        'is_current',
        'logo',
        'website',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get formatted date range
     */
    public function getDateRangeAttribute(): string
    {
        $start = \Carbon\Carbon::parse($this->start_date)->format('M Y');
        
        if ($this->is_current) {
            return "$start - Sekarang";
        }
        
        $end = $this->end_date ? \Carbon\Carbon::parse($this->end_date)->format('M Y') : 'Sekarang';
        return "$start - $end";
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            return Storage::url($this->logo);
        }
        return null;
    }

    /**
     * Scope for ordering by order column
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('start_date', 'desc');
    }
}


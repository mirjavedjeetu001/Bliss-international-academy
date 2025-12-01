<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'detail',
        'images',
        'pdfs',
        'status',
        'slug'
    ];

    protected $casts = [
        'images' => 'array',
        'pdfs' => 'array',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope for active pages
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get formatted images array
     */
    public function getFormattedImagesAttribute()
    {
        if (!$this->images) return [];
        
        return array_map(function($image) {
            return [
                'name' => basename($image),
                'path' => $image,
                'url' => asset($image)
            ];
        }, $this->images);
    }

    /**
     * Get formatted PDFs array
     */
    public function getFormattedPdfsAttribute()
    {
        if (!$this->pdfs) return [];
        
        return array_map(function($pdf) {
            return [
                'name' => basename($pdf),
                'path' => $pdf,
                'url' => asset($pdf)
            ];
        }, $this->pdfs);
    }
}

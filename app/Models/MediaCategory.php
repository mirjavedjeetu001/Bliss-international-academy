<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MediaCategory extends Model
{
    protected $fillable = [
        'name',
        'image',
        'type',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get the photo galleries for the category
     */
    public function photoGalleries(): HasMany
    {
        return $this->hasMany(PhotoGallery::class);
    }

    /**
     * Get the video galleries for the category
     */
    public function videoGalleries(): HasMany
    {
        return $this->hasMany(VideoGallery::class);
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for photo categories
     */
    public function scopePhoto($query)
    {
        return $query->where('type', 'photo');
    }

    /**
     * Scope for video categories
     */
    public function scopeVideo($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Get the type badge color
     */
    public function getTypeBadgeColorAttribute()
    {
        return $this->type === 'photo' ? 'primary' : 'success';
    }

    /**
     * Get the status badge color
     */
    public function getStatusBadgeColorAttribute()
    {
        return $this->status === 'active' ? 'success' : 'secondary';
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('backend/assets/images/category/' . $this->image);
        }
        return null;
    }
}

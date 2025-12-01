<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoGallery extends Model
{
    protected $fillable = [
        'title',
        'image',
        'media_category_id',
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
     * Get the media category that owns the photo gallery
     */
    public function mediaCategory(): BelongsTo
    {
        return $this->belongsTo(MediaCategory::class);
    }

    /**
     * Scope for active photo galleries
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
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
            return asset('backend/assets/images/photo-gallery/' . $this->image);
        }
        return null;
    }
}

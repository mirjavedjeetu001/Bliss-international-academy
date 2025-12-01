<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoGallery extends Model
{
    protected $fillable = [
        'title',
        'url',
        'type',
        'thumbnail',
        'status',
        'media_category_id',
        'created_by',
        'modified_by'
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
     * Get the media category that owns the video gallery
     */
    public function mediaCategory(): BelongsTo
    {
        return $this->belongsTo(MediaCategory::class);
    }

    /**
     * Scope for active video galleries
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
     * Get the thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('backend/assets/images/video-gallery/' . $this->thumbnail);
        }
        return null;
    }

    /**
     * Get the video embed URL
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->type === 'youtube') {
            // Extract video ID from YouTube URL
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->url, $matches);
            if (isset($matches[1])) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
        } elseif ($this->type === 'facebook') {
            // For Facebook videos, return the original URL
            return $this->url;
        }
        
        return $this->url;
    }
}

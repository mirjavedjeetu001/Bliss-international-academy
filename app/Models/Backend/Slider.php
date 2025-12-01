<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'detail',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Scope for active sliders
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return asset('frontend/assets/images/sliders/' . $this->image);
    }
}

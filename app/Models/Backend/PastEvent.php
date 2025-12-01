<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PastEvent extends Model
{
    protected $fillable = [
        'title',
        'detail',
        'image',
        'created_by',
        'updated_by'
    ];

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return asset('backend/assets/images/events/' . $this->image);
    }
}

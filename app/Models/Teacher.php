<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'qualification',
        'mobile',
        'email',
        'campus',
        'picture',
        'status',
        'sort_by'
    ];

    /**
     * Scope for active teachers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for specific campus
     */
    public function scopeByCampus($query, $campus)
    {
        return $query->where('campus', $campus);
    }

    /**
     * Get formatted picture URL
     */
    public function getPictureUrlAttribute()
    {
        if (!$this->picture) return null;
        return asset($this->picture);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_type',
        'campus',
        'title',
        'pdf_path',
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
     * Scope for active books
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for book type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('book_type', $type);
    }

    /**
     * Scope for campus
     */
    public function scopeByCampus($query, $campus)
    {
        return $query->where('campus', $campus);
    }

    /**
     * Get the type badge color
     */
    public function getTypeBadgeColorAttribute()
    {
        return $this->book_type === 'form' ? 'info' : 'primary';
    }

    /**
     * Get the status badge color
     */
    public function getStatusBadgeColorAttribute()
    {
        return $this->status === 'active' ? 'success' : 'secondary';
    }

    /**
     * Get the PDF URL
     */
    public function getPdfUrlAttribute()
    {
        if ($this->pdf_path) {
            return asset($this->pdf_path);
        }
        return null;
    }
}


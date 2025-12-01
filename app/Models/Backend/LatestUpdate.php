<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class LatestUpdate extends Model
{
    protected $fillable = [
        'title',
        'detail',
        'attachment',
        'created_by',
        'updated_by'
    ];

    // Accessor for attachment URL
    public function getAttachmentUrlAttribute()
    {
        return asset('backend/attachments/' . $this->attachment);
    }
}

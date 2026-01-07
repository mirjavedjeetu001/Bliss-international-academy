<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'logo_path',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'contact_email',
        'contact_phone',
        'contact_address',
        'footer_text',
        'footer_copyright',
        'footer_registration_number',
        'footer_important_links_title',
        'footer_useful_links_title',
        'footer_satkhira_campus_title',
        'footer_debhata_campus_title',
        'footer_important_links',
        'footer_useful_links',
        'footer_satkhira_info',
        'footer_debhata_info',
    ];
}

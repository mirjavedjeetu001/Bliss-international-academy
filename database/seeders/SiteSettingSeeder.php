<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::updateOrCreate([], [
            'facebook_url' => 'https://www.facebook.com/blissia',
            'youtube_url' => 'https://www.youtube.com/@BIASATKHIRA',
            'contact_email' => 'info@bliss.edu.bd',
            'contact_phone' => '01919888316 (Satkhira), 01926261818 (Debhata)',
            'footer_copyright' => 'Copyright © 2025 BLISSIA. All rights reserved',
            'footer_registration_number' => 'Cambridge Registration Number BD000',
            'footer_important_links_title' => 'Important Links',
            'footer_useful_links_title' => 'Useful Links',
            'footer_satkhira_campus_title' => 'Satkhira Campus',
            'footer_debhata_campus_title' => 'Debhata Campus',
            'footer_important_links' => json_encode([
                ['title' => 'Jashore Board', 'url' => 'https://www.jessoreboard.gov.bd/'],
                ['title' => 'Ministry of Education', 'url' => 'https://moedu.portal.gov.bd/'],
                ['title' => 'NCTB', 'url' => 'https://nctb.gov.bd/'],
                ['title' => 'Cambridge University Press', 'url' => 'https://www.cambridge.org/'],
                ['title' => 'Oxford University Press', 'url' => 'https://corp.oup.com/'],
                ['title' => 'Teachers Portal', 'url' => 'https://www.teachers.gov.bd/'],
            ]),
            'footer_useful_links' => json_encode([
                ['title' => 'Admission', 'url' => '/page/40'],
                ['title' => 'Admission Procedure', 'url' => '/page/11'],
                ['title' => 'BIA e-library', 'url' => '/library'],
                ['title' => 'Syllabus', 'url' => '/page/19'],
                ['title' => 'Satkhira Contact', 'url' => '/contact/satkhira-campus'],
                ['title' => 'Debhata Contact', 'url' => '/contact/debhata-campus'],
            ]),
            'footer_satkhira_info' => json_encode([
                'emis' => '20807041',
                'code' => '480675',
                'address' => 'Kharibila, Bypass Road, Satkhira Sadar, Satkhira-9400',
                'phone' => '01919888316',
                'email' => 'info@bliss.edu.bd'
            ]),
            'footer_debhata_info' => json_encode([
                'emis' => '208050212',
                'code' => '463289',
                'address' => 'Sekendra, Debhata, Satkhira',
                'phone' => '01926261818',
                'email' => 'blimia bd@gmail.com'
            ]),
        ]);
    }
}

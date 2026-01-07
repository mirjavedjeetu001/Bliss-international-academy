<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $importantLinks = [
            ['title' => 'Jashore Board', 'url' => 'https://www.jessoreboard.gov.bd/', 'type' => 'important'],
            ['title' => 'Ministry of Education', 'url' => 'https://moedu.portal.gov.bd/', 'type' => 'important'],
            ['title' => 'NCTB', 'url' => 'https://nctb.gov.bd/', 'type' => 'important'],
            ['title' => 'Cambridge University Press', 'url' => 'https://www.cambridge.org/', 'type' => 'important'],
            ['title' => 'Oxford University Press', 'url' => 'https://corp.oup.com/', 'type' => 'important'],
            ['title' => 'Teachers Portal', 'url' => 'https://www.teachers.gov.bd/', 'type' => 'important'],
        ];

        $usefulLinks = [
            ['title' => 'Admission', 'url' => route('frontend.page', ['id' => 40]), 'type' => 'useful'],
            ['title' => 'Admission Procedure', 'url' => route('frontend.page', ['id' => 11]), 'type' => 'useful'],
            ['title' => 'BIA e-library', 'url' => route('frontend.library.index'), 'type' => 'useful'],
            ['title' => 'Syllabus', 'url' => route('frontend.page', ['id' => 19]), 'type' => 'useful'],
            ['title' => 'Satkhira Contact', 'url' => route('frontend.contact.satkhira'), 'type' => 'useful'],
            ['title' => 'Debhata Contact', 'url' => route('frontend.contact.debhata'), 'type' => 'useful'],
        ];

        foreach (array_merge($importantLinks, $usefulLinks) as $link) {
            \App\Models\FooterLink::create($link);
        }
    }
}

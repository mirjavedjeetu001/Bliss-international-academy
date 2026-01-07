<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class ImportStaticMenuSeeder extends Seeder
{
    public function run(): void
    {
        // About BIA
        $aboutBia = Menu::create(['title' => 'About BIA', 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'About BIA', 'page_id' => 5, 'parent_id' => $aboutBia->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Message from Chairman', 'page_id' => 6, 'parent_id' => $aboutBia->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Message from Academic Chief', 'page_id' => 7, 'parent_id' => $aboutBia->id, 'order' => 3, 'show_in_nav' => true]);
        $principal = Menu::create(['title' => 'Message from Principal', 'parent_id' => $aboutBia->id, 'order' => 4, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 8, 'parent_id' => $principal->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 41, 'parent_id' => $principal->id, 'order' => 2, 'show_in_nav' => true]);
        $faculties = Menu::create(['title' => 'Faculties', 'parent_id' => $aboutBia->id, 'order' => 5, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'url' => route('frontend.teachers.satkhira'), 'parent_id' => $faculties->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'url' => route('frontend.teachers.debhata'), 'parent_id' => $faculties->id, 'order' => 2, 'show_in_nav' => true]);

        // Admission
        $admission = Menu::create(['title' => 'Admission', 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Admission Procedure', 'page_id' => 11, 'parent_id' => $admission->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Age Criteria', 'page_id' => 12, 'parent_id' => $admission->id, 'order' => 2, 'show_in_nav' => true]);
        $fees = Menu::create(['title' => 'Fees Structure', 'parent_id' => $admission->id, 'order' => 3, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 13, 'parent_id' => $fees->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 14, 'parent_id' => $fees->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Online Admission', 'page_id' => 40, 'parent_id' => $admission->id, 'order' => 4, 'show_in_nav' => true]);
        $payment = Menu::create(['title' => 'Payment Procedure', 'parent_id' => $admission->id, 'order' => 5, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 38, 'parent_id' => $payment->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 39, 'parent_id' => $payment->id, 'order' => 2, 'show_in_nav' => true]);

        // Academics
        $academics = Menu::create(['title' => 'Academics', 'order' => 3, 'show_in_nav' => true]);
        $calendar = Menu::create(['title' => 'Academic Calendar', 'parent_id' => $academics->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 15, 'parent_id' => $calendar->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 16, 'parent_id' => $calendar->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Cariculum', 'page_id' => 17, 'parent_id' => $academics->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Teaching Medium', 'page_id' => 18, 'parent_id' => $academics->id, 'order' => 3, 'show_in_nav' => true]);
        Menu::create(['title' => 'Syllabus', 'page_id' => 19, 'parent_id' => $academics->id, 'order' => 4, 'show_in_nav' => true]);
        $forms = Menu::create(['title' => 'Forms & Downloads', 'parent_id' => $academics->id, 'order' => 5, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'url' => route('frontend.downloads.satkhira'), 'parent_id' => $forms->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'url' => route('frontend.downloads.debhata'), 'parent_id' => $forms->id, 'order' => 2, 'show_in_nav' => true]);

        // Bliss Clubs
        $clubs = Menu::create(['title' => 'Bliss Clubs', 'order' => 4, 'show_in_nav' => true]);
        Menu::create(['title' => 'Language Club', 'page_id' => 20, 'parent_id' => $clubs->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debating Club', 'page_id' => 21, 'parent_id' => $clubs->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Science Club', 'page_id' => 22, 'parent_id' => $clubs->id, 'order' => 3, 'show_in_nav' => true]);
        Menu::create(['title' => 'Art Club', 'page_id' => 23, 'parent_id' => $clubs->id, 'order' => 4, 'show_in_nav' => true]);
        Menu::create(['title' => 'Cultural Club', 'page_id' => 24, 'parent_id' => $clubs->id, 'order' => 5, 'show_in_nav' => true]);
        Menu::create(['title' => 'Sports Club', 'page_id' => 25, 'parent_id' => $clubs->id, 'order' => 6, 'show_in_nav' => true]);
        Menu::create(['title' => 'ICT Club', 'page_id' => 26, 'parent_id' => $clubs->id, 'order' => 7, 'show_in_nav' => true]);

        // Results
        $results = Menu::create(['title' => 'Results', 'order' => 5, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 27, 'parent_id' => $results->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 28, 'parent_id' => $results->id, 'order' => 2, 'show_in_nav' => true]);

        // Students' Affairs
        $affairs = Menu::create(['title' => "Students' Affairs", 'order' => 6, 'show_in_nav' => true]);
        $activities = Menu::create(['title' => "Students' Activities", 'parent_id' => $affairs->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 29, 'parent_id' => $activities->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 30, 'parent_id' => $activities->id, 'order' => 2, 'show_in_nav' => true]);
        $publication = Menu::create(['title' => 'BIA Publication', 'parent_id' => $affairs->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 31, 'parent_id' => $publication->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 32, 'parent_id' => $publication->id, 'order' => 2, 'show_in_nav' => true]);
        $verification = Menu::create(['title' => 'Student Verification', 'parent_id' => $affairs->id, 'order' => 3, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'page_id' => 33, 'parent_id' => $verification->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'page_id' => 37, 'parent_id' => $verification->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'BIA e-library', 'url' => route('frontend.library.index'), 'parent_id' => $affairs->id, 'order' => 4, 'show_in_nav' => true]);

        // Media Gallery
        $media = Menu::create(['title' => 'Media Gallery', 'order' => 7, 'show_in_nav' => true]);
        Menu::create(['title' => 'Photo Gallery', 'url' => route('frontend.photogallery.index'), 'parent_id' => $media->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Video Gallery', 'url' => route('frontend.videogallery.index'), 'parent_id' => $media->id, 'order' => 2, 'show_in_nav' => true]);

        // Login
        $login = Menu::create(['title' => 'login', 'order' => 8, 'show_in_nav' => true]);
        Menu::create(['title' => "Teacher's Login", 'url' => '#', 'parent_id' => $login->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Student Login', 'url' => '#', 'parent_id' => $login->id, 'order' => 2, 'show_in_nav' => true]);

        // Contact
        $contact = Menu::create(['title' => 'Contact', 'order' => 9, 'show_in_nav' => true]);
        Menu::create(['title' => 'Satkhira Campus', 'url' => route('frontend.contact.satkhira'), 'parent_id' => $contact->id, 'order' => 1, 'show_in_nav' => true]);
        Menu::create(['title' => 'Debhata Campus', 'url' => route('frontend.contact.debhata'), 'parent_id' => $contact->id, 'order' => 2, 'show_in_nav' => true]);
        Menu::create(['title' => 'Career', 'url' => route('frontend.career.index'), 'parent_id' => $contact->id, 'order' => 3, 'show_in_nav' => true]);
    }
}

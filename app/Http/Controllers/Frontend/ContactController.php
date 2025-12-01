<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }

    public function satkhiraCampus()
    {
        return view('frontend.contact.satkhiraCampus');
    }

    public function debhataCampus()
    {
        return view('frontend.contact.debhataCampus');
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'subject' => 'required|string|in:General Inquiry,Admission,Support,Other',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save contact form data to database
        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'campus' => $request->campus ?? 'general',
            'is_read' => false
        ]);
        
        // Clear cache when new contact is added
        Cache::forget('contacts_total_count');
        Cache::forget('contacts_unread_count');
        
        return redirect()->back()->with('success', 'Thank you! We\'ll get back to you soon.');
    }
}

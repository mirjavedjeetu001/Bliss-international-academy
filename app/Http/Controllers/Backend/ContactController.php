<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        // Optimized query with caching
        $contacts = Contact::select('id', 'name', 'phone', 'email', 'subject', 'campus', 'is_read', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        // Get counts efficiently with caching
        $totalCount = Cache::remember('contacts_total_count', 300, function () {
            return Contact::count();
        });
        
        $unreadCount = Cache::remember('contacts_unread_count', 300, function () {
            return Contact::where('is_read', false)->count();
        });
        
        return view('backend.contact.contactList-clean', compact('contacts', 'totalCount', 'unreadCount'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read efficiently
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
            $contact->refresh(); // Refresh the model to get updated data
        }
        
        return view('backend.contact.contactShow-clean', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect()->route('backend.contact.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        
        // Clear cache when status changes
        Cache::forget('contacts_unread_count');
        
        return redirect()->back()
            ->with('success', 'Message marked as read.');
    }

    public function markAsUnread($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => false]);
        
        // Clear cache when status changes
        Cache::forget('contacts_unread_count');
        
        return redirect()->back()
            ->with('success', 'Message marked as unread.');
    }
}

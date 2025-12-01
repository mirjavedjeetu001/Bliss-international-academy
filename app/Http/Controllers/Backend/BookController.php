<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('backend.book.index-clean', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.book.add-clean');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_type' => 'required|in:form,book',
            'campus' => 'required|in:All Campus,Satkhira,Debhata',
            'title' => 'required|string|max:255',
            'pdf' => 'required|mimes:pdf|max:10240', // 10MB max
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['book_type', 'campus', 'title', 'status']);

        // Handle PDF upload
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $filename = time() . '_' . $pdf->getClientOriginalName();
            $uploadPath = public_path('frontend/assets/attachments');
            
            // Ensure directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $pdf->move($uploadPath, $filename);
            $data['pdf_path'] = 'frontend/assets/attachments/' . $filename;
        }

        Book::create($data);

        return redirect()->route('backend.book.index')
            ->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('backend.book.show-clean', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('backend.book.edit-clean', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_type' => 'required|in:form,book',
            'campus' => 'required|in:All Campus,Satkhira,Debhata',
            'title' => 'required|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['book_type', 'campus', 'title', 'status']);

        // Handle new PDF upload
        if ($request->hasFile('pdf')) {
            // Delete old PDF
            if ($book->pdf_path) {
                $oldFilePath = public_path($book->pdf_path);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Upload new PDF
            $pdf = $request->file('pdf');
            $filename = time() . '_' . $pdf->getClientOriginalName();
            $uploadPath = public_path('frontend/assets/attachments');
            
            // Ensure directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $pdf->move($uploadPath, $filename);
            $data['pdf_path'] = 'frontend/assets/attachments/' . $filename;
        }

        $book->update($data);

        return redirect()->route('backend.book.index')
            ->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Delete associated PDF file
        if ($book->pdf_path) {
            $filePath = public_path($book->pdf_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $book->delete();

        return redirect()->route('backend.book.index')
            ->with('success', 'Book deleted successfully!');
    }
}


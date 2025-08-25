<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(4);
        
        return response()->json([
            'success' => true,
            'message' => 'Books retrieved successfully',
            'data' => $books
        ]);
    }
    
    public function store(Request $request)
    {
        // Validasi dengan try-catch untuk handle error
        try {
            $validated = $request->validate([
                'book_name' => 'required|string|max:150',
                'author' => 'required|string|max:150',
                'description' => 'nullable|string',
                'published_date' => 'required|date_format:Y-m-d'
            ], [
                // Custom error messages
                'book_name.required' => 'Book name is required',
                'book_name.max' => 'Book name cannot exceed 150 characters',
                'author.required' => 'Author name is required',
                'author.max' => 'Author name cannot exceed 150 characters',
                'published_date.required' => 'Published date is required',
                'published_date.date_format' => 'Published date must be in format YYYY-MM-DD (e.g., 2024-01-15)'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
        
        // Cek duplicate book
        $exists = Book::where('book_name', $request->book_name)
                     ->where('author', $request->author)
                     ->exists();
                     
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Book with same name and author already exists!',
                'errors' => [
                    'duplicate' => ['A book with this name and author combination already exists']
                ]
            ], 422);
        }
        
        // Create book
        $book = Book::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }
    
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }
        
        try {
            $validated = $request->validate([
                'description' => 'required|string'
            ], [
                'description.required' => 'Description is required',
                'description.string' => 'Description must be a string'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
        
        $book->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }
    
    public function destroy($id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }
        
        $book->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully'
        ]);
    }
    
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        // Validasi search query
        if (!$query || trim($query) === '') {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required',
                'errors' => [
                    'query' => ['Please provide a search keyword']
                ]
            ], 400);
        }
        
        $books = Book::where('book_name', 'LIKE', "%{$query}%")
                     ->orWhere('description', 'LIKE', "%{$query}%")
                     ->paginate(4);
        
        // Check if no results found
        if ($books->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No books found matching your search',
                'query' => $query,
                'data' => []
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Search results found',
            'query' => $query,
            'data' => $books
        ]);
    }
}
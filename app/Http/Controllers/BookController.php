<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();

        return view('Homepage', [
            'books' => $books,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255', 'unique:books'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'author' => ['required', 'string', 'max:255']
        ]);

        $author = Author::where("name", $validated['author'])->first();

        if ($author == null) {
            $author = Author::create(["name" => $validated['author']]);
        }

        $validated['author_id'] = $author->id;

        Book::create($validated);

        return redirect()->back();
    }

    public function all()
    {
        $books = Book::with('author', 'category')->get();

        return response()->json($books);
    }

    public function show($id)
    {
        return response()->json(Book::with('author', 'category')->find($id));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        // dd($books);

        return view('Homepage', [
            'books' => $books,
            'categories' => $categories
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $validated = $request->validate([
            'term' => ['required', 'string']
        ]);

        $res = Author::select("name")
            ->where("name", "LIKE", "%{$validated['term']}%")
            ->get();

        return response()->json($res);
    }
}

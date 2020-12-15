<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search()
    {
        return view('search');
    }

    public function find(Request $request)
    {
        $filters = [
            'title' => $request->title,
            'author' => $request->author,
            'penerbit' => $request->penerbit,
            'genre' => $request->genre,
            'tahun' => $request->tahun,
        ];

        $books = Book::where(function ($query) use ($filters) {
            if ($filters['title']) {
                $query->where('title', 'like', '%' . $filters['title'] . '%');
            }
            if ($filters['author']) {
                $query->where('author', 'like', '%' . $filters['author'] . '%');
            }
            if ($filters['penerbit']) {
                $query->where('penerbit', 'like', '%' . $filters['penerbit'] . '%');
            }
            if ($filters['genre']) {
                $query->where('genre', 'like', '%' . $filters['genre'] . '%');
            }
            if ($filters['tahun']) {
                $query->where('tahun', 'like', '%' . $filters['tahun'] . '%');
            }
        })->paginate(10);
        return view('show', compact('books'));
    }
}

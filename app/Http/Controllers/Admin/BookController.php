<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'title' => $request->title,
            'author'    => $request->author,
            'penerbit'    => $request->penerbit,
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
        })->paginate(10);

        return view('admin.book.index', compact('books'));
    }

    public function create()
    {
        $raks = Rak::all();
        return view('admin/book/create', compact('raks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'sinopsis' => 'required',
            'cover' => 'required',
            'genre' => 'required',
            'rak_id' => 'required',
            'stok' => 'required'
        ]);

        $file = $request->file('cover');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        Storage::putFileAs('books', new File($file), $nama_file);

        $stok_now = $request->stok;
        $request = new Request($request->all());
        $request->merge([
            'cover' => $nama_file,
            'stok_now' => $stok_now,
        ]);

        Book::create($request->all());
        return redirect('admin/book')->withToastSuccess('Data Created Successfully!');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $raks = Rak::all();
        return view('admin/book/edit', compact('book', 'raks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'sinopsis' => 'required',
            'genre' => 'required',
            'rak_id' => 'required'
        ]);

        $cek = Book::find($id);

        // check if request has file
        if ($request->hasFile('cover')) {
            // check if in the local driver has cover files
            if (Storage::disk('local')->exists('books/' . $cek->cover)) {
                Storage::delete('books/' . $cek->cover);
            }

            $file = $request->file('cover');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            Storage::putFileAs('books', new File($file), $nama_file);

            $cek->update([
                'title' => $request->title,
                'author' => $request->author,
                'penerbit' => $request->penerbit,
                'tahun' => $request->tahun,
                'sinopsis' => $request->sinopsis,
                'cover' => $nama_file,
                'genre' => $request->genre,
                'rak_id' => $request->rak_id,
                'stok' => $cek->stok + $request->stok,
                'stok_now' => $cek->stok_now + $request->stok
            ]);
            return redirect('admin/book')->withToastInfo('Data Updated Successfully!');
        } else {
            $cek->update([
                'title' => $request->title,
                'author' => $request->author,
                'penerbit' => $request->penerbit,
                'tahun' => $request->tahun,
                'sinopsis' => $request->sinopsis,
                'genre' => $request->genre,
                'rak_id' => $request->rak_id,
                'stok' => $cek->stok + $request->stok,
                'stok_now' => $cek->stok_now + $request->stok
            ]);
            return redirect('admin/book')->withToastInfo('Data Updated Successfully!');
        }
    }

    public function destroy($id)
    {
        // define path
        $del = Book::find($id);
        $image_path = public_path("cover/{$del->cover}");
        // cek file ada atau tidak
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $del->delete();
        return redirect('admin/book')->withToastWarning('Data Deleted Successfully!');
    }

    public function show($id)
    {
        $book = Book::find($id);
        return view('admin/book/show', compact('book'));
    }
}

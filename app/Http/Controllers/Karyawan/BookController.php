<?php

namespace App\Http\Controllers\Karyawan;

use App\Book;
use App\Http\Controllers\Controller;
use App\Rak;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('karyawan/book/index', compact('books'));
    }

    public function create()
    {
        $raks = Rak::all();
        return view('karyawan/book/create', compact('raks'));
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
            'rak_id' => 'required'
        ]);

        $file = $request->file('cover');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'cover';
        $file->move($tujuan_upload, $nama_file);

        $request = new Request($request->all());
        $request->merge([
            'cover' => $nama_file,
        ]);

        Book::create($request->all());
        return redirect('karyawan/book')->withToastSuccess('Data Created Successfully!');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $raks = Rak::all();
        return view('karyawan/book/edit', compact('book', 'raks'));
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

        // cek update cover baru atau tidak
        if ($request->hasFile('cover')) {
            $del = Book::find($id);
            $image_path = public_path("cover/{$del->cover}");
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $file = $request->file('cover');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'cover';
            $file->move($tujuan_upload, $nama_file);

            Book::find($id)->update([
                'title' => $request->title,
                'author' => $request->author,
                'penerbit' => $request->penerbit,
                'tahun' => $request->tahun,
                'sinopsis' => $request->sinopsis,
                'cover' => $nama_file,
                'genre' => $request->genre,
                'rak_id' => $request->rak_id
            ]);
            return redirect('karyawan/book')->withToastInfo('Data Updated Successfully!');
        } else {
            Book::find($id)->update([
                'title' => $request->title,
                'author' => $request->author,
                'penerbit' => $request->penerbit,
                'tahun' => $request->tahun,
                'sinopsis' => $request->sinopsis,
                'genre' => $request->genre,
                'rak_id' => $request->rak_id
            ]);
            return redirect('karyawan/book')->withToastInfo('Data Updated Successfully!');
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
        return redirect('karyawan/book')->withToastWarning('Data Deleted Successfully!');
    }

    public function show($id)
    {
        $book = Book::find($id);
        return view('karyawan/book/show', compact('book'));
    }
}

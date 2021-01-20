<?php

namespace App\Http\Controllers\Karyawan;

use App\Book;
use App\Carts;
use App\Http\Controllers\Controller;
use App\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private function get_chart()
    {
        return DB::table('books')
            ->join('carts', 'carts.books_id', '=', 'books.id')
            ->where('carts.operator', '=', Auth::id())
            ->get();
    }

    public function index(Request $request)
    {
        $carts = $this->get_chart();
        $filters = [
            'title' => $request->title,
            'author' => $request->author,
            'penerbit' => $request->penerbit,
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
        return view('karyawan.pinjam.index', compact('books', 'carts'));
    }

    public function addCart(Request $request, $id)
    {
        $request->validate([
            'durations' => 'required'
        ]);

        $add = Carts::updateOrCreate([
            'books_id' => $id,
            'operator' => Auth::id(),
            'type' => 'Offline'
        ], [
            'durations' => $request->durations,
        ]);

        if (!$add->wasRecentlyCreated && $add->wasChanged()) {
            return redirect()->back()->withToastInfo('Cart Updated!');
        } elseif (!$add->wasRecentlyCreated && !$add->wasChanged()) {
            return redirect()->back()->withToastError('Failed to Adding to the cart!');
        } elseif ($add->wasRecentlyCreated) {
            return redirect()->back()->withToastSuccess('Added to cart!');
        }
    }

    public function create()
    {
        $carts = $this->get_chart();
        $orders = Carts::where([
            'type' => 'Offline',
            'operator' => Auth::id()
        ])->get();
        return view('karyawan.pinjam.create', compact('orders', 'carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'users_id_anggota' => 'required'
        ]);

        $getCart = $this->get_chart();

        $orders = Carts::where([
            'type' => 'Offline',
            'operator' => Auth::id()
        ])->get();

        // foreach ($orders as $key => $order) {
        //     if ($getCart[$key]->stok_now > 0) {
        //         Transactions::create([
        //             'users_id_anggota' => $request->users_id_anggota,
        //             'books_id' => $order->books_id,
        //             'durations' => $order->durations,
        //             'start_date' => Carbon::now()->toDateString(),
        //             'deadline' => Carbon::now()->addDays($order->durations)->toDateString(),
        //             'status' => 'Dipinjam',
        //             'operator' => Auth::id(),
        //             'type' => 'Offline',
        //             'date_returned' => '',
        //             'penalty' => ''
        //         ]);

        //         Book::where('id', $order->books_id)->update([
        //             'stok_now' => $getCart[$key]->stok_now - 1
        //         ]);
        //     }
        // }
        // return redirect('karyawan/pinjam');

        DB::beginTransaction();
        try {
            foreach ($orders as $key => $order) {
                if ($getCart[$key]->stok_now > 0) {
                    Transactions::create([
                        'users_id_anggota' => $request->users_id_anggota,
                        'books_id' => $order->books_id,
                        'durations' => $order->durations,
                        'start_date' => Carbon::now()->toDateString(),
                        'deadline' => Carbon::now()->addDays($order->durations)->toDateString(),
                        'status' => 'Dipinjam',
                        'operator' => Auth::id(),
                        'type' => 'Offline',
                        'date_returned' => '',
                        'penalty' => ''
                    ]);

                    Book::where('id', $order->books_id)->update([
                        'stok_now' => $getCart[$key]->stok_now - 1
                    ]);

                    $del = Carts::findOrFail($order->id);
                    $del->delete();
                }
            }

            DB::commit();
            return redirect('karyawan/pinjam')->withSuccess('Berhasil', 'Pinjaman Buku Terkonfirmasi!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('karyawan/pinjam')->withError('Gagal', 'Pinjaman Buku Gagal Terkonfirmasi!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Carts::findOrFail($id);
        $del->delete();
        return redirect()->back()->withToastWarning('Selected Cart Removed!');
    }
}

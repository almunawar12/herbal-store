<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Http\Requests\TransactionRequest;
use App\Models\TransactionItem;
use App\Utils\TimeZoneHelper;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MyTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->roles === 'ADMIN') {
            abort(403, 'Admin tidak diperbolehkan mengakses transaksi pribadi.');
        }


        if (request()->ajax()) {
            $query = Transaction::with(['user', 'items.product'])->where('users_id', Auth::user()->id)->latest();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.my-transaction.show', $item->id) . '">
                            Show
                        </a>';
                })
                ->editColumn('total_price', function ($item) {
                    return 'Rp ' . number_format($item->total_price, 0, ',', '.');
                })
                ->addColumn('created_date', function ($item) {
                    return TimeZoneHelper::formatJakarta($item->created_at);
                })
                ->addColumn('created_time_ago', function ($item) {
                    return TimeZoneHelper::diffForHumans($item->created_at);
                })
                ->addColumn('status', function ($item) {
                    return $item->status;
                })
                ->addColumn('product_name', function ($item) {
                    // Ambil nama produk pertama dari transaksi
                    if ($item->items && count($item->items) > 0 && $item->items[0]->product) {
                        return $item->items[0]->product->name;
                    }
                    return '-';
                })
                ->order(function ($query) {
                    $query->orderBy('created_at', 'desc');
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.transaction.mytransaction');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $myTransaction
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Transaction $myTransaction)
    {
        // Cek otorisasi - user hanya bisa melihat transaksi miliknya sendiri
        if ($myTransaction->users_id !== Auth::user()->id) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        if (request()->ajax()) {
            $query = TransactionItem::with(['product'])->where('transactions_id', $myTransaction->id)->latest();

            return DataTables::of($query)
                ->editColumn('product.price', function ($item) {
                    return 'Rp ' . number_format($item->product->price, 0, ',', '.');
                })
                ->addColumn('product_name', function ($item) {
                    return $item->product ? $item->product->name : 'Produk tidak ditemukan';
                })
                ->order(function ($query) {
                    $query->orderBy('created_at', 'desc');
                })
                ->make();
        }

        return view('pages.dashboard.transaction.show', [
            'transaction' => $myTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $myTransaction
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Transaction $myTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $myTransaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TransactionRequest $request, Transaction $myTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Transaction $myTransaction)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Models\TransactionItem;
use App\Utils\TimeZoneHelper;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::latest(); // Menampilkan data terbaru di atas

            return DataTables::of($query)
                ->addcolumn('action', function ($item) {
                    return '
                    <a href="' . route('dashboard.transaction.show', $item->id) . '" class="inline-block border border-blue-700 bg-green-500 text-white rounded-md px-2 py-1 m-1
                        transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                        Show
                    </a> 
                    <a href="' . route('dashboard.transaction.edit', $item->id) . '" class="inline-block border border-gray-700 bg-gray-500 text-white rounded-md px-2 py-1 m-1
                        transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline">
                        Edit
                    </a>
                    ';
                })
                ->editcolumn('total_price', function ($item) {
                    return 'Rp ' . number_format($item->total_price, 0, ',', '.');
                })
                ->addcolumn('created_date', function ($item) {
                    return TimeZoneHelper::formatJakarta($item->created_at);
                })
                ->addcolumn('updated_date', function ($item) {
                    return TimeZoneHelper::formatJakarta($item->updated_at);
                })
                ->addcolumn('created_time_ago', function ($item) {
                    return TimeZoneHelper::diffForHumans($item->created_at);
                })
                ->order(function ($query) {
                    $query->orderBy('created_at', 'desc');
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.transaction.index');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Set timestamps menggunakan zona waktu Jakarta
        $data['created_at'] = TimeZoneHelper::now();
        $data['updated_at'] = TimeZoneHelper::now();

        $transaction = Transaction::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        if (request()->ajax()) {
            $query = TransactionItem::with(['product'])->where('transactions_id', $transaction->id)->latest();

            return DataTables::of($query)
                ->editcolumn('product.price', function ($item) {
                    return 'Rp ' . number_format($item->product->price, 0, ',', '.');
                })
                ->addcolumn('product_name', function ($item) {
                    return $item->product ? $item->product->name : 'Produk tidak ditemukan';
                })
                ->addcolumn('subtotal', function ($item) {
                    $subtotal = $item->product ? ($item->product->price * $item->quantity) : 0;
                    return 'Rp ' . number_format($subtotal, 0, ',', '.');
                })
                ->order(function ($query) {
                    $query->orderBy('created_at', 'desc');
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('pages.dashboard.transaction.edit', [
            'item' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->all();

        // Set updated_at menggunakan zona waktu Jakarta
        $data['updated_at'] = TimeZoneHelper::now();

        $transaction->update($data);
        return redirect()->route('dashboard.transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

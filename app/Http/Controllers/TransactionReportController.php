<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = Transaction::with('user')
                ->where('status', 'SUCCESS')
                ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('created_at', [
                        $request->start_date . ' 00:00:00',
                        $request->end_date . ' 23:59:59',
                    ]);
                })
                ->latest();

            return DataTables::of($transactions)
                ->addColumn('name', fn($item) => $item->name)
                ->addColumn('email', fn($item) => $item->email)
                ->addColumn('total_price', fn($item) => 'Rp' . number_format($item->total_price, 0, ',', '.'))
                ->addColumn('created_at', fn($item) => $item->created_at->format('d-m-Y'))
                ->make();
        }

        return view('pages.dashboard.reports.index');
    }

    public function exportPdf(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $query = Transaction::where('status', 'SUCCESS');

        if ($start && $end) {
            $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        $transactions = $query->latest()->get();
        $adminName = Auth::user()->name;

        $totalAll = $transactions->sum('total_price');
        $startFormatted = $start ? \Carbon\Carbon::parse($start)->translatedFormat('d F Y') : null;
        $endFormatted = $end ? \Carbon\Carbon::parse($end)->translatedFormat('d F Y') : null;
        $totalTransactions = $transactions->count();
        $totalProducts = TransactionItem::whereIn('transactions_id', $transactions->pluck('id'))->count();

        return Pdf::loadView('exports.sales-report-pdf', [
            'transactions' => $transactions,
            'adminName' => Auth::user()->name,
            'totalAll' => $transactions->sum('total_price'),
            'startFormatted' => $startFormatted,
            'endFormatted' => $endFormatted,
            'totalTransactions' => $totalTransactions,
            'totalProducts' => $totalProducts,
        ])->setPaper('A4', 'portrait')->download('laporan-penjualan.pdf');


        return $pdf->download('laporan-penjualan.pdf');
    }
}

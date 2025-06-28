<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->roles === 'ADMIN') {
            $userCount = User::count();
            $productCount = Product::count();
            $transactionCount = Transaction::count();
            $totalTransactionAmount = Transaction::sum('total_price');

            $salesChart = Transaction::selectRaw("DATE_FORMAT(created_at, '%M') as month, SUM(total_price) as total")
                ->whereYear('created_at', now()->year)
                ->groupByRaw("MONTH(created_at)")
                ->orderByRaw("MONTH(created_at)")
                ->get();

            return view('pages.dashboard.index', compact(
                'userCount',
                'productCount',
                'transactionCount',
                'totalTransactionAmount',
                'salesChart'
            ));
        }

        $userTransactionCount = Transaction::where('users_id', Auth::id())->count();
        $userTotalTransactionAmount = Transaction::where('users_id', Auth::id())->sum('total_price');
        return view('pages.dashboard.index', compact(
            'userTransactionCount',
            'userTotalTransactionAmount'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function receive(Request $request)
    {
        try {
            Log::info('Midtrans callback received:', $request->all());

            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            $notif = new \Midtrans\Notification();

            $orderId = $notif->order_id; // Contoh: LX-7-1718920000
            $transactionStatus = $notif->transaction_status;
            $fraudStatus = $notif->fraud_status;

            $realId = explode('-', $orderId)[1] ?? null;

            $transaction = \App\Models\Transaction::find($realId);

            if (!$transaction) {
                Log::warning("Transaction not found for ID: $realId");
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            if ($transactionStatus == 'settlement') {
                $transaction->status = 'SUCCESS';
            } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
                $transaction->status = 'CANCELLED';
            } elseif ($transactionStatus == 'pending') {
                $transaction->status = 'PENDING';
            }

            $transaction->save();

            return response()->json(['message' => 'Handled'], 200);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}

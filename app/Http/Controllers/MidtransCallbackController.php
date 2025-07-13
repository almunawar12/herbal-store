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
            // Log::info('💡 Midtrans Callback Hit!', ['request' => $request->all()]);


            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
            \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

            $notification = $request->all();

            if (empty($notification)) {
                Log::warning('❗ Empty notification received from Midtrans.');
                return response()->json(['message' => 'No notification data'], 400);
            }

            $transaction = $notification['transaction_status'] ?? null;
            $type = $notification['payment_type'];
            $fraud = $notification['fraud_status'];
            $orderId = $notification['order_id'];

            $data = Transaction::where('code', $orderId)->first();

            if (!$data) {
                Log::warning("❌ Transaction with order_id {$orderId} not found.");
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // Log::info("🔍 Processing transaction: {$orderId}, Status: {$transaction}, Type: {$type}, Fraud: {$fraud}");

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    $data->status = $fraud == 'challenge' ? 'PENDING' : 'SUCCESS';
                }
            } elseif ($transaction == 'settlement') {
                $data->status = 'SUCCESS';
            } elseif ($transaction == 'pending') {
                $data->status = 'PENDING';
            } elseif (in_array($transaction, ['deny', 'cancel', 'expire'])) {
                $data->status = 'CANCELLED';
            }

            $data->save();

            // Log::info("✅ Callback processed. Status: {$data->status}");

            return response()->json(['message' => 'Callback processed successfully']);
        } catch (\Exception $e) {
            Log::error('🔥 Callback error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Midtrans\Snap;
use Midtrans\Transaction;

class PaymentController extends Controller
{
    public function checkout()
    {
        // Data transaksi (contoh sederhana)
        $transactionDetails = [
            'order_id' => uniqid(), // ID unik untuk setiap transaksi
            'gross_amount' => 150000, // Total pembayaran (dalam IDR)
        ];

        $itemDetails = [
            [
                'id' => 'paket1',
                'price' => 150000,
                'quantity' => 1,
                'name' => 'Paket Wisata Pantai',
            ],
        ];

        $customerDetails = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone' => '08123456789',
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Buat token pembayaran
        $snapToken = Snap::getSnapToken($params);

        return view('checkout', compact('snapToken'));
    }
    public function callback(Request $request)
    {
        // Midtrans callback response
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            // Lakukan tindakan setelah pembayaran sukses atau gagal
            if ($request->transaction_status === 'capture') {
                // Pembayaran berhasil
                return response()->json(['status' => 'success']);
            } elseif ($request->transaction_status === 'pending') {
                // Pembayaran tertunda
                return response()->json(['status' => 'pending']);
            } else {
                // Pembayaran gagal
                return response()->json(['status' => 'failure']);
            }
        } else {
            return response()->json(['status' => 'invalid signature'], 400);
        }
    }

}
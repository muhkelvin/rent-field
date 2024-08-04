<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkoutIndex()
    {
        // Mendapatkan semua booking untuk user yang sedang login
        $cart = Booking::where('user_id', Auth::id())->get();

        return view('customer.checkout.index', compact('cart'));
    }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
        ]);

        // Cari booking berdasarkan ID
        $booking = Booking::findOrFail($request->booking_id);

        // Pastikan booking milik user yang sedang login dan statusnya 'pending'
        if ($booking->user_id == Auth::id() && $booking->status === 'pending') {
            // Buat payment
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'payment_method' => $request->payment_method,
                'amount' => $booking->total_price,
                'transaction_id' => null, // ID transaksi dari gateway pembayaran
                'status' => 'pending',
            ]);

            // Integrasi dengan gateway pembayaran untuk memproses pembayaran
            // Kode ini bergantung pada gateway yang digunakan

            // Setelah pembayaran berhasil, ubah status booking menjadi 'paid'
            $booking->status = 'paid';
            $booking->save();

            return redirect()->route('transactions.index')->with('success', 'Payment initiated. Please complete the payment.');
        }

        return redirect()->route('checkout.index')->with('error', 'Invalid booking or payment status.');
    }

    public function index()
    {
        // Menampilkan semua transaksi untuk user yang sedang login
        $transactions = Payment::whereHas('booking', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('booking')->get();

        return view('customer.transactions.index', compact('transactions'));
    }



}


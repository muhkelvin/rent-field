<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Mendapatkan semua booking untuk user yang sedang login
        $cart = Booking::where('user_id', Auth::id())->get();

        return view('customer.cart.index', compact('cart'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Cari field berdasarkan ID
        $field = Field::findOrFail($request->field_id);

        // Buat atau update booking
        $booking = Booking::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'field_id' => $field->id,
            ],
            [
                'start_time' => $request->date . ' ' . $request->time,
                'end_time' => $this->calculateEndTime($request->date, $request->time),
                'total_price' => $field->price,
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Field added to cart!');
    }


    public function update(Request $request, Booking $booking)
    {
        // Validasi input
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Pastikan booking milik user yang sedang login dan belum selesai
        if ($booking->user_id == Auth::id() && $booking->status == 'pending') {
            $booking->start_time = $request->date . ' ' . $request->time;
            $booking->end_time = $this->calculateEndTime($request->date, $request->time);
            $booking->save();

            return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
        }

        return redirect()->route('cart.index')->with('error', 'Booking not found or cannot be updated');
    }

    public function remove(Request $request, Booking $booking)
    {
        // Pastikan booking milik user yang sedang login dan belum selesai
        if ($booking->user_id == Auth::id() && $booking->status == 'pending') {
            $booking->delete();

            return redirect()->route('cart.index')->with('success', 'Field removed successfully');
        }

        return redirect()->route('cart.index')->with('error', 'Booking not found or cannot be removed');
    }

    public function checkout()
    {
        // Mendapatkan semua booking untuk user yang sedang login
        $bookings = Booking::where('user_id', Auth::id())->get();

        if ($bookings->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        foreach ($bookings as $booking) {
            // Buat pembayaran untuk setiap booking
            Payment::create([
                'booking_id' => $booking->id,
                'payment_method' => 'credit_card', // Misalkan default payment method
                'amount' => $booking->total_price,
                'transaction_id' => null, // ID transaksi dari gateway pembayaran
                'status' => 'pending',
            ]);

            // Opsional: Update booking jika ada kolom status baru atau mekanisme lain
            // $booking->update(['status' => 'pending']); // Hapus atau sesuaikan jika perlu
        }

        return redirect()->route('checkout.index')->with('success', 'Checkout successful. Please complete the payment.');
    }


    private function calculateEndTime($date, $time)
    {
        $start = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $time);
        // Misalkan booking berdurasi 2 jam, Anda bisa menyesuaikan logika ini sesuai kebutuhan
        return $start->addHours(2);
    }
}


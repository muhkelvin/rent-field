<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerPaymentController extends Controller
{
    public function index()
    {
        // Fetch payments with their associated bookings where the user_id matches the authenticated user
        $payments = Payment::with(['booking' => function($query) {
            $query->where('user_id', Auth::id());
        }])->get();

        return view('owner.transactions.index', compact('payments'));
    }

    public function update(Request $request, Payment $payment)
    {
        // Update the payment status to 'completed'
        $payment->status = 'completed';
        $payment->save();

        return redirect()->route('owner.transactions.index')->with('success', 'Payment status updated successfully.');
    }
}

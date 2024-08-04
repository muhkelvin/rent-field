<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::whereHas('field', function($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('owner.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if ($booking->field->user_id !== Auth::id()) {
            return redirect()->route('owner.bookings.index')->with('error', 'Unauthorized access to view this booking.');
        }

        return view('owner.bookings.show', compact('booking'));
    }
}

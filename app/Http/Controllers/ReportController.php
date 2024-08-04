<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $fields = Field::where('user_id', Auth::id())->get();
        $bookings = Booking::whereHas('field', function($query) {
            $query->where('user_id', Auth::id());
        })->get();

        // Filter berdasarkan tanggal
        if ($request->filled('from') && $request->filled('to')) {
            $bookings = $bookings->whereBetween('created_at', [$request->from, $request->to]);
        }

        return view('owner.reports.index', compact('fields', 'bookings'));
    }
}

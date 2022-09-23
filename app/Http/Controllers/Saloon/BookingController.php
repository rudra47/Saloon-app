<?php

namespace App\Http\Controllers\Saloon;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Saloon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $saloon = Saloon::where('user_id', auth()->user()->id)->first();
        $bookings = Booking::with(['customer', 'saloon', 'saloon_service'])->where('saloon_id', $saloon->id)->get();

        return view('saloon.bookings.index', compact('bookings'));
    }

    public function confirmation($booking_id)
    {
        $booking = Booking::find($booking_id);
        return view('saloon.bookings.confirmation', compact('booking'));
    }

    public function confirmationStore(Request $request, $booking_id)
    {
        $booking = Booking::find($booking_id);
        $booking->update([
            'status' => $request->status ?? $booking->status,
            'booking_confirm_time' => $request->booking_confirm_time ?? $booking->booking_confirm_time
        ]);
        return redirect()->route('app.saloon.bookings.index');
    }
}

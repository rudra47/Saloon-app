<?php

namespace App\Http\Controllers\Saloon;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Saloon;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings()
    {
        $user = User::find(auth()->user()->id);
        $saloon = Saloon::where('user_id', $user->id)->first();
        return view('saloon.settings.settings', compact('saloon'));
    }

    public function settingsStore(Request $request, $saloon_id)
    {
        $saloon = Saloon::find($saloon_id);
        $saloon->update([
            'start_time' => $request->start_time ?? $booking->start_time,
            'end_time' => $request->end_time ?? $booking->end_time
        ]);
        return redirect()->route('app.saloon.settings');
    }
}

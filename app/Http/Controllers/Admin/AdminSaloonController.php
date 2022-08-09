<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Saloon;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class AdminSaloonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function saloons()
    {
        $saloons = Saloon::all();
        return view('admin.saloons.index', compact('saloons'));
    }

    public function activation($saloon_id){
        $saloon = Saloon::find($saloon_id);
        return view('admin.saloons.activation', compact('saloon'));
    }

    public function activationStore(Request $request, $saloon_id){
        Saloon::find($saloon_id)->update([
            'status' => $request->status
        ]);
        return back();
    }

}

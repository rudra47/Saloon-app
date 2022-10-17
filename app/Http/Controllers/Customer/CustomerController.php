<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.profile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookings()
    {
        //$bookings = Booking::with(['users', 'saloon_services'])->where('user_id', auth()->user()->id)->get();
        $bookings = DB::table('bookings')
            ->leftJoin('saloon_services', 'bookings.saloon_service_id', '=', 'saloon_services.id')
            ->select('bookings.*', 'saloon_services.name')
            ->where('bookings.user_id', auth()->user()->id)
            ->where('bookings.status', '=', 0)
            ->get();
        //dd($bookings);
        return view('customer.booking', compact('bookings'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_bookings()
    {
        //$bookings = Booking::with(['users', 'saloon_services'])->where('user_id', auth()->user()->id)->get();
        $bookings = DB::table('bookings')
            ->leftJoin('saloon_services', 'bookings.saloon_service_id', '=', 'saloon_services.id')
            ->select('bookings.*', 'saloon_services.name')
            ->where('bookings.user_id', auth()->user()->id)
            ->where('bookings.status', '!=', 0)
            ->get();
        //dd($bookings);
        return view('customer.booking_all', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $this->validate($request, [
            'name'          => 'required|string|max:100',
            'email'         => 'required|string|max:50|unique:users,email,'.auth()->user()->id,
            'latitude'      => 'required|string|max:20',
            'longitude'     => 'required|string|max:20'
        ]);

        $user->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
        ]);

        flash('Profile Information Updated Successfully')->success();
        return redirect()->route('profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'old_password'  => 'required|string',
            'password'      => 'required|confirmed|min:8|max:50',
        ]);
 
        if ($user && Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password'   => Hash::make($request->password),
            ]);

            flash('Password Changed Successfully')->success();
            return redirect()->route('profile');
        }else{
            return back()->withErrors('Invalid password');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        flash('Booking Canceled Successfully')->success();

        return back();
    }

    public function confirmation($booking_id)
    {
        $booking = Booking::find($booking_id);
        return view('customer.bookings.confirmation', compact('booking'));
    }

    public function confirmationStore(Request $request, $booking_id)
    {
        $booking = Booking::find($booking_id);
        $booking->update([
            'transaction_no' => $request->transaction_no,
            'status' => 1
        ]);
        return redirect()->route('bookings');
    }
}

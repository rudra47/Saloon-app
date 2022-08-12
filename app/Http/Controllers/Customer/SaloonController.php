<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saloon;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class SaloonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.saloon.apply');
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
        $this->validate($request, [
            'name'          => 'required|string|max:100',
            'email'         => 'required|string|max:50|unique:saloons,email|unique:users,email',
            'phone'         => 'required|string|max:50|unique:saloons,phone',
            'latitude'      => 'required|string|max:20|unique:saloons,latitude',
            'longitude'     => 'required|string|max:20|unique:saloons,longitude',
            'address'       => 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'      => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'role_type'     => "saloon",
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'password'       => Hash::make($request->password)
        ]);
        $user_id = $user->id;

        $saloon = Saloon::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'user_id'       => $user_id,
            'phone'         => $request->phone,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'address'       => $request->address,
        ]);

        $image = $request->file('image');
        if ($image) {
            $imageName   = 'saloon_'.date("Ymdhi").'.'.$image->getClientOriginalExtension();

            if (file_exists('images/saloons/'.$imageName)) {
                unlink('images/saloons/'.$imageName);
            }

            if (!file_exists('images/saloons')) {
                mkdir('images/saloons', 0777, true);
            }
            $image->move(public_path('images/saloons'), $imageName);

        } else {
            $imageName = 'demo-saloon.jpg';
        }

        $saloon->image = $imageName;
        $saloon->save();

        $cover_image = $request->file('cover_image');
        if ($cover_image) {
            $cover_imageName   = 'saloon_cover_'.date("Ymdhi").'.'.$cover_image->getClientOriginalExtension();

            if (file_exists('images/saloons/'.$cover_imageName)) {
                unlink('images/saloons/'.$cover_imageName);
            }

            if (!file_exists('images/saloons')) {
                mkdir('images/saloons', 0777, true);
            }
            $cover_image->move(public_path('images/saloons'), $cover_imageName);

        } else {
            $cover_imageName = 'demo-saloon.jpg';
        }

        $saloon->cover_image = $cover_imageName;
        $saloon->save();

        flash('Application Submited Successfully! You will be notified very soon. Please wait.')->success();
        return redirect()->route('saloon.apply');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request)
    {
        $this->validate($request, [
            'service'    => 'required|int',
            'saloon_id'  => 'required|int',
        ]);

        Booking::create([
            'user_id'               => auth()->user()->id,
            'saloon_id'             => $request->saloon_id,
            'saloon_service_id'     => $request->service,
            'price'                 => $request->price,
        ]);

        flash('Booking Registered Successfully! Follow the satus of booking.')->success();
        return back();
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saloon = Saloon::find($id);
        $services = $saloon->services()->where('status', 1)->get();

        return view('customer.saloon.details', compact('saloon', 'services'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

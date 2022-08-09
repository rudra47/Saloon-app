<?php

namespace App\Http\Controllers\Saloon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Saloon\Service\CreateRequest;
use App\Models\Saloon;
use App\Models\SaloonService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $saloon = Saloon::where('user_id', auth()->user()->id)->first();
        $services = SaloonService::where('saloon_id', $saloon->id)->get();
        return view('saloon.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $saloon_id = Saloon::where('user_id', auth()->user()->id)->first()->id;
        return view('saloon.service.create', compact('saloon_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        SaloonService::create([
            'name' => $request->name,
            'price' => $request->price,
            'saloon_user_id' => auth()->user()->id,
            'saloon_id' => $request->saloon_id,
            'discount_type' => $request->discount_type,
            'discount_price' => $request->discount_price,
            'status' => $request->status,
        ]);
        flash('Service Added Successfully')->success();
        return redirect()->route('app.saloon.service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $service = SaloonService::find($id);
        return view('saloon.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        SaloonService::destroy($id);
        flash('Service Deleted Successfully')->success();
        return redirect()->route('app.saloon.service.index');
    }
}

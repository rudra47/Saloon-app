<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sell;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShipperProductStatusController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->from_date) && isset($request->to_date)){
            $from_date = $request->from_date;
            $to_date = $request->to_date;
        }else{
            $from_date = (new Carbon('today'))->subWeeks(4);
            $to_date = new Carbon('today');
        }
        $sells = Sell::query()
            ->orderBy('id', 'desc')
            ->whereBetween('created_at', [$from_date->format('Y-m-d')." 00:00:00", $to_date->format('Y-m-d')." 23:59:59"])
            ->with(['product'])
            ->whereIn('order_id', function($query){
                $query->select('id')
                    ->from((new Order)->getTable())
                    ->where('user_id', auth()->user()->id);
            })
            ->get();

        return view('shipper.productStatus.index');
    }
}

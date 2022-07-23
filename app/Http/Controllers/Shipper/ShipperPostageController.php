<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\PostageManagement;
use App\Models\StockManage;
use Illuminate\Http\Request;

class ShipperPostageController extends Controller
{
    public function postage()
    {
        return view('shipper.stocks.postage');
    }
}

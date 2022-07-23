<?php

namespace App\Http\Controllers\Shipper\Product;

use App\Http\Controllers\Controller;
use App\Models\StockManage;
use Illuminate\Http\Request;

class ShipperProductLabelController extends Controller
{
    public function index()
    {
        $stocks = StockManage::where('shipper_user_id', auth()->user()->id)
            ->select('product_id','product_name', 'quantity', 'label_quantity')
            ->orderBy('product_id', 'asc')
            ->get();
        return view('shipper.stocks.product-label', compact('stocks'));
    }
}

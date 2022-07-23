<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DeliveryOrderRequest;
use App\Models\Order;
use App\Models\OrderAssign;
use App\Models\PostageManagement;
use App\Models\Product;
use App\Models\Sell;
use App\Models\SellAssign;
use App\Models\StockManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipperOrderController extends Controller
{
    public function index(Request $request)
    {
        $orderAssigns = OrderAssign::with('order')->where('shipper_user_id', auth()->user()->id)->get();

        return view('shipper.order.index', compact('orderAssigns'));
    }

    public function viewOrder($order_assign_id)
    {
        $orderAssign = OrderAssign::with('order.userInfo')->where('id', $order_assign_id)->first();
        $sellAssigns = SellAssign::with('product', 'order')->where('order_assign_id', $order_assign_id)->get();
        return view('shipper.order.viewOrder', compact('sellAssigns','orderAssign'));
    }

    public function deliveryOrder(DeliveryOrderRequest $request, $order_assign_id)
    {
        $count = 0;
        if ($request->delivery_status == 'shipped'){
            if (count($request->product_id) > 0){
                foreach ($request->product_id as $key => $product_id){
                    $productStock = StockManage::where('product_id', $product_id)->where('shipper_user_id', auth()->user()->id)->first();
                    $postageStock = PostageManagement::where('shipper_user_id', auth()->user()->id)->first();
                    if (!is_null($productStock) && !is_null($postageStock)){
                        if ($productStock->quantity < $request->product_qty[$key] || $productStock->label_quantity < $request->product_qty[$key] || $postageStock->qty < 1) {
                            $count += 1;
                        }
                    }else{
                        $count += 1;
                    }
                    if (count($request->product_id) == $count){
                        flash('Hey '.auth()->user()->name.', it looks like you have no idea about your stock!!')->error();
                        return back();
                    }
                }

                foreach ($request->product_id as $key=>$product_id){
                    DB::beginTransaction();

                    $productStock = StockManage::where('product_id', $product_id)->where('shipper_user_id', auth()->user()->id)->first();
                    $postageStock = PostageManagement::where('shipper_user_id', auth()->user()->id)->first();

                    $orderAssign = OrderAssign::where('id', $order_assign_id)->where('shipper_user_id', auth()->user()->id)->first();
                    $sellAssign = SellAssign::where('order_assign_id', $order_assign_id)->where('shipper_user_id', auth()->user()->id)->where('product_id', $product_id)->first();
                    $sell = Sell::where('order_id', $orderAssign->order_id)->where('product_id', $product_id)->first();
                    $order = Order::where('id', $orderAssign->order_id)->first();

                    $orderAssign->update([
                        'shipper_status' => SellAssign::SHIPPED
                    ]);

                    if (!is_null($productStock) && !is_null($postageStock)){

                        if ($productStock->quantity < $request->product_qty[$key] || $productStock->label_quantity < $request->product_qty[$key] || $postageStock->qty < 1) {
                            $sellAssign->update([
                                'shipper_status' => SellAssign::BO
                            ]);
                            $sell->update([
                                'shipper_user_id' => null,
                                'is_set_shipper' => 0,
                                'admin_status' => Sell::BO
                            ]);
                            $order->update([
                                'admin_status' => Order::BO
                            ]);
                        }else{
                            $sellAssign->update([
                                'shipper_status' => SellAssign::SHIPPED
                            ]);
                            $sell->update([
                                'admin_status' => Sell::SHIPPED
                            ]);
                        }
                        if (is_null(Sell::where('order_id', $order->id)->where('admin_status', Sell::NOT_SHIPPED)->first())){
                            $order->update([
                                'admin_status' => Order::SHIPPED,
                                'customer_status' => Order::SHIPPED
                            ]);
                        }

                        $productStock->quantity -= $request->product_qty[$key];
                        $productStock->label_quantity -= $request->product_qty[$key];
                        $productStock->save();

                        $postageStock->qty -= 1;
                        $postageStock->save();
                    }else{
                        $sellAssign->update([
                            'shipper_status' => SellAssign::BO
                        ]);
                        $sell->update([
                            'shipper_user_id' => null,
                            'is_set_shipper' => 0,
                            'admin_status' => Sell::BO
                        ]);
                        $order->update([
                            'admin_status' => Order::BO
                        ]);
                    }

                    DB::commit();

                    flash('Order deliver successfully')->error();
                    return back();
                }
            }
        }else{
            flash('You are kidding.')->error();
            return back();
        }
    }
}

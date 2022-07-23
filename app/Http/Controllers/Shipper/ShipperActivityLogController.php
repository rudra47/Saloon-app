<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ShipperActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $activityLogsType = '';
        if (isset($request->activity_log_type)){
            $activityLogsType = $request->activity_log_type;
        }
        $activityLogs = ActivityLog::with('user', 'shipper')
            ->when($request, function ($query) use($request){
                if (isset($request->activity_log_type)){
                    $query->where('activity_log_type', $request->activity_log_type);
                }else{
                    $query->where('activity_log_type', ActivityLog::PRODUCT_QUANTITY_ASSIGN);
                }
            })
            ->where('model_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('shipper.activityLog.index', compact('activityLogs', 'activityLogsType'));
    }
}

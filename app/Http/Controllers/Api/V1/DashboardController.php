<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Package;
use App\Models\Service;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = array();
        $data['totalSale'] =  Order::sum('total_payment');
        $data['totalSaleToday'] = Order::whereDate('created_at', Carbon::today())->sum('total_payment');
        $data['totalPackages'] = Package::count();
        $data['totalServices'] = Service::count();
        $data['totalCustomer'] = User::count();
        $data['totalOrders'] = Order::count();
        $data['recentOrder'] = Order::query()->latest()->take(10)->get();

                return response()->json([
                    'data' => $data
                ]);
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\src\Models\Order;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class MyAccountController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->get();

        return view('web.pages.account.index')->with([
            'orders' => $orders,
        ]);
    }

}

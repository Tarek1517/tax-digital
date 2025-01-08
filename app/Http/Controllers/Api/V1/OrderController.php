<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\V1\OrderRequest;
use App\Http\Resources\V1\OrderResource;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()->with('packages')->get();

        return OrderResource::collection($orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        try {
            $session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $request->package_name, // Package name
                            ],
                            'unit_amount' => $request->total_payment * 100, // Amount in cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => env('APP_URL') . '/order-success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => env('APP_URL') . '/order-cancel?session_id={CHECKOUT_SESSION_ID}',
            ]);

            DB::beginTransaction();

            $order = Order::create(array_merge($data, [
                'order_code' => '#' . strtoupper(uniqid()),
                'checkout_session_id' => $session->id,
            ]));

            DB::commit();

            return response()->json(['url' => $session->url], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order_details = Order::with('packages')->findOrFail($id);
        return OrderResource::make($order_details);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_status' => 'required|in:pending,accept',
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return OrderResource::make($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the Request
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'payment_method' => 'required|in:card,cod',
            // Conditional validation for card
            'card_number' => 'required_if:payment_method,card',
            'card_expiry' => 'required_if:payment_method,card',
            'card_cvv' => 'required_if:payment_method,card',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Get Cart Data
        \Illuminate\Support\Facades\Log::info('OrderController store method called', ['session_id' => session()->getId(), 'cart' => session('cart')]);

        $cart = session('cart');

        // Fallback: Check if cart was sent in request (optional safety, though not standard practice)
        if (empty($cart)) {
            // For debugging: try to re-read from session explicitly
            session()->start();
            $cart = session()->get('cart', []);
        }

        if (empty($cart)) {
            \Illuminate\Support\Facades\Log::warning('Cart is empty in OrderController', ['session' => session()->all()]);
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty!'
            ], 400);
        }

        // 3. Calculate Totals
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
        }
        $shipping = 3.00; // Static for now
        $tax = 2.00;      // Static for now
        $total = $subTotal + $shipping + $tax;

        DB::beginTransaction();

        try {
            // 4. Create Order
            $order = Order::create([
                'user_id' => Auth::id(), // Nullable if guest
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->street_address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip_code' => null, // Add to form if needed
                'subtotal' => $subTotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'card' ? 'paid' : 'pending', // Mocking payment success for card
                'card_last4' => $request->payment_method === 'card' ? substr($request->card_number, -4) : null,
            ]);

            // 5. Create Order Items
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }

            // 6. Clear Cart
            session()->forget('cart');

            DB::commit();

            $thankYouHtml = view('partials.thankyou_modal', compact('order'))->render();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'html' => $thankYouHtml
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('thankyou', compact('order'));
    }
}

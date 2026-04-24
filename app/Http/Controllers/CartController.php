<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $id = $request->input('id', 1);
        $quantity = (int) $request->input('quantity', 1);

        $product = [
            "id" => $id,
            "name" => "Nupi Light Coffee Bag",
            "price" => 12.00,
            "quantity" => $quantity,
            "image" => "coffee_pouch_mockup.png"
        ];

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = $product;
        }

        session()->put('cart', $cart);
        session()->save();

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cartCount' => $this->calculateCartCount($cart),
            'item_quantity' => $cart[$id]['quantity']
        ]);
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $quantity = (int) $request->quantity;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
            session()->save();
        }

        return $this->getCartContent();
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->save();
        }

        return $this->getCartContent();
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        return response()->json(['cartCount' => $this->calculateCartCount($cart)]);
    }

    public function getCartContent()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'cart' => $cart,
            'totalCount' => $this->calculateCartCount($cart),
            'totalPrice' => $totalPrice
        ]);
    }

    private function calculateCartCount($cart)
    {
        return count($cart);
    }
}

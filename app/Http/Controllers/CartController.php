<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee;

class CartController extends Controller
{
    // 1. Show the Cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    // 2. Add to Cart (Includes Modal Quantity)
    public function add(Request $request, $id)
    {
        $coffee = Coffee::findOrFail($id);
        $cart = session()->get('cart', []);
        
        // Get the quantity from the modal form (default to 1 if not provided)
        $quantity = $request->input('quantity', 1);

        // If item exists, add the new quantity to the existing quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            // If item does not exist, add it to the cart array
            $cart[$id] = [
                "name" => $coffee->name,
                "quantity" => $quantity,
                "price" => $coffee->price,
                "image" => $coffee->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', $quantity . 'x ' . $coffee->name . ' added to cart!');
    }

    // 3. Update Cart Quantity
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    // 4. Remove from Cart
    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Coffee removed from cart!');
    }

    // 5. Checkout
    public function checkout()
    {
        // Clear the cart from the session
        session()->forget('cart');

        // Redirect back to the cart page with a success flag
        return redirect()->route('cart')->with('checkout_success', true);
    }
}

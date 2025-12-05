<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to view your cart');
        }

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('game')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    /**
     * Add a game to the cart.
     */
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'redirect' => route('login'),
                'message' => 'Please log in to add items to your cart'
            ]);
        }

        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
        ]);

        // Check if item already in cart
        $existingItem = Cart::where('user_id', Auth::id())
            ->where('game_id', $validated['game_id'])
            ->first();

        if ($existingItem) {
            return response()->json([
                'success' => false,
                'message' => 'This game is already in your cart'
            ]);
        }

        // Add to cart
        Cart::create([
            'user_id' => Auth::id(),
            'game_id' => $validated['game_id'],
            'quantity' => 1
        ]);

        $cartCount = Cart::where('user_id', Auth::id())->count();

        return response()->json([
            'success' => true,
            'count' => $cartCount,
            'message' => 'Game added to your cart'
        ]);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }
}
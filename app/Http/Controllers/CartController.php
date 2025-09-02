<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return Inertia::render('Cart/Index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Bu ürün artık satışta değil.'
            ], 400);
        }

        $identifier = $this->getCartIdentifier();
        
        $cartItem = Cart::where($identifier['key'], $identifier['value'])
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > 10) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maksimum 10 adet ekleyebilirsiniz.'
                ], 400);
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                $identifier['key'] => $identifier['value'],
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        $cartCount = $this->getCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepete eklendi.',
            'cartCount' => $cartCount
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        if (!$this->isUserCart($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Bu sepet öğesini değiştirme yetkiniz yok.'
            ], 403);
        }

        $cart->update(['quantity' => $request->quantity]);

        $total = $this->getCartItems()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return response()->json([
            'success' => true,
            'message' => 'Sepet güncellendi.',
            'total' => $total
        ]);
    }

    public function remove(Cart $cart)
    {
        if (!$this->isUserCart($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Bu sepet öğesini silme yetkiniz yok.'
            ], 403);
        }

        $cart->delete();

        $cartCount = $this->getCartCount();
        $total = $this->getCartItems()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepetten kaldırıldı.',
            'cartCount' => $cartCount,
            'total' => $total
        ]);
    }

    public function clear()
    {
        $identifier = $this->getCartIdentifier();
        
        Cart::where($identifier['key'], $identifier['value'])->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sepet temizlendi.',
            'cartCount' => 0,
            'total' => 0
        ]);
    }

    public function count()
    {
        $count = $this->getCartCount();
        
        return response()->json([
            'count' => $count
        ]);
    }

    private function getCartIdentifier()
    {
        if (Auth::check()) {
            return [
                'key' => 'user_id',
                'value' => Auth::id()
            ];
        } else {
            return [
                'key' => 'session_id',
                'value' => session()->getId()
            ];
        }
    }

    private function getCartItems()
    {
        $identifier = $this->getCartIdentifier();
        
        return Cart::with(['product' => function($query) {
            $query->where('is_active', true);
        }])
        ->where($identifier['key'], $identifier['value'])
        ->get()
        ->filter(function ($item) {
            return $item->product !== null;
        });
    }

    private function getCartCount()
    {
        $identifier = $this->getCartIdentifier();
        
        return Cart::whereHas('product', function($query) {
            $query->where('is_active', true);
        })
        ->where($identifier['key'], $identifier['value'])
        ->sum('quantity');
    }

    private function isUserCart(Cart $cart)
    {
        $identifier = $this->getCartIdentifier();
        
        return $cart->{$identifier['key']} == $identifier['value'];
    }
}
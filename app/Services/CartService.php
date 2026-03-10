<?php

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Models\CartItem;
use App\Models\Product;

class CartService implements CartServiceInterface
{
    public function getCart($userId)
    {
        return CartItem::where('user_id', $userId)
            ->with('product')
            ->get();
    }

    public function addItem($userId, $productId, $quantity)
    {
        $product = Product::findOrFail($productId);

        return CartItem::updateOrCreate(
            [
                'user_id' => $userId,
                'product_id' => $productId,
            ],
            [
                'quantity' => CartItem::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->value('quantity') ?? 0 + $quantity,
                'price' => $product->price,
            ]
        );
    }

    public function removeItem($userId, $cartItemId)
    {
        CartItem::where('id', $cartItemId)
            ->where('user_id', $userId)
            ->delete();
    }

    public function updateQuantity($userId, $cartItemId, $quantity)
    {
        CartItem::where('id', $cartItemId)
            ->where('user_id', $userId)
            ->update(['quantity' => $quantity]);
    }

    public function clearCart($userId)
    {
        CartItem::where('user_id', $userId)->delete();
    }

    public function getTotal($userId)
    {
        return CartItem::where('user_id', $userId)
            ->sum(\DB::raw('quantity * price'));
    }
}
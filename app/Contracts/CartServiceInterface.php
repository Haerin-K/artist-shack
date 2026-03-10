<?php

namespace App\Contracts;

interface CartServiceInterface
{
    public function getCart($userId);
    public function addItem($userId, $productId, $quantity);
    public function removeItem($userId, $cartItemId);
    public function updateQuantity($userId, $cartItemId, $quantity);
    public function clearCart($userId);
    public function getTotal($userId);
}
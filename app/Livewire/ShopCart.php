<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductChoice;
use App\Models\Variant;
use App\Models\InfoCollection;
use Illuminate\Support\Facades\Session;

class ShopCart extends Component
{
    public function render()
    {
        return view('livewire.shop-cart');
    }

        public function add($index)
    {
       
        $cart = Session::get('cart', []);

        if (isset($cart[$index])) {
            $cart[$index]['quantity']++;
        }

        Session::put('cart', $cart);
    }

    public function subs($index)
{
    $cart = Session::get('cart', []);

    if (isset($cart[$index])) {

        if ($cart[$index]['quantity'] > 1) {
            $cart[$index]['quantity']--;
        } else {
            $cart[$index]['quantity'] = 1;
        }

        Session::put('cart', $cart);
    }
}

public function remove($index)
{
    $cart = Session::get('cart', []);

    if (isset($cart[$index])) {
        unset($cart[$index]);
        Session::put('cart', $cart);
    }
}
public function removeCartItem($index)
    {



        unset($this->cart_items[$index]);
        $cart = array_values($this->cart_items); // reindex array
        $this->cart_items = $cart;
        session()->put('cart', $this->cart_items);
        $this->dispatch('cartUpdated');
    }
}

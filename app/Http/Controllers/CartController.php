<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // show cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftjoin('products','products.id','carts.product_id')

        ->where('carts.user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $list){
            $totalPrice += $list->pizza_price * $list->qty;
        }
        // dd($totalPrice);
        return view('user.main.cart',compact('cartList','totalPrice'));
    }
}

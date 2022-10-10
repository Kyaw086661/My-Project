<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return ajax pizza list
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status == 'desc'){
            $data =Product::orderBy('created_at','desc')->get();
        }else{
            $data =Product::orderBy('created_at','asc')->get();
        }

        return response()->json($data,200);
    }
    //return add to cart
    public function addToCard(Request $request){
        // logger($request->all());
        $data = $this->getOrderData($request);
        // logger($data);
        Cart::create($data);
        // return[
        //     'status' => 'success',
        //     'message' => 'Add to card success',
        // ];
        $response=[
            'message' => 'Add to card success',
            'status' => 'success',
        ];
        return response()->json($response,200);
    }

    // click proseed to check out for order
    public function order(Request $request){
        // logger($request->all());
        $total=0;
        foreach($request->all() as $item){
           $data = OrderList::create($item);

           $total += $data-> total;
        //    logger($total+2500);
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        // logger($data->order_code);
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+2500,
        ]);
        return response()->json([
            'message'=>'order complete',
            'status' => 'true',
             ], 200);
    }

    //clear order from cart when click claer order
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    //increase product view count
    public function increaseViewCount(Request $request){
        // logger($request->all());
        $pizza = Product::where('id',$request->productId)->first();
        $viewCount = ['view_count'=> $pizza->view_count + 1];
        Product::where('id',$request->productId)->update($viewCount);
    }
    // clear Current Product
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->cartId)
        ->delete();
    }

    // get order data into cart
    private function getOrderData($request){
        return[
            'user_id' => $request->userId,
           'product_id'=> $request->pizzaId,
            'qty' => $request->orderCount,
           'created_at'=>Carbon::now(),
           'updated_at'=>Carbon::now(),
        ];
    }
}

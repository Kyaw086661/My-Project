<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // order list form user
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')

        ->when(request('searchKey'),function($query){
            $query
            ->orWhere('order_code','like','%'.request('searchKey').'%');
            // ->orWhere('user_name','like','%'.request('searchKey').'%')
            // ->orWhere('created_at','like','%'.request('searchKey').'%')
            // ->orWhere('user_id','like','%'.request('searchKey').'%')
            // ->orWhere('total_price','like','%'.request('searchKey').'%')
            // ->orWhere('status','like','%'.request('searchKey').'%');

        })
        ->leftjoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')-> get();
        // $order->appends(request()->all());
        return view ('admin.order.list',compact('order'));
    }
    // ajax list status
    public function orderChangeStatus(Request $request){
        // dd($request->all());
        // $request->status = $request->status == null? "" : $request->status;

        // ->where('orders.status',$request->status)
        $order = Order::select('orders.*','users.name as user_name')
        ->leftjoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc');

        if($request->orderStatus == null){
           $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->get();
        }
        return view ('admin.order.list',compact('order'));
    }
    // customer order list change status with ajax
    public function changeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status,
        ]);

        $order = Order::select('orders.*','users.name as user_name')
        ->leftjoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')->get();
        return response()->json($order,200);

    }
    // order code list
    public function orderListCode($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
       $orderList = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
       ->leftjoin('users','users.id','order_lists.user_id')
       ->leftjoin('products','products.id','order_lists.product_id')
       ->where('order_code',$orderCode)
       ->get();
    //    dd($orderList->toArray());
       return view('admin.order.productList',compact('orderList','order'));
    }
}

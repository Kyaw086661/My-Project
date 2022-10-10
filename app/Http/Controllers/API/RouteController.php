<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all product list from pizza project
    public function productList(){
        $product = Product::get();
        return response()->json($product,200);
    }
    //get all product and user list
    public function productUserList(){
        $product = Product::get();
        $user = User::get();
        // get with key value
        $data = [
            'product' =>[
                'pizzaProduct' => $product
            ] ,
            'user' => $user,
        ];
        return response()->json($data,200);// အရင်ရေးတဲ့ return  ကအရင် ယူ
        // return $data['product']['pizzaProduct'][2]->name; // if you want to call name in product;

    }
    // get all categoryList
    public function categoryList(){
        $categoryList = Category::get();
        // return response()->json($categoryList,200);
        return response()->json($categoryList, 200);
    }

    // get oreder list
    public function orderList(){
        $orderList = OrderList::get();
        return response()->json($orderList, 200);
    }
    // get contactList
     public function contactList(){
        $contact = Contact::get();
        return response()->json($contact, 200);
     }

     // create catrgory with post method
     // there are header and body->form data in postman
     public function createCategory(Request $request){
        // dd($request->all()); // get data from body->form data not in header
        // dd($request->name); // get name only
        $data= [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        // return $data;
        $response = Category::create($data);
        return response()->json($response, 200);


        // get data in header
        // dd($request->header('headerdata'));
     }

     // create content with post mehtod
     public function createContent(Request $request){
        // return $request->all();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' =>$request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response = Contact::create($data);
        return response()->json($response, 200);
     }
     // delete categoty with POst Method
     public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        // return isset($data); // empty !empty isset
        // return empty($data);
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=>'true','message'=>'delete Success'], 200);
        }
        return response()->json(['status' => 'false','message'=>'there is no category for that id'], 200);
     }
     // delete category with GET Method
     public function categoryDelete($id){
        // return $id;
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>'true','message'=>'delete success','deleteData'=>$data],200);
        }
        return response()->json(['status'=>'false','message'=>'there is no category for that id'], 200);
     }

     // category detail with post method
     public function categoryDetails(Request $request){
       $data = Category::where('id',$request->category_id)->first();
       if(isset($data)){
        // Category::where('id',$request->category_id)->get();
        return response()->json(['category'=>$data], 200);
       }
       return response()->json(['status'=>'false','message'=>'there is no category for that id'], 200);
     }
    //  cagegory details with GET Methods
    public function DetailsCategory($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['category'=>$data], 200);
        }
        return response()->json(['status'=>'false','message'=>'there is no category'], 500);
    }

    // updat category
    public function categoryUpdate(Request $request){
        $categoryID = $request->category_id;
        $dbSource = Category::where('id',$categoryID)->first();
        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
            Category::where('id',$categoryID)->update($data);
            $updateData = Category::where('id',$categoryID)->first();
            return response()->json(['status'=>'true','message'=>'update success','category'=>$updateData], 200);
        }

        return response()->json(['status'=>'false','message'=>'there is no category'], 500);

    }
    // get category data
    private function getCategoryData($request){
        return [
            'name'=> $request->category_name,
            'updated_at'=>Carbon::now(),
        ];
    }
}

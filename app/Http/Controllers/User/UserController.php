<?php

namespace App\Http\Controllers\User;
use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home  pagee
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart= Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    // user filter for category
    public function filter($categoryId){
        // dd($categoryId);
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category= Category::get();
        $cart= Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    // user change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    // user change password directly
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
       $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue =$user->password;
      if(Hash::check($request->currentPassword,$dbHashValue)){
        $data =
       [
        'password'=> Hash::make($request->newPassword)
       ];
       User::where('id',Auth::user()->id)->update($data);
       return back()->with(['changeSuccess'=>'Your password have been changed...']);
      }
      return back()->with(['notMatch'=>'Your password does not match..']);

    }
    // user chang account page
    public function accountChangePage(){
        return view('user.profile.account');

    }
    // user direct change account
    public function accountChange($id,Request $request){

        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
             if($dbImage != null){
                Storage::delete('public/'.$dbImage);
             }
             $imageName = uniqid(). $request->file('image')->getClientOriginalName();
             $request->file('image')->storeAs('public',$imageName);
             $data['image']=$imageName;
        }
        User::where('id',$id)->update($data);
        return back()->with(['changeSuccess'=>'Your account have been changed...']);
    }

    // for pizza ditails to see  directily
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.pizzaDetails',compact('pizza','pizzaList'));
    }

    // user history page
    public function history(){
       $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }
    // direct contact to admin
    public function contactAdmin(){
        return view('user.content.contact');
    }
    // account validation check
    private function accountValidationCheck($request){
       Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'image'=>'mimes:jpeg,png,webp,jpg|file',
       ])->validate();
    }
    // get user data to change account
    private function getUserData($request){
        return[
            'name'=>$request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'gender'=> $request->gender,
            'address'=>$request->address,
            'created_at'=> Carbon::now(),
        ];
    }
    //password Validation Check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'currentPassword'=>'required|min:8|max:16',
            'newPassword'=>'required|min:8|max:16',
            'confirmPassword'=>'required|min:8|max:16|same:newPassword'
        ])->validate();
    }
}

<?php

namespace App\Http\Controllers;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // admin change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    // admin change pasword
    public function changePassword(Request $request){
        // dd($request->all());
        /*
            1. all fields must be fill
            2. new and confirm password length must be between 8 and 16
            3.new and confirm password must be same
            4.old password must be same with db stored password
        */
        $this->passwordValidationCheck($request);// validation စစ်
        $currentUserId = Auth::user()->id; // current user id ကို ရယူ
        $userData = User::select('password')->where('id',$currentUserId)->first();//
        // dd($userData->toArray());
        $dbHashedPassword = $userData->password;// hashed password form data base
        // dd($dbHashedPassword);
        if(Hash::check($request->currentPassword, $dbHashedPassword)){ // database ထဲက pass နဲ့ current pass တူစစ်
            $data =[
             'password' =>   Hash::make($request->newPassword),// new pss hashing
            ];
            User::where('id',Auth::user()->id)->update($data);// update လုပ် ပိး user table ထဲထည့်
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return redirect()->route('category#list')->with(['changeSuccess'=>'Your password have been changed.']);
        }
        return back()->with(['notMatch'=>"Current Password does't match . Please try again..."]);

    //    $hashedValue = Hash::make('kyawthu');
    //    if(Hash::check('kyawthu', $hashedValue)){
    //     dd('same password');
    //    }else{
    //     dd('incorret password');
    //    }
        // dd('changed password');
    }
    // admin account list
    public function adminList(){
        $admin = User::when(request('searchKey'),function($query){
            $query->orWhere('name','like','%'.request('searchKey').'%')
            ->orWhere('email','like','%'.request('searchKey').'%')
            ->orWhere('gender','like','%'.request('searchKey').'%')
            ->orWhere('phone','like','%'.request('searchKey').'%')
            ->orWhere('address','like','%'.request('searchKey').'%');
        })
        ->where('role','admin')->paginate(3);// account get admin only not user
        // dd($admin->toArray());
        $admin->appends(request()->all());

        return view('admin.account.adminList',compact('admin'));
    }
    //admin account delete
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => "Account deleted..."]);
    }
    // admin account change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }
    // direct change role
    public function change($id,Request $request){
        $data = $this->userDataRequest($request);
        User::where('id',$id)->update($data);
        return redirect(route('admin#list'));
    }
    // change admin and user role with ajax
    public function ajaxChangeRole(Request $request){
        // logger($request->all());
        User::where('id',$request->userId)->update([
            'role' => $request->role,
        ]);
    }
    // user account role data request
    private function userDataRequest($request){
        return[
            'role' => $request->role
        ];
    }
    //admin account details
    public function details(){
        return view('admin.account.details');
    }

    //direct admin account edit page
    public function edit(){
        return view ('admin.account.edit');
    }
    //account update
    public function update($id,Request $request){
        // dd($id,$request->all());
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //for image
        if($request->hasFile('image')){
            //old image name / check -> delete / store
            $dbImage = User::where('id',$id)->first();
            $dbImage =  $dbImage->image;
            // dd($dbImage);
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $imageName = uniqid(). $request->file('image')->getClientOriginalName();
            // dd($imageName);
            $request->file('image')->storeAs('public',$imageName);
            $data['image']= $imageName;
            // dd($data);
        }

        User::where('id',$id)->update($data);
        return redirect(route('admin#details'))->with(['accountUpdate'=>'account update successful..']);
    }


    // account user data
    private function getUserData($request){
       return[ 'name' => $request->name,
                'phone'=> $request->phone,

                'email' => $request->email,
                'gender' => $request->gender,
                'address' => $request->address,
                'updated_at' => Carbon::now(),

    ];
    }
    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'image' => 'mimes:png,jpg,jpeg,webp| file',
            'address'=>'required',
        ],[])->validate();
    }


    // password validation vheck
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'currentPassword'=>'required|min:8|max:16',
            'newPassword'=>'required|min:8|max:16',
            'confirmPassword'=>'required|min:8|same:newPassword',

        ],[
            // 'oldPassword.required' => 'lsdflskdjf'
        ])->validate();
    }
}

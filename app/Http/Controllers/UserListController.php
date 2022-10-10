<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    // user list from admin page
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.userList',compact('users'));
    }
    // user change role with ajax
    public function userChangeRole(Request $request){
        // logger($request->all());
        $updateData = [
            'role'=> $request->role,
        ];
        User::where('id',$request->userId)->update($updateData);

    }
    // delete user from admin
    public function userDelete($id){
        User::where("id",$id)->delete();
        return back();
    }
    public function userUpdate($id){
        $account = User::where('id',$id)->first();
        return view('admin.user.updateUser',compact('account'));
    }
    public function updateUserRole($id,Request $request){
        // dd($request->all());
        $data = $this->userDataRequest($request);
        User::where('id',$id)->update($data);
        return redirect(route('admin#userList'));

    }

     // user account role data request
     private function userDataRequest($request){
        return[
            'role' => $request->role,
            'gender'=>$request->gender,
        ];
    }
}

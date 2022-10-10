<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    // user directly contact to admin in user page;
    public function userContact(Request $request){
        // dd($request->all());
        $this->contactValidationCheck($request);
        $data = $this->requestContactMessage($request);
        Contact::create($data);
        return redirect(route('user#home'));

    }
    // user contact message read in admin page;
    public function userContactMessage(){
        $userMessage = Contact::orderBy('created_at','desc')->paginate(5);
        return view('admin.user.message',compact('userMessage'));
    }
    // delete contact message
    public function contactDelete($id){
        Contact::where('id',$id)->delete();
        return back();
    }
    // view contact message
    public function viewContact($id){
        $message = Contact::where('id',$id)->first();
        return view('admin.user.viewMessage',compact('message'));
    }


     // request contact message information
     private function requestContactMessage($request){
        return[
            'name' => $request->name,
            'email' => $request->email,
            'subject'=>$request->subject,
            'message' => $request->message,


        ];
    }
    // contact validation check
    private function contactValidationCheck($request){
        $validationRule = [
            'name' => 'required',
            'email' => 'required',
            'subject'=>'required',
            'message' => 'required|min:10',

        ];
        Validator::make($request->all(),$validationRule)->validate();
    }
}

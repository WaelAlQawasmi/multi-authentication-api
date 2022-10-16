<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function dashboard()
    {
        $users = admin::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function AdminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);
            
            $user = admin::select('admins.*')->find(auth()->guard('admin')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp',['user'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function rigister(Request $request){
        $data = $request->validate([ 'email' => 'required|email',
        'password' => 'required',
    'name' => 'required']);

         $data['password'] = bcrypt($request->password);

        $user = admin::create($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class userController extends Controller
{

    public function dashboard()
    {
        $users = Auth::user();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if (auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])) {

            config(['auth.guards.api.provider' => 'user']);

            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp', ['user'])->accessToken;

            return response()->json($success, 200);
        } else {
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function rigister(Request $request)
    {

        $validator = Validator::make($request->all(), $this->validation('rig'), $this->masseges('rig'));


        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = $request->validate($this->validation('rig'));

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        return response()->json(['info' => ['User account successfully created.']], 200);
    }



    protected function validation($used)
    {
        if ($used == 'login')
            return [
                'email' => 'required',
                'password' => 'required'
            ];
        else
            return [
                'email' => 'required|unique:users',
                'password' => 'required',
                'name' => 'required|max:255',
            ];
    }



    protected function masseges($used)
    {
        if ($used == 'login')
            return [
                'email.required' => 'We need to know your phone!',
                'password.required' => 'We need to know your password!',

            ];
        else
            return [
                'email.email' => 'please use email!',
                'email.unique:users' => 'alredy used!',
                'email.required' => 'We need to know your email!',
                'password.required' => 'We need to know your password!',
                'name.required' => 'We need to know your name!',
                'name.max:255' => 'must 255!',
            ];
    }
}

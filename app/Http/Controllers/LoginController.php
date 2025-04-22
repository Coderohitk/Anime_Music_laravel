<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function login(Request $request)
    {
            $userFound = UserModel::where('email', $request->post('email'))->where('password', md5($request->post('password')))->first();
    
            Session::put('id', $userFound->user_id);

        if($userFound){
            return redirect('/anime');
        }
    }
    public function logout(Request $request){
        Session::flush();
        return redirect('/login');
    }
    public function register(Request $request)
    {          
        $message = 'Registration failed! Please try again.';  
        $name = $request->post('name');
        $email = $request->post('email');
        $password = $request->post('password');

        // Hash the password
        $hashed_password = md5($password);
        try{
            $userAdded = UserModel::create([
                'username' => $name,
                'email' => $email,
                'password' => $hashed_password,
            ]);
        }catch(Exception $e){
            $message =  $e->getMessage();die;
        }
        if($userAdded){
            set_message('Registration successful! You can now log in.', 'success');
            return redirect('/login');
        }
        set_message($message, 'danger');
        return redirect('/register');
    }
}
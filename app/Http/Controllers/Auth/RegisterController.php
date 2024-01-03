<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Image;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //init 
        $avatar="user.png";
        $request=request();
        //if the user has a avatar to upload
        
        if($request->hasFile('avatar')){
       
                $filename = $request->file('avatar');
                $avatar=rand(). '.' . $filename->getClientOriginalExtension();
                Image::make($filename)->resize(300, 300)->save( public_path('/uploads/users/' . $avatar ));

            }
            
              // generate a random password for the user
            $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890#&@!$';
             $pass = array(); 
             $combLen = strlen($comb) - 1; 
             for ($i = 0; $i < 8; $i++) {
                 $n = rand(0, $combLen);
                 $pass[] = $comb[$n];
             }
              $passw=implode($pass);

              $email = $data['email'];
              $name = $data['name'];
              $password= Hash::make($passw);
              
              $user = array('name'=>$name,
                      'email'=>$email,
                      'pass'=>$password);
   
          Mail::send(['html'=>'mail'], $user, function($message) {
             $message->to('sydneymondestin@gmail.com', 'Nouveau Utilisateur')->subject
                ('Bridge identification ');
             $message->from('no-reply@consulat-benin-pnr.org','Consulat du Bénin à Pointe-Noire');
          });
      
        
            User::create([
            'name' => $data['name'],
            'status' => $data['status'],
            'level' => $data['level'],
            'email' => $data['email'],
            'avatar' => $avatar,
            'password' => Hash::make($data['password']),
        ]);
      
        return back()->with('success', 'Utilisateur ajouté avec succès');
    }
}

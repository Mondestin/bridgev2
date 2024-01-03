<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $levelStatus=Auth::user()->level;
        //verify if the user is an admin or not
       if ($levelStatus=="admin" || $levelStatus=="super-admin") {
           $data=User::all();
           return view('users.index',compact('data'));
       }
       else{
         return redirect()->to('/home');
       }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levelStatus=Auth::user()->level;

       // check if the user is an admin
        if ($levelStatus=="admin" || $levelStatus=="super-admin") {

             return view('users.register');
        }
        else{
               return redirect()->route('users.index')->with(
                    'error',
                    'Vous avez pas acces à ce niveau');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);


       //init
        $avatar="user.png";
        $email="";
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

              $email = $request['email'];
              $name = $request['name'];
              $password= Hash::make($passw);

              $user = array('name'=>$name,
                      'email'=>$email,
                      'pass'=>$passw);
               Mail::to($email)->send(new \App\Mail\SendMail($user));


            User::create([
            'name' => $request['name'],
            'status' => $request['status'],
            'level' => $request['level'],
            'email' => $request['email'],
            'avatar' => $avatar,
            'password' => $password,
        ]);

       return redirect()->route('users.index')->with(
                    'success',
                    'Utilisateur crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('users.profile',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $levelStatus=Auth::user()->level;

        // check if the user is an admin
         if ($levelStatus=="admin" || $levelStatus=="super-admin") {

            $data=User::findOrFail($id);
            return view('users.update',compact('data'));
         }
         else{
                return redirect()->route('users.index')->with(
                     'error',
                     'Vous avez pas acces à ce niveau');
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //process
        $request->validate([
            'name'         =>  'required',
            'email'        =>  'required',
        ]);

         //if the user has a avatar to upload
        if($request->hasFile('avatar')){
            // find and remove the old picture from files
            $data=User::findOrFail($id);
            File::delete(public_path('/uploads/users/' .  $data->avatar));

            $avatar = $request->file('avatar');
            $filename =rand() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/users/' . $filename ) );
        }
        else{
            $data=User::findOrFail($id);
            $filename=$data->avatar;
        }
        //put all user info into an array
        $user_form = array(
        'name'          =>  $request->name,
        'email'         =>  $request->email,
        'level'         =>  $request->level,
        'status'        =>  $request->status,
        'avatar'        =>  $filename,
        );
         $data=User::whereId($id)->update($user_form);
        return redirect()->route('users.index')->with(
                        'success',
                        'Utilisateur a été actualisé avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas=User::whereId($id)->delete();

          return redirect()->route('users.index')
                        ->with('success', 'Utilisateur supprimé avec succès');
    }

    public function updateUser(Request $request, $id)
    {

        //validate
        $request->validate([
            'name'         =>  'required',
            'email'        =>  'required',
        ]);

         //if the user has a avatar to upload
        if($request->hasFile('avatar')){
            // find and remove the old picture from files
            $data=User::findOrFail($id);
            File::delete(public_path('/uploads/users/' .  $data->avatar));

            // save the new picture
            $avatar = $request->file('avatar');
            $filename =rand() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/users/' . $filename ) );
        }
        else{
            // get and save the same picture
            $data=User::findOrFail($id);
            $filename=$data->avatar;
        }
        //put all user info into an array
        $user_form = array(
            'name'          =>  $request->name,
            'email'         =>  $request->email,
            'avatar'        =>  $filename,
            );
        //check if the user want to change the password
        if($request->password !=null || $request->password_actuel != null || $request->password_confirmation != null){
            $hashedPassword=Auth::user()->getAuthPassword();
            // check if the user submitted the right password
            if (Hash::check($request->password_actuel, $hashedPassword)) {
                // if The passwords match validate the password length
                    $request->validate([
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);
                        //add the password in the array of the form
                        $user_form['password']=Hash::make($request->password);
                        // update the user info
                        $data=User::whereId($id)->update($user_form);
                        return redirect()->route('users.index')->with(
                                        'success',
                                        'Utilisateur a été actualisé avec succès');
            }
            else {
                return redirect()->back()->with(
                    'error',
                    'le mot de passe actuel est incorrect');
            }
        }
        $data=User::whereId($id)->update($user_form);
        return redirect()->route('users.index')->with(
                        'success',
                        'Utilisateur a été actualisé avec succès');

    }

    //restore user password
   public function restore(Request $request, $id)
   {
         // generate a random new password for the user
         $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890#&@!$';
         $pass = array();
         $combLen = strlen($comb) - 1;
         for ($i = 0; $i < 8; $i++) {
             $n = rand(0, $combLen);
             $pass[] = $comb[$n];
         }
          $passw=implode($pass);
          $password= Hash::make($passw);

          //find the user info
          $data=User::findOrFail($id);

          $user = array('name'=>$data->name,
                'email'=>$data->email,
                'pass'=>$passw);
            $usermail=$data->email;
          // send maill of the new password to the user
           Mail::to($usermail)->send(new \App\Mail\Resetpassword($user));
        //  update the new password to
            User::whereId($id)->update(['password' => $password]);

         return redirect()->route('users.index')->with(
                'success',
                'le mot de password a été réinitialié avec succès');
   }

//function to go straight to the
   public function users(Request $request)
    {
        $levelStatus=Auth::user()->level;
        $passAdmin=Auth::user()->password;
       // check if the user is an admin
        if ($levelStatus=="admin" || $levelStatus=="super-admin") {

           $data=User::all();
           return view('users.index',compact('data'));
        }
        else{
               return redirect()->route('users.index')->with(
                    'error',
                    'Vous avez pas acces à ce niveau');
        }
    }

}

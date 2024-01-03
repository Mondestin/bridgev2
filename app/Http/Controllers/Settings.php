<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestionsCitoyens;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
use App\User;
use Auth;
use App\LasserPasser;
use App\Naissances;
use App\Frais;
use App\Ventes;
use Image;

class Settings extends Controller
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
    public function index()
    {   $id=1;
        $levelStatus=Auth::user()->level;
       
        // check if the user is an admin
         if ($levelStatus=="admin" || $levelStatus=="super-admin") {
 
            $data=Frais::findOrFail($id);
            return view('settings.index',compact('data'));
         }
         else{
                return redirect()->route('users.index')->with(
                     'error',
                     'Vous avez pas acces à ce niveau');
         }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=1;
        $userName=rand();
           //if the user has a avatar to upload
           if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename =$userName . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/sign/' . $filename ) );

                $datas= array(
                        'avatar'        =>  $filename,
                        );
                $save=Frais::whereId($id)->update($datas);
                return redirect()->route('settings.index')->with(
                    'success',
                    'Les informations ont été modifiés avec succes');
            }
            else{

                return redirect()->route('settings.index')->with(
                    'success',
                    'Les informations ont été modifiés avec succes');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $admin=Auth::user()->level;
        if ($admin="admin") {
           $datas=$request->all();
           $save=Frais::whereId($id)->update($datas);
           return redirect()->route('settings.index')->with(
                    'success',
                    'Les informations ont été modifiés avec succes');
        }
        else{
            return redirect()->route('settings.index')->with(
                    'error',
                    'Vous ne pouvez pas modifié ces informations');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

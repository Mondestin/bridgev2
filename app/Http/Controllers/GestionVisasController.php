<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestionsCitoyens;
use Auth;
use Image;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
use App\GestionVisas;
use App\Visas;
class GestionVisasController extends Controller
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
    {
        $data=GestionVisas::all();
       return view('visaDem.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visaDem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $byUser=Auth::user()->name;
        $request->validate([
            // CITOYENS VALIDATIONS
            'surname'           =>  'required',
            'name'              =>  'required',
            'dob'               =>  'required',
            'pofbirth'          =>  'required',
            'type'              =>  'required',
            'sexe'              =>  'required',
            'nationality'       =>  'required',
            'mother'            =>  'required',
            'father'            =>  'required',
            'profession'        =>  'required',
            'taille'            =>  'required',
            'eye_color'         =>  'required',
            'cheuveux'          =>  'required',
            'pa_sign'           =>  'required',
            'addressFirstCountry'=>  'required', 
            'addressSecondCountry' =>  'required',
            'tuteur'            =>  'required',
            'phone'             =>  'required',
            'id_number'         =>  'required',
            'date_emission'     =>  'required',
            'date_expiration'   =>  'required',
            'place_emission'    =>  'required',
        ]);

        $userName=$request->id_number;
        $check=GestionVisas::where("id_number","LIKE", "%{$userName}%")->get();

        //the cityoen is already registered
        if (sizeof($check)>0) {
             return redirect()->route('visa-demand.create')->with(
                    'error',
                    'Le demandeur existe déja');
            }
        else{
               //if the user has a avatar to upload
           if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename =$userName . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/askers/' . $filename ) );
            }
            else{
                 $filename="user.png";
            }
                // GET CITOYEN DATA FROM THE FORM
                $demand_form = array(
                    'avatar'            =>  $filename,
                    'surname'           =>  $request->surname,
                    'name'              =>  $request->name,
                    'dob'               =>  $request->dob,
                    'type'              =>  $request->type,
                    'durée'             =>  $request->durée,
                    'pofbirth'          =>  $request->pofbirth,
                    'sexe'              =>  $request->sexe,
                    'nationality'       =>  $request->nationality,
                    'mother'            =>  $request->mother,
                    'father'            =>  $request->father,
                    'profession'        =>  $request->profession,
                    'coutume'           =>  $request->coutume,
                    'taille'            =>  $request->taille,
                    'eye_color'         =>  $request->eye_color,
                    'cheuveux'          =>  $request->cheuveux,
                    'pa_sign'           =>  $request->pa_sign,
                    'addressFirstCountry'=> $request->addressFirstCountry, 
                    'addressSecondCountry' =>  $request->addressSecondCountry,
                    'tuteur'            =>  $request->tuteur,
                    'phone'             =>  $request->phone,
                    'id_number'         =>  $request->id_number,
                    'date_emission'     =>  $request->date_emission,
                    'date_expiration'   =>  $request->date_expiration,
                    'place_emission'    =>  $request->place_emission,
                    'byUser'            =>  $byUser,
                    );
            // save new citoyen
            $data = GestionVisas::create($demand_form);
            return redirect()->route('visa-demand.index')->with(
                    'success',
                    'Le demandeur a été ajouté avec succès');
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
            // find the citoyen using his unique id number
        $data=GestionVisas::findOrFail($id);
        return view('visaDem.profile',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the citoyen using his unique id number
        $data=GestionVisas::findOrFail($id);
        return view('visaDem.update',compact('data'));
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
          $byUser=Auth::user()->name;
        $request->validate([
            // CITOYENS VALIDATIONS
            'surname'           =>  'required',
            'name'              =>  'required',
            'dob'               =>  'required',
            'pofbirth'          =>  'required',
            'sexe'              =>  'required',
            'type'              =>  'required',
            'nationality'       =>  'required',
            'mother'            =>  'required',
            'father'            =>  'required',
            'profession'        =>  'required',
            'taille'            =>  'required',
            'eye_color'         =>  'required',
            'cheuveux'          =>  'required',
            'pa_sign'           =>  'required',
            'addressFirstCountry'=>  'required', 
            'addressSecondCountry' =>  'required',
            'tuteur'            =>  'required',
            'phone'             =>  'required',
            'id_number'         =>  'required',
            'date_emission'     =>  'required',
            'date_expiration'   =>  'required',
            'place_emission'    =>  'required',
        ]);
        $userName=$request->id_number;
           //if the user has a avatar to upload
           if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename =$userName . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/askers/' . $filename ) );
            }
            else{
                
                 $user=GestionVisas::findOrFail($id);
                 $filename=$user->avatar;
            }
             // GET DEMANDER DATA FROM THE FORM
                $form = array(
                    'avatar'            =>  $filename,
                    'surname'           =>  $request->surname,
                    'name'              =>  $request->name,
                    'dob'               =>  $request->dob,
                    'pofbirth'          =>  $request->pofbirth,
                    'sexe'              =>  $request->sexe,
                    'type'              =>  $request->type,
                    'durée'             =>  $request->durée,
                    'nationality'       =>  $request->nationality,
                    'mother'            =>  $request->mother,
                    'father'            =>  $request->father,
                    'profession'        =>  $request->profession,
                    'taille'            =>  $request->taille,
                    'eye_color'         =>  $request->eye_color,
                    'cheuveux'          =>  $request->cheuveux,
                    'pa_sign'           =>  $request->pa_sign,
                    'addressFirstCountry'=> $request->addressFirstCountry, 
                    'addressSecondCountry' =>  $request->addressSecondCountry,
                    'tuteur'            =>  $request->tuteur,
                    'phone'             =>  $request->phone,
                    'id_number'         =>  $request->id_number,
                    'date_emission'     =>  $request->date_emission,
                    'date_expiration'   =>  $request->date_expiration,
                    'place_emission'    =>  $request->place_emission,
                    'byUser'            =>  $byUser,
                    );
            // save new citoyen
            $citoyen = GestionVisas::whereId($id)->update($form);
            return redirect()->route('visa-demand.index')->with(
                    'success',
                    'Demandeur actualisé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Visas::where("dem_no","LIKE", "%{$id}%")->get();
        // check the demander 
        if (sizeof($data)>0) {
            return redirect()->route('visa-demand.index')
                        ->with('error', 'Le demandeur est associé à un visa');
        }
        //delete
        else{
          $datas=GestionVisas::where("id_number","LIKE", "%{$id}%");
         $datas->delete();
          return redirect()->route('visa-demand.index')
                        ->with('success', 'Le demandeur a été éffacé avec succès');
        }
        //return $data;
    }
}

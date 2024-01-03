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
class VisasController extends Controller
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
          //get all consular cards made and associated to people
       $data=DB::table('gestion_visas')
                    ->join('visas','gestion_visas.id','=','visas.dem_no')
                    ->select('gestion_visas.*','visas.*')
                    ->get();
       return view('visas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
     //CHECK IF THE DEMANDER ALREADY HAS A VISA FOR THAT SPECIFIC DEMAND
        // $askers=DB::table('gestion_visas')
        //         ->select('gestion_visas.*')
        //->whereNotIn('gestion_visas.id',DB::table('visas')->pluck('visas.dem_no'))
        //         ->get();
       $askers=GestionVisas::where("status","LIKE","%Validé%")
                                ->where("dem_status","LIKE","%Attente%")->get();

         $data="";
        return view('visas.create',compact('askers','data'));
        // return $askers;
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
        $id=$request->id_number;
        $request->validate([
            //VALIDATIONS
            'date_emission'   =>  'required',
            'depart'          =>  'required',
            'passport_no'     =>  'required',
            'motif'           =>  'required',
            'deliver_place'   =>  'required',
            'go_wirh'         =>  'required',
            
        ]);

         $demand_form = array(
                    'dem_no'            =>  $request->id_number,
                    'date_emission'     =>  $request->date_emission,
                    'depart'            =>  $request->depart,
                    'date_expiration'   =>  $request->date_expiration,
                    'status_visa'       =>  $request->status_visa,
                    'passport_no'       =>  $request->passport_no,
                    'motif'             =>  $request->motif,
                    'deliver_place'     =>  $request->deliver_place,
                    'go_wirh'           =>  $request->go_wirh,
                    'byUser'            =>  $byUser,
                    );
        //for Gestion Visa table
        $up=array('dem_status' => 'Etablit', );
        //update gestion carte consulaire table status
        $update=GestionVisas::whereId($id)->update($up);

            $data = Visas::create($demand_form);
            return redirect()->route('visas.index')->with(
                    'success',
                    'Le visa a été généré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //get all the asker without visa
        // $askers=DB::table('gestion_visas')
        //         ->select('gestion_visas.*')
        //         ->whereNotIn('gestion_visas.id',DB::table('visas')->pluck('visas.dem_no'))
        //         ->get();
        $askers=GestionVisas::where("status","LIKE","%Validé%")
                            ->where("dem_status","LIKE","%Attente%")->get();
        // find the asker using his unique id number
        $data=GestionVisas::findOrFail($request->id);
        return view('visas.create',compact('data','askers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // init
         $name="";
         $id_number="";
         $surname="";
         $type="";
         $motif="";
         $avatar="";
         $eye_color="";
         $cheuveux="";
         $pa_sign="";
         $date_emission="";
         $date_expiration="";
         $depart="";
         $deliver_place="";
         $go_wirh="";
         $status_visa="";
         $dem_no="";
         $durée="";
        // find the visa using his unique apply id
        $data=DB::table('gestion_visas')
                ->join('visas','gestion_visas.id','=','visas.dem_no')
                    ->select('gestion_visas.*','visas.*')
                    ->where("visas.dem_no","=","{$id}")
                    ->get();

         //get all the values needed in the  array
         foreach ($data as $key => $value) {
             $dem_no=$value->dem_no;
             $name=$value->name;
             $type=$value->type;
             $id_number=$value->id_number;
             $surname=$value->name;
             $avatar=$value->avatar;
             $eye_color=$value->eye_color;
             $cheuveux=$value->cheuveux;
             $pa_sign=$value->pa_sign;
             $date_emission=$value->date_emission;
             $date_expiration=$value->date_expiration;
             $depart=$value->depart;
             $deliver_place=$value->deliver_place;
             $go_wirh=$value->go_wirh;
             $status_visa=$value->status_visa;
             $durée=$value->durée;
             $motif=$value->motif;
         }
         return view('visas.update',compact('id','id_number','name','surname','avatar','eye_color','cheuveux','pa_sign','date_emission','date_expiration','depart','deliver_place','go_wirh','dem_no','status_visa','type','durée','motif'));
         //return $data;
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
            //VALIDATIONS
            'type'            =>  'required',
            'date_emission'   =>  'required',
            'depart'          =>  'required',
            'motif'           =>  'required',
            'go_wirh'         =>  'required',
            
        ]);
     $dem_no = $request->id_number;
         $visa_form = array(
                    'type'              =>  $request->type,
                    'durée'             =>  $request->durée,
                    'date_emission'     =>  $request->date_emission,
                    'depart'            =>  $request->depart,
                    'date_expiration'   =>  $request->date_expiration,
                    'status_visa'       =>  $request->status_visa,
                    'passport_no'       =>  $request->passport_no,
                    'motif'             =>  $request->motif,
                    'deliver_place'     =>  $request->deliver_place,
                    'go_wirh'           =>  $request->go_wirh,
                    'byUser'            =>  $byUser,
                    );
            // update visa information
            $visa = Visas::where("dem_no","=","{$dem_no}")->update($visa_form);
            return redirect()->route('visas.index')->with(
                    'success',
                    'Le visa a été actualisé avec succès');
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data=Visas::where("dem_no","LIKE", "%{$id}%");
         $data->delete();
              return redirect()->route('visas.index')->with(
                    'success',
                    'Le visa a été supprimé avec succès');
    }
}

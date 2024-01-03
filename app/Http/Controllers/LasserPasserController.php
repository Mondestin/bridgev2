<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\LasserPasser;
use App\GestionsCitoyens;
use App\Exports\PassExport;
use Illuminate\Http\Request;
use App\GestionCartesConsulaire;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LasserPasserController extends Controller
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
        //init
        $print="";
        $see="";
        $date1="";
        $date2="";
         //get all pass-card made and associated to people
       $data=DB::table('gestions_citoyens')
                    ->join('lasser_passers','gestions_citoyens.citoyen_no','=','lasser_passers.id_number')
                    ->select('gestions_citoyens.*','lasser_passers.*')
                    ->get();

        return view('pass.index', compact('data','date1','date2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $citoyens=GestionsCitoyens::all();
        $data="";
        return view('pass.nouveau',compact('citoyens','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $userName="";
        // check all requied inputs
        $byUser=Auth::user()->name;
        // $request->validate([
        //     // CARD VALIDATIONS
        //     'date_emission'      =>  'required',
        //     'date_expiration'    =>  'required',

        // ]);
        // generate a laissez passer code
        $year=Date('Y');
        $code=rand(100,999).Date('d')."/CGHBC/".$year;
        
        
        $userName=$request->id_number;

        $form = array(
            'id_number'         =>  $userName,
            'laisse_no'         =>  $code,
            'date_emission'     =>  $request->date_emission,
            'date_expiration'   =>  $request->date_expiration,
            'link_with'         =>  $request->link_with,
            'byUser'            =>  $byUser,
        );
           // create new citoyen pass card
            $pass = LasserPasser::create($form);
            return redirect()->route('pass.index')->with(
                'success',
                'Le laissez-passer a été crée avec succès');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //get all the citoyen
        $citoyens=GestionsCitoyens::all();
        // find the citoyen using his unique id number
        $data=GestionsCitoyens::findOrFail($request->id);
        return view('pass.nouveau',compact('data','citoyens'));
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
         $date_blocked="";
         $motif="";
         $avatar="";
         $eye_color="";
         $cheuveux="";
         $pa_sign="";
         $date_emission="";
         $date_expiration="";
         $voyage="";
         $validity="";
         $link_with="";
         $print_status="";

          //get all consular cards made and associated to people
       $data=DB::table('gestions_citoyens')
                    ->join('lasser_passers','gestions_citoyens.citoyen_no','=','lasser_passers.id_number')
                    ->select('gestions_citoyens.*','lasser_passers.*')
                    ->where("lasser_passers.id","=","{$id}")
                    ->get();
        //get all the values needed in the  array
         foreach ($data as $key => $value) {
             $name=$value->name;
             $id_number=$value->id_number;
             $surname=$value->surname;
             $avatar=$value->avatar;
             $eye_color=$value->eye_color;
             $cheuveux=$value->cheuveux;
             $pa_sign=$value->pa_sign;
             $date_emission=$value->date_emission;
             $date_expiration=$value->date_expiration;
             $voyage=$value->voyage;
             $validity=$value->validity;
             $link_with=$value->link_with;
         }
         return view('pass.update', compact('id','id_number','name','surname','avatar','eye_color','cheuveux','pa_sign','date_emission','date_expiration','voyage','validity','link_with'));
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
        $request->validate([
            // card VALIDATIONS
            'date_emission'     =>  'required',

            ]);
            // get the values
            $data = array(
            'date_emission'     =>  $request->date_emission,
            'date_expiration'   =>  $request->date_expiration,
            'link_with'         =>  $request->link_with,
             );
        // update the card info
        $update = LasserPasser::whereId($id)->update($data);
        return redirect()->route('pass.index')->with(
                    'success',
                    'Le laissez-passer a été actualisé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $data=LasserPasser::whereId($id);
         $data->delete();
              return redirect()->route('pass.index')->with(
                    'success',
                    'Le laissez-passer a été supprimé avec succès');
    }

    public function print($id)
    {

          $data=DB::table('lasser_passers')
                    ->join('gestions_citoyens','gestions_citoyens.citoyen_no','=','lasser_passers.id_number')
                    ->select('gestions_citoyens.*','lasser_passers.*')
                    ->where("lasser_passers.id","LIKE","%{$id}%")
                    ->first();
              return view('pass.print', compact('data'));
    }

    // export to excel
    public function getExcel()
    {
        return Excel::download(new PassExport, 'liste_des_lassez_passer.xlsx');
    }

    public function find(Request $request)
    {
        //init
        $date1=$request->date1;
        $date2=$request->date2;
        $print="";
        $see="";
         //get all pass-card made and associated to people
       $data=DB::table('gestions_citoyens')
       ->join('lasser_passers','gestions_citoyens.citoyen_no','=','lasser_passers.id_number')
       ->select('gestions_citoyens.*','lasser_passers.*')
       ->whereBetween('lasser_passers.created_at', [$date1, $date2])
       ->get();
        return view('pass.index', compact('data','date1','date2'));
    }

}

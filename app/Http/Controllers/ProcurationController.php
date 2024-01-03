<?php

namespace App\Http\Controllers;

use Auth;
use App\Procurations;
use App\GestionsCitoyens;
use App\GestionCartesConsulaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportProcurations;
use Maatwebsite\Excel\Facades\Excel;

class ProcurationController extends Controller
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
         $auths=Procurations::all();
         $date1="";
         $date2="";
        return view('procurations.index', compact('auths','date1','date2'));
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
        return view('procurations.create',compact('citoyens','data'));
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
            // VALIDATIONS
            'surname'    =>  'required',
            'b_surname'     =>  'required',
            'b_name'        =>  'required',
            'b_id_number'   =>  'required',
            'b_adresse'     =>  'required',
            'b_contact'     =>  'required',
            'pouvoir'       =>  'required',
            'b_id_etablit'  =>  'required',
            'b_id_expire'   =>  'required',
            
        ]);

     // GET DATA FROM THE FORM
        $form = array(
            'citoyen_id'    =>  $request->id_number,
            'b_surname'     =>  $request->b_surname,
            'b_name'        =>  $request->b_name,
            'b_id_number'   =>  $request->b_id_number,
            'b_adresse'     =>  $request->b_adresse,
            'b_contact'     =>  $request->b_contact,
            'pouvoir'       =>  $request->pouvoir,
            'b_id_etablit'  =>  $request->b_id_etablit,
            'b_id_expire'   =>  $request->b_id_expire,
            'byUser'        =>  $byUser,
            );
            // save new authorisaton
            $data = Procurations::create($form);
            return redirect()->route('procurations.index')->with(
                    'success',
                    'La demande a été enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
         //get all the citoyens
        $citoyens=GestionsCitoyens::all();
        // find the citoyen using his unique id number
        $data=GestionsCitoyens::findOrFail($request->id);
        return view('procurations.create',compact('data','citoyens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the procurations using his unique id number
        $data=Procurations::findOrFail($id);
        // get the citoyen data from the table
        $datas=GestionsCitoyens::firstWhere("citoyen_no", $data->citoyen_id);

         return view('procurations.edit',compact('data','datas'));

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
            // VALIDATIONS
            'surname'    =>  'required',
            'b_surname'     =>  'required',
            'b_name'        =>  'required',
            'b_id_number'   =>  'required',
            'b_adresse'     =>  'required',
            'b_contact'     =>  'required',
            'pouvoir'       =>  'required',
            'b_id_etablit'  =>  'required',
            'b_id_expire'   =>  'required',
            
        ]);
          
     // GET DATA FROM THE FORM
        $form = array(
            'citoyen_id'    =>  $request->id_number,
            'b_surname'     =>  $request->b_surname,
            'b_name'        =>  $request->b_name,
            'b_id_number'   =>  $request->b_id_number,
            'b_adresse'     =>  $request->b_adresse,
            'b_contact'     =>  $request->b_contact,
            'pouvoir'       =>  $request->pouvoir,
            'b_id_etablit'  =>  $request->b_id_etablit,
            'b_id_expire'   =>  $request->b_id_expire,
            'byUser'        =>  $byUser,
            );
            // update procurations
            $data = Procurations::whereId($id)->update($form);
            return redirect()->route('procurations.index')->with(
                    'success',
                    'Les informations ont été actualisé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Procurations::whereId($id)->delete();
              return redirect()->route('procurations.index')->with(
                    'success',
                    'Les data ont été supprimé avec succès');
    }
        /**
     * Print the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
      // find the procurations using his unique id number
        $data=Procurations::findOrFail($id);
        // get the citoyen data from the table
        $datas=GestionsCitoyens::firstWhere("citoyen_no", $data->citoyen_id);
        $dCard=GestionCartesConsulaire::firstWhere("id_number", $data->citoyen_id);

  ;
         return view('procurations.print',compact('data','datas', 'dCard'));  
    }
    // export to excel
    public function getExcel()
    {
        return Excel::download(new ExportProcurations, 'liste_des_procurations.xlsx');
    }
    public function find(Request $request)
    {
        //init
        $date1=$request->date1;
        $date2=$request->date2;
        $print="";
        $see="";
         //get all pass-card made and associated to people
       $auths=DB::table('procurations')
       ->select('procurations.*')
       ->whereBetween('procurations.created_at', [$date1, $date2])
       ->get();
  
        return view('procurations.index', compact('auths','date1','date2'));
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use App\Frais;
use App\Authorisations;
use App\GestionsCitoyens;
use App\GestionCartesConsulaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportAutorisations;
use Maatwebsite\Excel\Facades\Excel;

class AuthorisationController extends Controller
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
        $date1="";
        $date2="";
        $auths=Authorisations::all();                                                                                                                    
        $auths=Authorisations::all();                                                                                    
        return view('authorisations.index', compact('auths','date1','date2'));
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
        return view('authorisations.create',compact('citoyens','data'));
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
            'relation_parent'=>  'required',
            'child_surname' =>  'required',
            'child_name'    =>  'required',
            'b_surname'     =>  'required',
            'b_name'        =>  'required',
            'b_id_number'   =>  'required',
            'b_adresse'     =>  'required',
            'b_contact'     =>  'required',
            'relation_parent_2'=>  'required',
            'pouvoir'       =>  'required',
             'b_id_etablit'  =>  'required',
            'b_id_expire'   =>  'required',
            
        ]);

             // GET DATA FROM THE FORM
                $form = array(
                    'citoyen_id' =>  $request->id_number,
                    'relation_parent'    =>  $request->relation_parent,
                    'child_surname' =>  $request->child_surname,
                    'child_name'    =>  $request->child_name,
                    'b_surname'     =>  $request->b_surname,
                    'b_name'        =>  $request->b_name,
                    'b_id_number'   =>  $request->b_id_number,
                    'b_adresse'     =>  $request->b_adresse,
                    'b_contact'     =>  $request->b_contact,
                    'relation_parent_2'=>  $request->relation_parent_2,
                    'pouvoir'       =>  $request->pouvoir,
                    'b_id_etablit'  =>  $request->b_id_etablit,
                    'b_id_expire'   =>  $request->b_id_expire,
                    'byUser'   =>  $byUser,
                    );
            // save new authorisaton
            $data = Authorisations::create($form);
            return redirect()->route('authorisations.index')->with(
                    'success',
                    'La demande a été enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //get all the citoyens
        $citoyens=GestionsCitoyens::all();
        // find the citoyen using his unique id number
        $data=GestionsCitoyens::findOrFail($request->id);
        return view('authorisations.create',compact('data','citoyens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // find the authorisation using his unique id number
        $data=Authorisations::findOrFail($id);
        // get the citoyen data from the table
        $datas=GestionsCitoyens::firstWhere("citoyen_no", $data->citoyen_id);

         return view('authorisations.edit',compact('data','datas'));

        // return "edit";
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
            'relation_parent'=>  'required',
            'child_surname' =>  'required',
            'child_name'    =>  'required',
            'b_surname'     =>  'required',
            'b_name'        =>  'required',
            'b_id_number'   =>  'required',
            'b_adresse'     =>  'required',
            'b_contact'     =>  'required',
            'relation_parent_2'=>  'required',
            'pouvoir'       =>  'required',
             'b_id_etablit'  =>  'required',
            'b_id_expire'   =>  'required',
            
        ]);

             // GET DATA FROM THE FORM
                $form = array(
                    
                    'relation_parent'    =>  $request->relation_parent,
                    'child_surname' =>  $request->child_surname,
                    'child_name'    =>  $request->child_name,
                    'b_surname'     =>  $request->b_surname,
                    'b_name'        =>  $request->b_name,
                    'b_id_number'   =>  $request->b_id_number,
                    'b_adresse'     =>  $request->b_adresse,
                    'b_contact'     =>  $request->b_contact,
                    'relation_parent_2'=>  $request->relation_parent_2,
                    'pouvoir'       =>  $request->pouvoir,
                    'b_id_etablit'  =>  $request->b_id_etablit,
                    'b_id_expire'   =>  $request->b_id_expire,
                    'byUser'   =>  $byUser,
                    );
            // update authorisaton
            $data = Authorisations::whereId($id)->update($form);
            return redirect()->route('authorisations.index')->with(
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
         $data=Authorisations::whereId($id)->delete();
              return redirect()->route('authorisations.index')->with(
                    'success',
                    'Les data ont été supprimé avec succès');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
         //int
        $emb="";
        //process
        $emb=Frais::findOrFail('1');
      // find the authorisation using his unique id number
        $data=Authorisations::findOrFail($id);
        // get the citoyen data from the table
        $datas=GestionsCitoyens::firstWhere("citoyen_no", $data->citoyen_id);
        $dCard=GestionCartesConsulaire::firstWhere("id_number", $data->citoyen_id);
  
  
         return view('authorisations.print',compact('data','datas','emb','dCard'));  
    }
    // export to excel
    public function getExcel()
    {
        return Excel::download(new ExportAutorisations, 'liste_des_autorisations.xlsx');
    }

    public function find(Request $request)
    {
        //init
        $date1=$request->date1;
        $date2=$request->date2;

        $auths=DB::table('authorisations')
       ->select('authorisations.*')
       ->whereBetween('authorisations.created_at', [$date1, $date2])
       ->get();
        return view('authorisations.index',compact('auths','date1','date2'));
    }
}

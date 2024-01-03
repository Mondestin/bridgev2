<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestionsCitoyens;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
use App\User;
use App\Exports\DecesExport;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\LasserPasser;
use App\Naissances;
use App\Frais;
use App\Ventes;
use App\Deces;
class DecesController extends Controller
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
        $data=Deces::all();
        $date1="";
        $date2="";
        return view('deces.index',compact('data','date1','date2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deces.create');
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
            'surname'     =>  'required',
            'name'        =>  'required',
            'date_of_birth'=>  'required',
            'place'       =>  'required',
            'sexe'        =>  'required',
            'f_name'      =>  'required',
            'f_surname'   =>  'required',
            'f_adress'    =>  'required',
            'm_name'      =>  'required',
            'm_surname'   =>  'required',
            'm_adress'    =>  'required',
            'd_name'      =>  'required',
            'd_surname'   =>  'required',
            'd_age'       =>  'required',
            'd_adress'    =>  'required',
            'deces_date'  =>  'required',
            'declare_date'=>  'required',
            'relation'    =>  'required',
            'heure_deces' =>  'required',
            'place_deces' =>  'required',
            'situation'   =>  'required',
            'domicile'    =>  'required',
           
        ]);

    $check=Deces::where("date_of_birth","LIKE", "%{$request->date_of_birth}%",
                                 "AND",
                                 "time","LIKE", "%{$request->time}%")->get();

        //the cityoen is already registered
        if (sizeof($check)>0) {
             return redirect()->route('deces.create')->with(
                    'error',
                    'Le décès déja enregistré été');
            }
        else{
                // GET DATA FROM THE FORM
                $form = array(
                 'surname'     =>  $request->surname,
                 'name'        =>  $request->name,
                 'date_of_birth'=> $request->date_of_birth,
                 'place'       =>  $request->place,
                 'sexe'        =>  $request->sexe,
                 'f_name'      =>  $request->f_name,
                 'f_surname'   =>  $request->f_surname,
                 'f_profession'=>  $request->f_profession,
                 'f_adress'    =>  $request->f_adress,
                 'm_name'      =>  $request->m_name,
                 'm_surname'   =>  $request->m_surname,
                 'm_profession'=>  $request->m_profession, 
                 'm_adress'    =>  $request->m_adress,
                 'd_name'      =>  $request->d_name,
                 'd_surname'   =>  $request->d_surname,
                 'd_age'       =>  $request->d_age,
                 'd_profession'=>  $request->d_profession,
                 'd_adress'    =>  $request->d_adress,
                 'deces_date'  =>  $request->deces_date,
                 'declare_date'=>  $request->declare_date,
                 'relation'    =>  $request->relation,
                 'c_name'      =>  $request->c_name,
                 'c_surname'   =>  $request->c_surname,
                 'heure_deces' =>  $request->heure_deces,
                 'place_deces' =>  $request->place_deces,
                 'situation'   =>  $request->situation,
                 'domicile'    =>  $request->domicile,
                 'profession'  =>  $request->profession,
                    'byUser'   =>  $byUser,
                    );
            // save new born
            $data = Deces::create($form);
            return redirect()->route('deces.index')->with(
                    'success',
                    'Décès enregistré avec succès');
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
        //int
        $emb="";
        //process
        $emb=Frais::findOrFail('1');
        $data=Deces::findOrFail($id);
        return view('deces.print',compact('data','emb'));
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value=Deces::findOrFail($id);
        return view('deces.edit',compact('value'));
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
            'surname'     =>  'required',
            'name'        =>  'required',
            'date_of_birth'=>  'required',
            'place'       =>  'required',
            'sexe'        =>  'required',
            'f_name'      =>  'required',
            'f_surname'   =>  'required',
   
            'f_adress'    =>  'required',
            'm_name'      =>  'required',
            'm_surname'   =>  'required',
            'm_adress'    =>  'required',
            'd_name'      =>  'required',
            'd_surname'   =>  'required',
            'd_age'       =>  'required',
            'd_adress'    =>  'required',
            'deces_date'  =>  'required',
            'declare_date'=>  'required',
            'relation'    =>  'required',
            'heure_deces' =>  'required',
            'place_deces' =>  'required',
            'situation'   =>  'required',
            'domicile'    =>  'required',
           
        ]);

       
                // GET DATA FROM THE FORM
                $form = array(
                 'surname'     =>  $request->surname,
                 'name'        =>  $request->name,
                 'date_of_birth'=> $request->date_of_birth,
                 'place'       =>  $request->place,
                 'sexe'        =>  $request->sexe,
                 'f_name'      =>  $request->f_name,
                 'f_surname'   =>  $request->f_surname,
                 'f_profession'=>  $request->f_profession,
                 'f_adress'    =>  $request->f_adress,
                 'm_name'      =>  $request->m_name,
                 'm_surname'   =>  $request->m_surname,
                 'm_profession'=>  $request->m_profession, 
                 'm_adress'    =>  $request->m_adress,
                 'd_name'      =>  $request->d_name,
                 'd_surname'   =>  $request->d_surname,
                 'd_age'       =>  $request->d_age,
                 'd_profession'=>  $request->d_profession,
                 'd_adress'    =>  $request->d_adress,
                 'deces_date'  =>  $request->deces_date,
                 'declare_date'=>  $request->declare_date,
                 'relation'    =>  $request->relation,
                 'c_name'      =>  $request->c_name,
                 'c_surname'   =>  $request->c_surname,
                 'heure_deces' =>  $request->heure_deces,
                 'place_deces' =>  $request->place_deces,
                 'situation'   =>  $request->situation,
                 'domicile'    =>  $request->domicile,
                 'profession'  =>  $request->profession,
                    );
            // save new born
            $data = Deces::whereId($id)->update($form);
            return redirect()->route('deces.index')->with(
                    'success',
                    'Décès actualisé avec succès');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data=Deces::whereId($id)->delete();
              return redirect()->route('deces.index')->with(
                    'success',
                    'Le Décès a été supprimé avec succès');
    }

    // export to excel
    public function getExcel()
    {
         return Excel::download(new DecesExport, 'liste_des_deces.xlsx');
        
    }

    public function find(Request $request)
    {
        //init
        $date1=$request->date1;
        $date2=$request->date2;
        $print="";
        $see="";
         //get all pass-card made and associated to people
       $data=DB::table('deces')
       ->select('deces.*')
       ->whereBetween('deces.created_at', [$date1, $date2])
       ->get();
        return view('deces.index', compact('data','date1','date2'));
    }
}

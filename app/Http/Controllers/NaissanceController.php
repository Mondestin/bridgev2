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
use App\Exports\NassanceExport;
use Maatwebsite\Excel\Facades\Excel;
class NaissanceController extends Controller
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
        $data=Naissances::all();
        return view('naissances.index',compact('data','date1','date2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('naissances.create');
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
            'time'        =>  'required',
            'f_name'      =>  'required',
            'f_surname'   =>  'required',
            'f_age'       =>  'required',
            'f_profession'=>  'required',
            'f_adress'    =>  'required',
            'm_name'      =>  'required',
            'm_surname'   =>  'required',
            'm_age'       =>  'required',
            'm_profession'=>  'required', 
            'm_adress'    =>  'required',
            'd_name'      =>  'required',
            'd_surname'   =>  'required',
            'd_age'       =>  'required',
            'd_profession'=>  'required',
            'd_adress'    =>  'required',
            'declare_date'=>  'required',
            'relation'    =>  'required',
            'f_nationality'=>  'required',
            'm_nationality'=>  'required'
        ]);

    $check=Naissances::where("date_of_birth","LIKE", "%{$request->date_of_birth}%",
                                 "AND",
                                 "time","LIKE", "%{$request->time}%")->get();

        //the cityoen is already registered
        if (sizeof($check)>0) {
             return redirect()->route('naissances.create')->with(
                    'error',
                    'Le bebe existe déja');
            }
        else{
                // GET DATA FROM THE FORM
                $form = array(
                    'surname'     =>  $request->surname,
                    'name'        =>  $request->name,
                    'date_of_birth'=> $request->date_of_birth,
                    'place'       =>  $request->place,
                    'sexe'        =>  $request->sexe,
                    'time'        =>  $request->time,
                    'f_name'      =>  $request->f_name,
                    'f_surname'   =>  $request->f_surname,
                    'f_age'       =>  $request->f_age,
                    'f_profession'=>  $request->f_profession,
                    'f_adress'    =>  $request->f_adress,
                    'm_name'      =>  $request->m_name,
                    'm_surname'   =>  $request->m_surname,
                    'm_age'       =>  $request->m_age,
                    'm_profession'=>  $request->m_profession, 
                    'm_adress'    =>  $request->m_adress,
                    'd_name'      =>  $request->d_name,
                    'd_surname'   =>  $request->d_surname,
                    'd_age'       =>  $request->d_age,
                    'd_profession'=>  $request->d_profession,
                    'd_adress'    =>  $request->d_adress,
                    'declare_date'=>  $request->declare_date,
                    'relation'    =>  $request->relation,
                    'byUser'      =>  $byUser,
                    'f_nationality'=> $request->f_nationality,
                    'm_nationality'=> $request->m_nationality,
                    );
            // save new born
            $data = Naissances::create($form);
            return redirect()->route('naissances.index')->with(
                    'success',
                    'bébé ajouté avec succès');
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
        $data=Naissances::findOrFail($id);

        // \QrCode::size(500)
        //     ->format('png')
        //     ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));

        
        return view('naissances.print',compact('data','emb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // find the kid using his unique id number
        $data=Naissances::findOrFail($id);
        return view('naissances.edit',compact('data'));
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
            'time'        =>  'required',
            'f_name'      =>  'required',
            'f_surname'   =>  'required',
            'f_age'       =>  'required',
            'f_profession'=>  'required',
            'f_adress'    =>  'required',
            'm_name'      =>  'required',
            'm_surname'   =>  'required',
            'm_age'       =>  'required',
            'm_profession'=>  'required', 
            'm_adress'    =>  'required',
            'd_name'      =>  'required',
            'd_surname'   =>  'required',
            'd_age'       =>  'required',
            'd_profession'=>  'required',
            'd_adress'    =>  'required',
            'declare_date'=>  'required',
            'relation'    =>  'required',
            'f_nationality'=>  'required',
            'm_nationality'=>  'required'
        ]);

                // GET DATA FROM THE FORM
                $form = array(
                    'surname'     =>  $request->surname,
                    'name'        =>  $request->name,
                    'date_of_birth'=> $request->date_of_birth,
                    'place'       =>  $request->place,
                    'sexe'        =>  $request->sexe,
                    'time'        =>  $request->time,
                    'f_name'      =>  $request->f_name,
                    'f_surname'   =>  $request->f_surname,
                    'f_age'       =>  $request->f_age,
                    'f_profession'=>  $request->f_profession,
                    'f_adress'    =>  $request->f_adress,
                    'm_name'      =>  $request->m_name,
                    'm_surname'   =>  $request->m_surname,
                    'm_age'       =>  $request->m_age,
                    'm_profession'=>  $request->m_profession, 
                    'm_adress'    =>  $request->m_adress,
                    'd_name'      =>  $request->d_name,
                    'd_surname'   =>  $request->d_surname,
                    'd_age'       =>  $request->d_age,
                    'd_profession'=>  $request->d_profession,
                    'd_adress'    =>  $request->d_adress,
                    'declare_date'=>  $request->declare_date,
                    'relation'    =>  $request->relation,
                    'byUser'      =>  $byUser,
                    'f_nationality'=> $request->f_nationality,
                    'm_nationality'=> $request->m_nationality,
                    );
            // save new born
            $data = Naissances::whereId($request->id)->update($form);
            return redirect()->route('naissances.index')->with(
                    'success',
                    'bebe modifié avec succès');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Naissances::whereId($id)->delete();
              return redirect()->route('naissances.index')->with(
                    'success',
                    'Le bébé a été supprimé avec succès');
    }
    //print l'acte de naissance
    public function print(Request $request, $id)
    {
           //int
        $emb="";
        //process
        $emb=Frais::findOrFail('1');
        $data=Naissances::findOrFail($id);
        return view('naissances.print',compact('data','emb'));
    }

    // export to excel
    public function getExcel()
    {
        return Excel::download(new NassanceExport, 'liste_des_naissances.xlsx');
    }
    public function find(Request $request)
    {
        //init
        $date1=$request->date1;
        $date2=$request->date2;

        $data=DB::table('naissances')
       ->select('naissances.*')
       ->whereBetween('naissances.created_at', [$date1, $date2])
       ->get();
        return view('naissances.index',compact('data','date1','date2'));
    }
}

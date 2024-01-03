<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Deces;
use App\Frais;
use App\Ventes;
use App\Mariage;
use App\Naissances;
use App\LasserPasser;
use App\GestionsCitoyens;
use Illuminate\Http\Request;
use App\Exports\ExportMariage;
use App\GestionCartesConsulaire;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MariageController extends Controller
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
        $data=Mariage::all();
        $date1="";
        $date2="";
        return view('mariage.index',compact('data','date1','date2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mariage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check all requied inputs
        $byUser=Auth::user()->name;
        $request->validate([
            // CARD VALIDATIONS
            'mri_surname'       =>  'required',
            'mri_name'          =>  'required',
            'mri_profession'    =>  'required',
            'mri_dob'           =>  'required',
            'mri_pere'          =>  'required',
            'mri_mere'          =>  'required',
            'mri_domicile'      =>  'required',
            'mri_auto_judi'     =>  'required',
            'mri_auto_parent'   =>  'required',
            'mri_dispense_age'  =>  'required',
            'fem_surname'      =>  'required',
            'fem_name'          =>  'required',
            'fem_profession'    =>  'required',
            'fem_dob'           =>  'required',
            'fem_pere'          =>  'required',
            'fem_mere'          =>  'required',
            'fem_domicile'      =>  'required',
            'fem_auto_judi'     =>  'required',
            'fem_auto_parent'   =>  'required',
            'fem_dispense_age'  =>  'required',
            't1_surname'        =>  'required',
            't1_name'           =>  'required',
            't1_profession'     =>  'required',
            't1_domicile'       =>  'required',
            't1_majeur'         =>  'required',
            't2_surname'        =>  'required',
            't2_name'           =>  'required',
            't2_profession'     =>  'required',
            't2_domicile'       =>  'required',
            't2_majeur'         =>  'required',
            'date_mariage'      =>  'required',
            'heure_mariage'     =>  'required',
          ]);
          $form = array(
            'mri_surname'       =>  $request->mri_surname,
            'mri_name'          =>  $request->mri_name,
            'mri_profession'    =>  $request->mri_profession,
            'mri_dob'           =>  $request->mri_dob,
            'mri_pere'          =>  $request->mri_pere,
            'mri_mere'          =>  $request->mri_mere,
            'mri_domicile'      =>  $request->mri_domicile,
            'mri_auto_judi'     =>  $request->mri_auto_judi,
            'mri_auto_parent'   =>  $request->mri_auto_parent,
            'mri_dispense_age'  =>  $request->mri_dispense_age,
            'fem_surname'      =>  $request->fem_surname,
            'fem_name'          =>  $request->fem_name,
            'fem_profession'    =>  $request->fem_profession,
            'fem_dob'           =>  $request->fem_dob,
            'fem_pere'          =>  $request->fem_pere,
            'fem_mere'          =>  $request->fem_mere,
            'fem_domicile'      =>  $request->fem_domicile,
            'fem_auto_judi'     =>  $request->fem_auto_judi,
            'fem_auto_parent'   =>  $request->fem_auto_parent,
            'fem_dispense_age'  =>  $request->fem_dispense_age,
            't1_surname'        =>  $request->t1_surname,
            't1_name'           =>  $request->t1_name,
            't1_profession'     =>  $request->t1_profession,
            't1_domicile'       =>  $request->t1_domicile,
            't1_majeur'         =>  $request->t1_majeur,
            't2_surname'        =>  $request->t2_surname,
            't2_name'           =>  $request->t2_name,
            't2_profession'     =>  $request->t2_profession,
            't2_domicile'       =>  $request->t2_domicile,
            't2_majeur'         =>  $request->t2_majeur,
            'it_surname'        =>  $request->it_surname,
            'it_name'           =>  $request->it_name,
            'it_profession'     =>  $request->it_profession,
            'it_domicile'       =>  $request->it_domicile,
            'it_majeur'         =>  $request->it_majeur,
            'date_mariage'      =>  $request->date_mariage,
            'heure_mariage'     =>  $request->heure_mariage,
            'byUser'            =>  $byUser,
            );
        //save the information
        $data = Mariage::create($form);
        return redirect()->route('mariage.index')->with(
        'success',
        'Le Mariage a été enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value=Mariage::findOrFail($id);
        return view('mariage.edit',compact('value'));
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
            // check all requied inputs
            $byUser=Auth::user()->name;
            $request->validate([
                // CARD VALIDATIONS
                'mri_surname'       =>  'required',
                'mri_name'          =>  'required',
                'mri_profession'    =>  'required',
                'mri_dob'           =>  'required',
                'mri_pere'          =>  'required',
                'mri_mere'          =>  'required',
                'mri_domicile'      =>  'required',
                'mri_auto_judi'     =>  'required',
                'mri_auto_parent'   =>  'required',
                'mri_dispense_age'  =>  'required',
                'fem_surname'      =>  'required',
                'fem_name'          =>  'required',
                'fem_profession'    =>  'required',
                'fem_dob'           =>  'required',
                'fem_pere'          =>  'required',
                'fem_mere'          =>  'required',
                'fem_domicile'      =>  'required',
                'fem_auto_judi'     =>  'required',
                'fem_auto_parent'   =>  'required',
                'fem_dispense_age'  =>  'required',
                't1_surname'        =>  'required',
                't1_name'           =>  'required',
                't1_profession'     =>  'required',
                't1_domicile'       =>  'required',
                't1_majeur'         =>  'required',
                't2_surname'        =>  'required',
                't2_name'           =>  'required',
                't2_profession'     =>  'required',
                't2_domicile'       =>  'required',
                't2_majeur'         =>  'required',
                'date_mariage'      =>  'required',
                'heure_mariage'     =>  'required',
              ]);
              $form = array(
                'mri_surname'       =>  $request->mri_surname,
                'mri_name'          =>  $request->mri_name,
                'mri_profession'    =>  $request->mri_profession,
                'mri_dob'           =>  $request->mri_dob,
                'mri_pere'          =>  $request->mri_pere,
                'mri_mere'          =>  $request->mri_mere,
                'mri_domicile'      =>  $request->mri_domicile,
                'mri_auto_judi'     =>  $request->mri_auto_judi,
                'mri_auto_parent'   =>  $request->mri_auto_parent,
                'mri_dispense_age'  =>  $request->mri_dispense_age,
                'fem_surname'      =>  $request->fem_surname,
                'fem_name'          =>  $request->fem_name,
                'fem_profession'    =>  $request->fem_profession,
                'fem_dob'           =>  $request->fem_dob,
                'fem_pere'          =>  $request->fem_pere,
                'fem_mere'          =>  $request->fem_mere,
                'fem_domicile'      =>  $request->fem_domicile,
                'fem_auto_judi'     =>  $request->fem_auto_judi,
                'fem_auto_parent'   =>  $request->fem_auto_parent,
                'fem_dispense_age'  =>  $request->fem_dispense_age,
                't1_surname'        =>  $request->t1_surname,
                't1_name'           =>  $request->t1_name,
                't1_profession'     =>  $request->t1_profession,
                't1_domicile'       =>  $request->t1_domicile,
                't1_majeur'         =>  $request->t1_majeur,
                't2_surname'        =>  $request->t2_surname,
                't2_name'           =>  $request->t2_name,
                't2_profession'     =>  $request->t2_profession,
                't2_domicile'       =>  $request->t2_domicile,
                't2_majeur'         =>  $request->t2_majeur,
                'it_surname'        =>  $request->it_surname,
                'it_name'           =>  $request->it_name,
                'it_profession'     =>  $request->it_profession,
                'it_domicile'       =>  $request->it_domicile,
                'it_majeur'         =>  $request->it_majeur,
                'date_mariage'      =>  $request->date_mariage,
                'heure_mariage'     =>  $request->heure_mariage,
                'byUser'            =>  $byUser,
                );
            //save the information
            $data = Mariage::whereId($id)->update($form);
            return redirect()->route('mariage.index')->with(
            'success',
            'Le Mariage a été actulisé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $datas=Mariage::whereId($id)->delete();
          return redirect()->route('mariage.index')
                        ->with('success', 'Mariage supprimé avec succès');
    }
    // export to excel
    public function getExcel()
    {
        return Excel::download(new ExportMariage, 'liste_des_mariages.xlsx');
    }
    public function find(Request $request)
    {
        //init
        $date1=$request->date1;
        $date2=$request->date2;
        $print="";
        $see="";
                //get all pass-card made and associated to people
            $data=DB::table('mariages')
            ->select('mariages.*')
            ->whereBetween('mariages.created_at', [$date1, $date2])
            ->get();
        return view('mariage.index', compact('data','date1','date2'));
    }
}

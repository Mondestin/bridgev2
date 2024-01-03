<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestionsCitoyens;
use App\Authorisations;
use Auth;
use App\Frais;
use App\Procurations;
use App\Deces;
use App\Naissances;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifAutho($id)
    {
         //int
        $emb="";
        //process
        $emb=Frais::findOrFail('1');
      // find the authorisation using his unique id number
        $data=Authorisations::findOrFail($id);
        // get the citoyen data from the table
        $datas=GestionsCitoyens::firstWhere("citoyen_no", $data->citoyen_id);
        return view('authorisations.print',compact('data','datas','emb'));  
    }
    /**
     * Print the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifProc($id)
    {
      // find the procurations using his unique id number
        $data=Procurations::findOrFail($id);
        // get the citoyen data from the table
        $datas=GestionsCitoyens::firstWhere("citoyen_no", $data->citoyen_id);

         return view('procurations.print',compact('data','datas'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifDeces($id)
    {
        //int
        $emb="";
        //process
        $emb=Frais::findOrFail('1');
        $data=Deces::findOrFail($id);
        return view('deces.print',compact('data','emb'));
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifNaiss($id)
    {
          //int
        $emb="";
        //process
        $emb=Frais::findOrFail('1');
        $data=Naissances::findOrFail($id);  
        return view('naissances.print',compact('data','emb'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifCartes($id)
    {
          //int
        $emb="";
        //process
        $emb=Frais::findOrFail('1');
        $carte=GestionCartesConsulaire::findOrFail($id); 
        $citoyen=GestionsCitoyens::firstWhere('citoyen_no','=',$carte->id_number); 

        // dd($carte);
        return view('cartes.verify',compact('carte','emb','citoyen'));
    }
}

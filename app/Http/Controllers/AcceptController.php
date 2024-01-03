<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Deces;
use App\Frais;
use App\Visas;
use App\Ventes;
use App\Mariage;
use App\Naissances;
use App\GestionVisas;
use App\LasserPasser;
use App\Procurations;
use App\Legalisations;
use App\Authorisations;
use App\GestionsCitoyens;
use Illuminate\Http\Request;
use App\GestionCartesConsulaire;
use Illuminate\Support\Facades\DB;

class AcceptController extends Controller
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


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get all the information required
       // $info=

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
         return "edit";
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
        return "update";
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

    //get payment for lassez passer
    public function laisser(Request $request)
    {
        //init
        $type="Laissez-Passer";
        $names="";

        //process
        $id=$request->id;
        $id_number=$request->id_number;
        $fees=$request->fees;
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé', );

        //for ventes tables
        $caisse = array(

                        'dem_no'  => $id_number,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update laissez passer table status
        $update=LasserPasser::whereId($id)->update($up);

        //save the paiement in the ventes table
         $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
    }

    //get payment for consulaire cards
    public function cards(Request $request)
    {
        //init
        $type="Nouvelle Carte d'Identité Consulaire";
        $names="";

        //process
        $id=$request->id;
        $id_number=$request->id_number;
        $fees=$request->fees;
        $byUser=Auth::user()->name;

        //for gestion des cartes table
        $up=array('status'      => 'Validée',
                  'card_status' => 'Validée', );

        //for ventes tables
        $caisse = array(

                        'dem_no'  => $id_number,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update gestion carte consulaire table status
        $update=GestionCartesConsulaire::whereId($id)->update($up);

        //save the paiement in the ventes table
         $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
    }

   //get payment for consulaire cards
    public function cardsr(Request $request)
    {
        //init
        $type="Renouvellement Carte d'Identité Consulaire";
        $names="";

        //process
        $id=$request->id;
        $id_number=$request->id_number;
        $fees=$request->fees;
        $byUser=Auth::user()->name;

        //for Gestion des cartes table
        $up=array('status'      => 'Validée',
                  'card_status' => 'Validée', );

        //for ventes tables
        $caisse = array(

                        'dem_no'  => $id_number,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update gestion carte consulaire table status
        $update=GestionCartesConsulaire::whereId($id)->update($up);

        //save the paiement in the ventes table
         $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
    }
   //get payment for visas
    public function visas(Request $request)
    {
        //init
        //process
        $id=$request->id;
        $id_number=$request->id_number;
        $fees=$request->fees;
        $type=$request->type;
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé', );

        //for ventes tables
        $caisse = array(

                        'dem_no'  => $id_number,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update gestion visas table status
        $update=GestionVisas::whereId($id)->update($up);

        //save the paiement in the ventes table
         $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
    }

   //get payment for naissances
    public function naissances(Request $request)
    {
        //init

        //process
        $id=$request->id;
        $fees=$request->fees;
        $type="Acte de Naissance";
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé', );

        //for ventes tables
        $caisse = array(

                        'dem_no'  => $request->name_child,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update gestion visas table status
        $update=Naissances::whereId($id)->update($up);

        //save the paiement in the ventes table
         $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
    }

    //get payment for deces
    public function deces(Request $request)
    {
        //init

        //process
        $id=$request->id;
        $fees=$request->fees;
        $type="Acte de Décès";
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé', );

        //for ventes tables
        $caisse = array(
                        'dem_no'  => $request->name_of_decease,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update gestion visas table status
        $update=Deces::whereId($id)->update($up);

        //save the paiement in the ventes table
         $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
    }
     //get payment for mariages
    public function mariages(Request $request)
    {
        //init

        //process
        $id=$request->id;
        $fees=$request->fees;
        $type="Acte de Mariage";
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé', );

        //for ventes tables
        $caisse = array(
                        'dem_no'  => $request->names,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update gestion visas table status
        $update=Mariage::whereId($id)->update($up);
        //save the paiement in the ventes table
        $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
        //return $id;
    }

      //get payment for authorisations
    public function authorisations(Request $request)
    {
        //init

        //process
        $id=$request->id;
        $fees=$request->fees;
        $type="Autorisation Parentale";
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé');

        //for ventes tables
        $caisse = array(
                        'dem_no'  => $request->id_number,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update authorisations table status
        $update=Authorisations::whereId($id)->update($up);

        //save the paiement in the ventes table
        $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
        //return $id;
    }

        //get payment for procurations
    public function procurations(Request $request)
    {
        //init

        //process
        $id=$request->id;
        $fees=$request->fees;
        $type="Procuration";
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé');

        //for ventes tables
        $caisse = array(

                        'dem_no'  => $request->id_number,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update procuration table status
        $update=Procurations::whereId($id)->update($up);

        //save the paiement in the ventes table
        $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
        //return $id;
    }
       //get payment for legalisations
    public function legalisations(Request $request)
    {
        //init

        //process
        $id=$request->id;
        $ids=$request->id_number;
        $fees=$request->fees;
        $type="Légalisation"." ".$request->names;
        $byUser=Auth::user()->name;

        //for laissez passer table
        $up=array('status' => 'Validé');

        //for ventes tables
        $caisse = array(

                        'dem_no'  => $ids,
                        'montant' => $fees,
                        'types'    => $type,
                        'byUser'  => $byUser,
                        );

        //update legalisations table status
        $update=Legalisations::whereId($id)->update($up);

        //save the paiement in the ventes table
        $paid=Ventes::create($caisse);

        return redirect()->route('caisse.create')->with(
                    'success',
                    'Le paiement a été accepté avec succès');
        //return $id;
    }

}

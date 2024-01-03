<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\GestionsCitoyens;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
use App\User;
use Auth;
use App\Legalisations;
use App\LasserPasser;
use App\Naissances;
use App\Frais;
use App\Ventes;
use App\GestionVisas;
use App\Visas;
use App\Deces;
use App\Mariage;
use App\Procurations;
class CaisseController extends Controller
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
        $pass_fees="";
        $card1_fees="";
        $card2_fees="";
        $card_fees="";
        // $visa1_fees="";
        // $visa2_fees="";
        // $visa3_fees="";
        // $visa4_fees="";
        $naissance_fees="";
        $mariage_fees="";
        $deces_fees="";
        $procuration_fees="";
        $sold_today="";
          $legalisations_fees="";



        // get all the fees amounts required fo each payment
        $fees=Frais::all();
        foreach ($fees as $key => $value) {
            $pass_fees=$value->passer;
            $card1_fees=$value->carte1;
            $card2_fees=$value->carte2;
            // $visa1_fees=$value->visas1;
            // $visa2_fees=$value->visas2;
            // $visa3_fees=$value->visas3;
            $legalisations_fees=$value->legalisations;

            $naissance_fees=$value->naissance;
            $mariage_fees=$value->mariage;
            $deces_fees=$value->deces;
            $procuration_fees=$value->procuration;
            $authorisation_fees=$value->authorisation;
        }

        //get all transit visas demands
        // $transit=GestionVisas::where('type','LIKE','transit')
        //                     ->where('status','LIKE','en traitement')
        //                     ->get();

        // //get all court duree visas demands
        // $court=GestionVisas::where('type','LIKE','Court séjour')
        //                     ->where('status','LIKE','en traitement')
        //                     ->get();

        // //get all Double entrée visas demands
        // $entre=GestionVisas::where('type','LIKE','Double entrée')
        //                     ->where('status','LIKE','en traitement')
        //                     ->get();

        // //get all multiple visas demands
        // $multiple=GestionVisas::where('type','LIKE','Entrée multiple')
        //                     ->where('status','LIKE','en traitement')
        //                     ->get();

        //get all naissance demands
        $naiss=Naissances::where('status','LIKE','en traitement')
                            ->get();

        //get all deces demands
        $deces=Deces::where('status','LIKE','en traitement')
                            ->get();
        //get all mariage demands
        $mariage=Mariage::where('status','LIKE','en traitement')
                            ->get();


        //get all the pass card waiting for payment validation
        $pass=DB::table('lasser_passers')
                    ->join('gestions_citoyens','gestions_citoyens.citoyen_no','=','lasser_passers.id_number')
                    ->select('gestions_citoyens.*','lasser_passers.*')
                    ->where('lasser_passers.status','LIKE','en traitement')
                    ->get();

        //get all the consular card waiting for payment validation
        $cards1=DB::table('gestion_cartes_consulaires')
                    ->join('gestions_citoyens','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->where('gestion_cartes_consulaires.status','LIKE','en traitement')
                    ->where('gestion_cartes_consulaires.type','LIKE','Nouvelle Carte')
                    ->get();

        //get all the consular card waiting for payment validation
        $cards2=DB::table('gestion_cartes_consulaires')
                    ->join('gestions_citoyens','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->where('gestion_cartes_consulaires.status','LIKE','en traitement')
                    ->where('gestion_cartes_consulaires.type','LIKE','Renouvellement')
                    ->get();

                     //get all the authorisations waiting for payment validation
        $autho=DB::table('authorisations')
                    ->join('gestions_citoyens','gestions_citoyens.citoyen_no','=','authorisations.citoyen_id')
                    ->select('gestions_citoyens.*','authorisations.*')
                    ->where('authorisations.status','LIKE','en traitement')
                    ->get();

        //get all the procuration waiting for payment validation
        $procuration=DB::table('procurations')
                    ->join('gestions_citoyens','gestions_citoyens.citoyen_no','=','procurations.citoyen_id')
                    ->select('gestions_citoyens.*','procurations.*')
                    ->where('procurations.status','LIKE','en traitement')
                    ->get();
        //get all the procuration waiting for payment validation
        $legalisations=Legalisations::where('legalisations.status','LIKE','en traitement')->get();

        $date= date('Y-m-d');

        $data=DB::table('ventes')
                    ->select('ventes.*')
                    ->where("ventes.created_at","LIKE","%{$date}%")
                    ->get();

        return view('caisse.index',compact('data','pass','pass_fees','cards1','card1_fees','card2_fees','cards2','mariage_fees','deces_fees','naissance_fees','naiss','deces','mariage','autho','procuration_fees','authorisation_fees','procuration','legalisations','legalisations_fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return "create";
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
        //init
        $id=1;
        $data=Frais::findOrFail($id);
    //total
    $total=Ventes::all()->sum('montant');

    //count all pass card that were validated
    $no_pass_card = Ventes::where("types","LIKE", "%Laissez-Passer%")->count('id');
    $cards_total=Ventes::where("types","LIKE", "%Laissez-Passer%")->sum('montant');

    //count all consular card new that were validated
    $no_con_card = Ventes::where("types","LIKE", "%Nouvelle Carte Consulaire%")->count('id');
    $consular_total=Ventes::where("types","LIKE", "%Nouvelle Carte Consulaire%")->sum('montant');

   //count all consular card new that were validated
    $no_con_card1 = Ventes::where("types","LIKE", "%Renouvellement Carte Consulaire%")->count('id');
    $consular_total1=Ventes::where("types","LIKE", "%Renouvellement Carte Consulaire%")->sum('montant');

    //count all visas that were validated
    //transit
    $no_transit = Ventes::where("types","LIKE", "%Transit%")->count('id');
    $transit_total=Ventes::where("types","LIKE", "%Transit%")->sum('montant');
    //double entre
    $no_entre = Ventes::where("types","LIKE", "%Double entrée%")->count('id');
    $entre_total=Ventes::where("types","LIKE", "%Double entrée%")->sum('montant');
    //court
    $no_court = Ventes::where("types","LIKE", "%Court séjour%")->count('id');
    $court_total=Ventes::where("types","LIKE", "%Court séjour%")->sum('montant');

    //multiple
    $no_multiple = Ventes::where("types","LIKE", "%Entrée multiple%")->count('id');
    $multiple_total=Ventes::where("types","LIKE", "%Entrée multiple%")->sum('montant');

    //naissance
    $no_naissance = Ventes::where("types","LIKE", "%Naissance%")->count('id');
    $naissance_total=Ventes::where("types","LIKE", "%Naissance%")->sum('montant');

    //deces
    $no_deces = Ventes::where("types","LIKE", "%Décès%")->count('id');
    $deces_total=Ventes::where("types","LIKE", "%Décès%")->sum('montant');

    //mariage
    $no_mariage = Ventes::where("types","LIKE", "%Mariage%")->count('id');
    $mariage_total=Ventes::where("types","LIKE", "%Mariage%")->sum('montant');


     return view('caisse.bilant',compact('data','no_pass_card','cards_total','no_con_card','consular_total','no_multiple','multiple_total','no_transit','transit_total','no_entre','entre_total','no_court','court_total','total','no_naissance','naissance_total','no_deces','deces_total','no_mariage','mariage_total','no_con_card1','consular_total1'));

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
       //les frais des papiers
    public function paiementCaisse()
    {
        dd("caisse");
        $id=1;
        $data=Frais::findOrFail($id);
        return view('caisse.frais',compact('data'));
    }

    //les frais des papiers
    public function frais()
    {
        $id=1;
        $data=Frais::findOrFail($id);
        return view('caisse.frais',compact('data'));
    }

    // print the receipt of a pécifique paiement
    public function printReceipt($id)
    {

        // init
        $data="";
        $check=0;
        $cardId="";
       // get all the info concerning the receipt
        $vente=DB::table("ventes")
                    ->where("ventes.id","LIKE","%$id%")
                    ->first();
        // check if the reference is a citoyen or not
        if(is_numeric(substr($vente->dem_no,0,1)))
        {
            $check=1;
         $data=DB::table('ventes')
                    ->join('gestions_citoyens','gestions_citoyens.citoyen_no','=','ventes.dem_no')
                    ->select('gestions_citoyens.*','ventes.*')
                    ->where("ventes.id","LIKE","%$id%")
                    ->first();
         $cardId=GestionCartesConsulaire::where('id_number', $data->citoyen_no)->first();
        //  dd($cardId->card_no);
        }
        else {
            $data=$vente;

        }
        // dd($data);
        return view('caisse.receipt',compact('data','check', 'cardId'));
    }
}

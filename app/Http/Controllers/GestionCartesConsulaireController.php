<?php

namespace App\Http\Controllers;

use App\GestionStocks;
use App\GestionsCitoyens;
use App\Frais;
use Illuminate\Http\Request;
use App\Exports\PrintCartExport;
use App\GestionCartesConsulaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CartesConsulaireExport;

class GestionCartesConsulaireController extends Controller
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
       $date1="";
       $date2="";
       //get all consular cards made and associated to people
       $data=DB::table('gestions_citoyens')
                    ->join('gestion_cartes_consulaires','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->get();

        return view('cartes.index',compact('data','date1','date2'));

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
         // get last id and add 1 to it to generate the qr code link
        $id=GestionCartesConsulaire::max('id')+1;
        return view('cartes.nouveau',compact('citoyens','data','id'));
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
            'date_emission'      =>  'required',
            'date_expiration'    =>  'required',
            'type'               =>  'required',
            'validity'           =>  'required',
            'card_status'        =>  'required',
            'print_status'       =>  'required',
        ]);
        $userName=$request->id_number;

        $date=date("Y-m");
          // get and check the stock before saving
        $stocks=GestionStocks::Firstwhere('stocks.created_at',"LIKE","%$date%");

        if ($stocks==null || $stocks->entering==0) {
            //return an error message if stocks is null
            return back()->with(
                    'error',
                    'Pas de cartes consulaire en stock, veuillez vous approvisioner');
        } else {
          if (empty($request->id_number)) {
            return back()->with(
                'error',
                'Veuiller sélectionner un citoyen');
          }
          else{
            // generate a citoyens code
                $year=Date('Y');
                $month=Date('m');
                // get last id and add 1 to it
                $lastId=GestionCartesConsulaire::max('id')+1001;
                $lastIdSaved=GestionCartesConsulaire::max('id')+1;
                // generate a citoyens code
                $code="CIC"."-".Date('d').$lastId."/CGHBC/".$year;

                    $citoyen_form = array(
                            'id_number'         =>  $userName,
                            'card_no'         =>  $code,
                            'date_emission'     =>  $request->date_emission,
                            'date_expiration'   =>  $request->date_expiration,
                            'type'              =>  $request->type,
                            'validity'          =>  $request->validity,
                            'card_status'       =>  $request->card_status,
                            'print_status'      =>  $request->print_status,
                            'qr_link'           =>  "https://consulat-benin-pnr.org/verify/cic/".$lastIdSaved,
                            'byUser'            =>  $byUser,

                        );
                    // create new citoyen consular card
                        $citoyen = GestionCartesConsulaire::create($citoyen_form);
                        return redirect()->route('cartes.index')->with(
                            'success',
                            'La carte consulaire a été crée avec success');
                }
            }
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
        // get last id and add 1 to it to generate the qr code link
        $id=GestionCartesConsulaire::max('id')+1;
        return view('cartes.nouveau',compact('data','citoyens','id'));
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
         $type="";
         $validity="";
         $card_status="";
         $print_status="";
         $qr_link="";

          //get the consular card made and associated to person
       $data=DB::table('gestions_citoyens')
                    ->join('gestion_cartes_consulaires','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->where("gestion_cartes_consulaires.id","=","{$id}")
                    ->get();
        //get all the values needed in the  array
         foreach ($data as $key => $value) {
             $name=$value->name;
             $id_number=$value->citoyen_no;
             $surname=$value->surname;
             $date_blocked=$value->date_blocked;
             $motif=$value->motif;
             $avatar=$value->avatar;
             $eye_color=$value->eye_color;
             $cheuveux=$value->cheuveux;
             $pa_sign=$value->pa_sign;
             $date_emission=$value->date_emission;
             $date_expiration=$value->date_expiration;
             $type=$value->type;
             $validity=$value->validity;
             $card_status=$value->card_status;
             $print_status=$value->print_status;

         }

         return view('cartes.update', compact('id','id_number','name','surname','avatar','eye_color','cheuveux','pa_sign','date_emission','date_expiration','type','validity','card_status','print_status','date_blocked','motif', 'qr_link'));
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
        $print_status="";
             $request->validate([
            // card VALIDATIONS
            'date_emission'     =>  'required',
            'date_expiration'   =>  'required',
            'type'              =>  'required',
            'validity'          =>  'required',
            'card_status'       =>  'required'
            ]);

            $carte=GestionCartesConsulaire::whereId($id)->first();
            if ($carte) {
                 if($request->print_status) {
                    $print_status=$request->print_status;
                } else {
                    $print_status=$carte->print_status;
                }
              // get the values
               $data = array(
                'date_emission'     =>  $request->date_emission,
                'date_expiration'   =>  $request->date_expiration,
                'type'              =>  $request->type,
                'validity'          =>  $request->validity,
                'card_status'       =>  $request->card_status,
                'print_status'      =>  $print_status,
                'date_blocked'      =>  $request->date_blocked,
                'motif'             =>  $request->motif
                 );
                // update the card info
                $update = GestionCartesConsulaire::whereId($id)->update($data);
                return redirect()->route('cartes.index')->with(
                            'success',
                            'Carte actualisé avec succès');
            }
            return redirect()->route('cartes.index')->with(
                'error',
                'Cette carte consulaire invalide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=GestionCartesConsulaire::whereId($id);
         $data->delete();
              return redirect()->route('cartes.index')->with(
                    'success',
                    'La carte consulaire a été supprimé avec success');
    }
    /**
     * preview the card before printing
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   public function preview(Request $request, $id)
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
         $dob="";
         $type="";
         $sexe="";
         $pofbirth="";
         $profession="";
         $address="";
         $phone="";
         $validity="";
         $card_status="";
         $print_status="";
         $id= $request->id;
         $qr_link="";
         $card_no="";

          //get the consular card made and associated to person
       $data=DB::table('gestions_citoyens')
                    ->join('gestion_cartes_consulaires','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->where("gestion_cartes_consulaires.id","=","{$id}")
                    ->get();
        //get all the values needed in the  array
         foreach ($data as $key => $value) {
             $name=$value->name;
             $id_number=$value->id_number;
             $surname=$value->surname;
             $date_blocked=$value->date_blocked;
             $motif=$value->motif;
             $dob=$value->dob;
             $sexe=$value->sexe;
             $avatar=$value->avatar;
             $eye_color=$value->eye_color;
             $cheuveux=$value->cheuveux;
             $phone=$value->phone;
             $pa_sign=$value->pa_sign;
             $date_emission=$value->date_emission;
             $date_expiration=$value->date_expiration;
             $type=$value->type;
             $validity=$value->validity;
             $card_status=$value->card_status;
             $print_status=$value->print_status;
            $sexe=$value->sexe;
         $profession=$value->profession;
         $address=$value->addressSecondCountry;
           $pofbirth=$value->pofbirth;
           $card_no=$value->card_no;
           $qr_link=$value->qr_link;
         }
         $consul=Frais::First();

         return view('cartes.carte', compact('card_no','id','id_number','name','surname','avatar','eye_color','cheuveux','pa_sign','date_emission','date_expiration','type','validity','card_status','dob','sexe','profession','address','pofbirth','phone','qr_link','consul'));

    }
     // export to excel
    public function getExcel()
    {
        return Excel::download(new CartesConsulaireExport, 'liste_cartes_consulaire.xlsx');
    }

    // export to excel
    public function getExcelForCards()
    {
        return Excel::download(new PrintCartExport, 'liste_pour_impression.xlsx');
    }


    public function find(Request $request)
    {
             //init
         $date1=$request->date1;
         $date2=$request->date2;
       $bg_status="";
       $bg_block="";
       $print_card="";
       $motif="";
       $date_blocked="";
       $status="";
       $print="";
       //get all consular cards made and associated to people
       $data=DB::table('gestions_citoyens')
                    ->join('gestion_cartes_consulaires','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->whereBetween('gestion_cartes_consulaires.created_at', [$date1, $date2])
                    ->get();


        foreach ($data as $key => $value) {
            $status=$value->card_status;
            $print_card=$value->print_status;
            $motif=$value->motif;
            $date_blocked=$value->date_blocked;
        }
        //set the background of the status of the card
        if ($motif !="" || $date_blocked !=null) {
            $bg_block="bg-danger";
        }
       // set the background of the status
        if ($status=="Saisie") {
             $bg_status="bg-warning";
        }
        elseif ($status=="Validée") {
             $bg_status="bg-success";
        }
        elseif ($status=="Rejet") {
             $bg_status="bg-danger";
        }
      return view('cartes.index',compact('data','bg_block','bg_status','print','date1','date2'));


    }
}

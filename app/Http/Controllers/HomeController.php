<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestionsCitoyens;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
use App\User;
use Auth;
use App\LasserPasser;
use App\Event;
use App\Visas;
use App\Naissances;
use App\Ventes;
use App\Deces;
use App\Mariage;
use App\Authorisations;
use App\Procurations;
use App\Legalisations;
use App\GestionStocks;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
     {   

        //update last login of the user that has just connect
        $time=now();
        $date=Date("Y-m");
        $stats=1;
        $stock_total=0;
        $id=Auth::user()->id;
        $lastIn=User::whereId($id)->update(["lastLogin" => $time]);

        //get count of citoyens
        $citoyens = GestionsCitoyens::all()->count('id');
        $citoyens_month = GestionsCitoyens::where("created_at", "LIKE", "%$date%")->count('id');



   // dd($citoyens_month);
        //get count of consular card
        $cards = GestionCartesConsulaire::all()->count('id');


        //get count of consular card
        $pass = LasserPasser::all()->count('id');
        $pass_month = LasserPasser::where("created_at", "LIKE", "%$date%")->count('id');


         //get count of visas
        $visas = Visas::all()->count('id');
         //get count of deces
        $deces = Deces::all()->count('id');
        $deces_month = Deces::where("created_at", "LIKE", "%$date%")->count('id');
          
        //get all the events that exists
        $data = DB::table('events')->orderBy('id','desc')->get();

        //get all the Naissances that exists
        $nais = Naissances::all()->count('id');
        $nais_month = Naissances::where("created_at", "LIKE", "%$date%")->count('id');

        //get all the Mariage that exists
        $maria = Mariage::all()->count('id');
        $maria_month = Mariage::where("created_at", "LIKE", "%$date%")->count('id');

        //get all the autorisations that exists
        $auto = Authorisations::all()->count('id');
        $auto_month = Authorisations::where("created_at", "LIKE", "%$date%")->count('id');

        //get all the Procurations that exists
        $pro = Procurations::all()->count('id');
        $pro_month = Procurations::where("created_at", "LIKE", "%$date%")->count('id');

        //get all the Legalisations that exists
        $leg = Legalisations::all()->count('id');
        $leg_month = Legalisations::where("created_at", "LIKE", "%$date%")->count('id');

         $count_cards = GestionCartesConsulaire::where('status',"=","Validée")
        ->where("created_at", "LIKE", "%$date%")
        ->count('id');

        //le total des ventes
        $total=Ventes::all()->sum('montant');

        $mois=date('Y-m');
            // get all the movements in the stocks for the current mmonth
        $stocks=GestionStocks::Firstwhere('stocks.created_at',"LIKE","%$mois%"); 
        if (!$stocks==null) {
            $stock_total=$stocks->start+$stocks->entering;
        }

        return view('home.index',compact('citoyens','cards','pass','data','visas','nais','total','deces','maria','auto', 'leg', 'pro', 'citoyens_month','pass_month','nais_month','maria_month' ,'deces_month','auto_month','pro_month','leg_month','count_cards','stock_total'));
    }

    public function errors()
    {
        return view('error.error');
    }
}

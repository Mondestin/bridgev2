<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\GestionStocks;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
class GestionStocksController extends Controller
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
        // init
        $mois=date('Y-m');
        $entres="";
        $initials="";
        $category="";

        $count_cards = GestionCartesConsulaire::where('status',"=","Validée")
        ->where("created_at", "LIKE", "%$mois%")
        ->count('id');
    
        // get all the movements in the stocks for the current mmonth
        $stocks=GestionStocks::where('stocks.created_at',"LIKE","%$mois%")->get(); 

        // get the summary of the stock
        $data=DB::table('stocks')
                    ->select('stocks.category',DB::raw('SUM(stocks.start) as start'), DB::raw('SUM(stocks.entering) as entering'))
                    ->where('stocks.created_at',"LIKE","%$mois%")
                    ->groupBy('stocks.category')
                    ->get(); 
      
        return view('stocks.index',compact('entres','initials','category','data','stocks','mois','count_cards'));
    }

    public function find(Request $request)
    {
          // init
        $mois=$request->mois;
        $entres="";
        $initials="";
        $category="";

        $count_cards = GestionCartesConsulaire::where('status',"=","Validée")
        ->where("created_at", "LIKE", "%$mois%")
        ->count('id');

          // get all the movements in the stocks forr the current mmonth
        $stocks=GestionStocks::where('stocks.created_at',"LIKE","%$mois%")->get(); 

        // get the summary of the stock
        $data=DB::table('stocks')
                    ->select('stocks.category',DB::raw('SUM(stocks.start) as start'), DB::raw('SUM(stocks.entering) as entering'))
                    ->where('stocks.created_at',"LIKE","%$mois%")
                    ->groupBy('stocks.category')
                    ->get();  

        return view('stocks.index',compact('entres','initials','category','data','stocks','mois','count_cards'));
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
        $byUser=Auth::user()->name;
        $mois=date('Y-m');
          $request->validate([
            // VALIDATIONS
            'category'    =>  'required',
            'entering'=>  'required',
        ]);

        //check if the stock has been entered already 
        $stocks=GestionStocks::where('stocks.created_at',"LIKE","%{$mois}%")->get();  
        if (sizeof($stocks)>0) {
             return back()->with(
                    'error',
                    'Un stock a déjà été entré pour ce mois');
        } else {
            
             // GET DATA FROM THE FORM
                $form = array(
                    'category' =>  $request->category,
                    'start' =>  $request->start,
                    'entering'    =>  $request->entering,
                     'mois'    =>  $mois,
                    'byUser'   =>  $byUser,
                    );
            // save new stock
            $data = GestionStocks::create($form);
            return redirect()->route('stocks.index')->with(
                    'success',
                    'Le stock a été ajouté avec succès');
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
        return "today";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=GestionStocks::findOrFail($id);
        return view('stocks.edit',compact('data'));
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
            'start'    =>  'required',
            'entering'=>  'required',
            
        ]);

             // GET DATA FROM THE FORM
                $form = array(
                    'start' =>  $request->start,
                    'entering'    =>  $request->entering,
                    'obs'    =>  $request->obs,
                    'byUser'   =>  $byUser,
                    );
            // update stock
            $data = GestionStocks::whereId($id)->update($form);
            return redirect()->route('stocks.index')->with(
                    'success',
                    'Le stock a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas=GestionStocks::whereId($id)->delete();
          return redirect()->route('stocks.index')
                        ->with('success', 'Le stock a été supprimé avec succès');
    }
}

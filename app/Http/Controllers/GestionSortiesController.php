<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\GestionSorties;
class GestionSortiesController extends Controller
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

        $mois=date('Y-m');
        $data=GestionSorties::where('created_at',"LIKE","%{$mois}%")->get(); 

        // dd($data);
       return view('sorties.index', compact('data','mois'));
    }

    public function find(Request $request)
    {
          // init
        $mois=$request->mois;
        $data=GestionSorties::where('created_at',"LIKE","%{$mois}%")->get(); 

        // dd($mois);
       return view('sorties.index', compact('data','mois'));
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

        // 'title','desc' ,'amount' ,'status' ,'comment', 'emit_by','byUser'
        $byUser=Auth::user()->name;
        $mois=date('Y-m');
          $request->validate([
            // VALIDATIONS
            'title'    =>  'required',
            'amount'   =>  'required',
        ]);

             // GET DATA FROM THE FORM
                $form = array(
                    'title'     =>  $request->title,
                    'desc'      =>  $request->desc,
                    'amount'    =>  $request->amount,
                     'emit_by'  =>  $byUser,
                    );
            // save new sortie
            $data = GestionSorties::create($form);
            return redirect()->route('sorties.index')->with(
                    'success',
                    'Votre requête a été prise en compte avec succès');
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
         $data=GestionSorties::findOrFail($id);
        return view('sorties.edit',compact('data'));
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
            'title'    =>  'required',
            'amount'   =>  'required',
            'status'   =>  'required',
        ]);
             // GET DATA FROM THE FORM
                $form = array(
                    'title'     =>  $request->title,
                    'comment'   =>  $request->comment,
                    'amount'    =>  $request->amount,
                    'status'    =>  $request->status,
                     'byUser'   =>  $byUser,
                    );
            // update sortie
            $data = GestionSorties::whereId($id)->update($form);
            return redirect()->route('sorties.index')->with(
                    'success',
                    'La sortie a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas=GestionSorties::whereId($id)->delete();
          return redirect()->route('sorties.index')
                        ->with('success', 'La sortie a été supprimé avec succès');
    }
}

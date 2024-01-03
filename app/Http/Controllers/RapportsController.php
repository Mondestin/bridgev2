<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RapportsController extends Controller
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
        $date1=Date("Y-m-d");
        $date2=$date1;
        // get the data from in and out of the organization
        $data=DB::select("SELECT * from (SELECT id, dem_no, montant, types, updated_at FROM ventes UNION SELECT id, title, amount, status, updated_at FROM sorties order by updated_at asc) as result where result.updated_at BETWEEN '{$date1}' AND '{$date2}'"); 
        return view('rapports.index', compact('data','date1','date2'));
    }


   public function find(Request $request)
    {

         // dd($request);
          // init
        $date1=$request->date1;
        $date2=$request->date2;

          // get the data from in and out of the organization
        $data=DB::select("SELECT * from (SELECT id, dem_no, montant, types, updated_at FROM ventes UNION SELECT id, title, amount, status, updated_at FROM sorties order by updated_at asc) as result where result.updated_at BETWEEN '{$date1}' AND '{$date2}'"); 

        return view('rapports.index',compact('data','date1','date2'));
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
}

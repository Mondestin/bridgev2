<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestionsCitoyens;
use Auth;
use Image;
use Illuminate\Support\Facades\DB;
use App\GestionCartesConsulaire;
use App\Event;
class EventController extends Controller
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
        $data=DB::table('events')->orderBy('id','desc')->get();
        return view('events.index',compact('data'));
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
        //init
        $evt_color="";
        $find="";
         $request->validate([
            'titre'           =>  'required',
            'event_date'      =>  'required',
            'description'     =>  'required',
            'type'            =>  'required',
          ]);

        if ($request->type=="Urgent") {
            $evt_color="callout-danger";
        }
        elseif ($request->type=="Standard") {
            $evt_color="callout-info";
        }
        else{
            $evt_color="dfghjk";
        }

          // GET DATA FROM THE FORM
         $byUser=Auth::user()->name;
         $event = array(
            'titre'            =>  $request->titre,
            'event_date'       =>  $request->event_date,
            'description'      =>  $request->description,
            'type'             =>  $request->type,
            'byUser'           =>  $byUser,
            'color'            =>  $evt_color,
            );

        $data = Event::create($event);
            return redirect()->route('events.index')->with(
                    'success',
                    'Evénement créer avec succès');
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
          $id=$request->event_id;
            //init
        $evt_color="";
        $find="";
         $request->validate([
            'titre'           =>  'required',
            'event_date'      =>  'required',
            'description'     =>  'required',
            'type'            =>  'required',
          ]);

        if ($request->type=="Urgent") {
            $evt_color="callout-danger";
        }
        elseif ($request->type=="Standard") {
            $evt_color="callout-info";
        }
        else{
            $evt_color="dfghjk";
        }
          // GET DATA FROM THE FORM
         $byUser=Auth::user()->name;
         $event = array(
            'titre'            =>  $request->titre,
            'event_date'       =>  $request->event_date,
            'description'      =>  $request->description,
            'type'             =>  $request->type,
            'byUser'           =>  $byUser,
            'color'            =>  $evt_color
            );

        $data = Event::whereId($id)->update($event);
            return redirect()->route('events.index')->with(
                    'success',
                    'Evénement actualisé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas=Event::whereId($id)->delete();
          return redirect()->route('events.index')
                        ->with('success', 'Evénement éffacé avec succès');
    }
}

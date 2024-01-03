<?php

namespace App\Http\Controllers;

use Auth;
use App\Legalisations;
use App\GestionsCitoyens;
use PHPUnit\Util\Exception;
use Illuminate\Http\Request;
use App\GestionCartesConsulaire;
use Illuminate\Support\Facades\DB;

use App\Exports\ExportLegalisations;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class LegalisationsController extends Controller
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
        $data=Legalisations::all();
        $date1="";
        $date2="";
       return view('legalisations.index',compact('data','date1','date2'));
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
        return view('legalisations.create',compact('data','citoyens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $filename="";
            $request->validate([
            // VALIDATIONS
            'school_name'    =>  'required',
            'place_emission' =>  'required',
            'date_delivrance'=>  'required',
            'document'       =>  'required',
            'type'           =>  'required',
            'name'           =>  'required',
            'surname'        =>  'required',
            'phone'          =>  'required',
            'email'          =>  'required',
            'type_legalisation' => 'required',
             ]);


               if ($request->hasFile('document')) {
                    try {
                        $doc = $request->file('document');
                        
                        // Get the extension of the uploaded file
                        $extension = $doc->getClientOriginalExtension();
                        
                        // Define an array of allowed image extensions
                        $allowedImageExtensions = ['jpg', 'jpeg', 'png'];
                
                        // Check if the file extension is in the allowed image list
                        if (in_array(strtolower($extension), $allowedImageExtensions)) {
                            $filename = rand(1000000, 9999999) . '.' . $extension;
                            Image::make($doc)->save(public_path('/uploads/diplomes/' . $filename));
                        } elseif (strtolower($extension) === 'pdf') {
                            // Handle PDF files separately
                            $filename = rand(1000000, 9999999) . '.pdf';
                            $doc->move(public_path('/uploads/diplomes/'), $filename);
                        } else {
                            return back()->with('error', 'Veuillez sélectionner un fichier au format JPG, JPEG, PNG ou PDF.');
                        }
                    } catch (Exception $e) {
                        return back()->with('error', 'Veuillez changer le format du fichier.');
                    }
                }


                
                    // GET DATA FROM THE FORM
                $form = array(

                'school_name'    =>  $request->school_name,
                'place_emission' =>  $request->place_emission,
                'date_delivrance'=>  $request->date_delivrance,
                'type'           =>  $request->type,
                'document'       =>  $filename,
                'type_legalisation' => $request->type_legalisation,
                 'name'           =>  $request->name,
                'surname'        =>  $request->surname,
                'phone'          =>  $request->phone,
                'email'          =>  $request->email
                );
                // save new Legalisation
                Legalisations::create($form);
                return redirect()->route('legalisations.index')->with(
                        'success',
                        'La demande a été enregistrée avec succès');

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
        return view('legalisations.create',compact('data','citoyens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

          $data=Legalisations::whereId($id)->first();

        return view('legalisations.edit', compact('data'));
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


        $filename="";
            $request->validate([
            // VALIDATIONS
            'school_name'    =>  'required',
            'place_emission' =>  'required',
            'date_delivrance'=>  'required',
            'type'           =>  'required',
            'name'           =>  'required',
            'surname'        =>  'required',
            'phone'          =>  'required',
            'email'          =>  'required',
            'type_legalisation' => 'required'
             ]);

           if ($request->hasFile('document')) {
                    try {
                        $doc = $request->file('document');
                        
                        // Get the extension of the uploaded file
                        $extension = $doc->getClientOriginalExtension();
                        
                        // Define an array of allowed image extensions
                        $allowedImageExtensions = ['jpg', 'jpeg', 'png'];
                
                        // Check if the file extension is in the allowed image list
                        if (in_array(strtolower($extension), $allowedImageExtensions)) {
                            $filename = rand(1000000, 9999999) . '.' . $extension;
                            Image::make($doc)->save(public_path('/uploads/diplomes/' . $filename));
                        } elseif (strtolower($extension) === 'pdf') {
                            // Handle PDF files separately
                            $filename = rand(1000000, 9999999) . '.pdf';
                            $doc->move(public_path('/uploads/diplomes/'), $filename);
                        } else {
                            return back()->with('error', 'Veuillez sélectionner un fichier au format JPG, JPEG, PNG ou PDF.');
                        }
                    } catch (Exception $e) {
                        return back()->with('error', 'Veuillez changer le format du fichier.');
                    }
                
           
                $form = array(

                'school_name'    =>  $request->school_name,
                'place_emission' =>  $request->place_emission,
                'date_delivrance'=>  $request->date_delivrance,
                'type'           =>  $request->type,
                'document'       =>  $filename,
                'type_legalisation' => $request->type_legalisation,
                'name'           =>  $request->name,
                'surname'        =>  $request->surname,
                'phone'          =>  $request->phone,
                'email'          =>  $request->email,
                );
            }
            else {
                $form = array(

                'school_name'    =>  $request->school_name,
                'place_emission' =>  $request->place_emission,
                'date_delivrance'=>  $request->date_delivrance,
                'type'           =>  $request->type,
                'type_legalisation' => $request->type_legalisation,
                'name'           =>  $request->name,
                'surname'        =>  $request->surname,
                'phone'          =>  $request->phone,
                'email'          =>  $request->email,
                );
            }

             // dd(Legalisations::whereId($id)->update($form));
                // save new Legalisation
                $demande=Legalisations::whereId($id)->update($form);
                return redirect()->route('legalisations.index')->with(
                        'success',
                        'La demande a été validée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $demande=Legalisations::whereId($id)->delete();
                return redirect()->route('legalisations.index')->with(
                        'success',
                        'La demande a été suppimée avec succès');
    }

    public function printPage()
    {
          $data=DB::table('gestions_citoyens')
                    ->join('legalisations','gestions_citoyens.citoyen_no','=','legalisations.citoyen_no')
                    ->select('gestions_citoyens.*','legalisations.*')
                    ->get();
        return view("legalisations.print",compact("data"));
    }
    // export to excel
    public function getExcel()
    {
        return Excel::download(new ExportLegalisations, 'liste_des_legalisations.xlsx');
    }

    public function find(Request $request)
    {
        //init
        $date1=$request->date1;
        $date2=$request->date2;
        $print="";
        $see="";
         //get all pass-card made and associated to people
       $data=DB::table('legalisations')
       ->select('legalisations.*')
       ->whereBetween('legalisations.created_at', [$date1, $date2])
       ->get();

        return view('legalisations.index', compact('data','date1','date2'));
    }
    // print the stamp behind the page
    public function printStamp($id){
        
        $data=Legalisations::whereId($id)->first();
        
        if($data->type_legalisation=="Copie Conforme"){
          return view('legalisations.stampCopy', compact('id'));
        }
        else if($data->type_legalisation=="Signature"){
            return view('legalisations.stampSign', compact('id', 'data'));
        }
        else {
            dd("hello");
            return ;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use App\GestionsCitoyens;
use Illuminate\Http\Request;
use App\Exports\CitoyenExport;
use App\GestionCartesConsulaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Traits\ActionsButtons;

class GestionsCitoyensController extends Controller
{
    use ActionsButtons;
    private string $modelRoute="citoyens";

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
        $date1="";
        $date2="";

        if(request()->ajax()) {
            return datatables()->of(GestionsCitoyens::select('*')->orderBy('id', 'desc'))
            ->addIndexColumn()
            ->addColumn('id_status', function($data){
                 $color=$data->id_status=="Non confirmée" ? "bg-warning" : "bg-success";
                 $status=$data->id_status=="Non confirmée" ? "Non confirmée" : "Confirmée";
                return '<span class="badge '.$color.'">'.$status.'</span>';
            })
            ->addColumn('actions', function($data){
                return $this->actionTablesButtons($data->id, $this->modelRoute);
            })
            ->rawColumns(['actions','id_status'])
            ->make(true);
        }
        return view('citoyens.index',compact('date1','date2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('citoyens.nouveau');
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
        $id_status="Non confirmée";
        $this->checkForm($request);


        // generate a citoyens code
        $year=Date('Y');
        // get last id and add 1 to it
        $lastId=GestionsCitoyens::max('id')+1;
        $code=Date('m')."".$lastId."/CGHBC/".$year;

        if ($request->id_status=="Confirmée") {

              $request->validate([
                'id_number'         =>  'required',
                'date_emission'     =>  'required',
                'date_expiration'   =>  'required',
                'place_emission'    =>  'required',
                'id_type'           =>  'required',
                'id_doc'            =>  'required',
               ]);
               $id_status="Confirmée";
               $userName=$request->id_number;
               $check=GestionsCitoyens::where("id_number","LIKE", "%$userName%")->get();
                       //the cityoen is already registered
        if (sizeof($check)>0) {
            return redirect()->route('citoyens.create')->with(
                   'error',
                   'Un Citoyen existe déjà avec cette identitée');
           }
       else{
              //if the user has a avatar to upload
          if($request->hasFile('avatar')){
               $avatar = $request->file('avatar');
               $filename =Date('m').rand(10000, 99999). '.' . $avatar->getClientOriginalExtension();
               Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/citoyens/' . $filename ) );
           }
           else{
                $filename="user.png";
           }
            //save the id document
            $idfile = $request->file('id_doc');
            $idfilename = date('YmdHi') . $idfile->getClientOriginalName();
            $idfile->move(public_path('/uploads/citoyens/ids/'), $idfilename);

               // GET CITOYEN DATA FROM THE FORM
               $citoyen_form = array(
                   'avatar'            =>  $filename,
                   'surname'           =>  $request->surname,
                   'citoyen_no'        =>  $code,
                   'name'              =>  $request->name,
                   'dob'               =>  $request->dob,
                   'pofbirth'          =>  $request->pofbirth,
                   'sexe'              =>  $request->sexe,
                   'nationality'       =>  $request->nationality,
                   'mother'            =>  $request->mother,
                   'father'            =>  $request->father,
                   'profession'        =>  $request->profession,
                   'coutume'           =>  $request->coutume,
                   'taille'            =>  $request->taille,
                   'eye_color'         =>  $request->eye_color,
                   'cheuveux'          =>  $request->cheuveux,
                   'pa_sign'           =>  $request->pa_sign,
                   'addressFirstCountry'=> $request->addressFirstCountry,
                   'addressSecondCountry' =>  $request->addressSecondCountry,
                   'tuteur'            =>  $request->tuteur,
                   'phone'             =>  $request->phone,
                   'id_number'         =>  $request->id_number,
                   'id_type'           =>  $request->id_type,
                   'id_doc'            =>  $idfilename,
                   'date_emission'     =>  $request->date_emission,
                   'date_expiration'   =>  $request->date_expiration,
                   'place_emission'    =>  $request->place_emission,
                   'byUser'            =>  $byUser,
                   'email'             =>  $request->email,
                   'id_status'         =>  $id_status,
                   );
           // save new citoyen
           $citoyen = GestionsCitoyens::create($citoyen_form);
           return redirect()->route('citoyens.index')->with(
                   'success',
                   'Citoyen ajouté avec succès');
           }
        }else{
                     //if the user has a avatar to upload
          if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename =Date('m').rand(10000, 99999). '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/citoyens/' . $filename ) );
        }
        else{
             $filename="user.png";
        }
            // GET CITOYEN DATA FROM THE FORM
            $citoyen_form = array(
                'avatar'            =>  $filename,
                'surname'           =>  $request->surname,
                'citoyen_no'        =>  $code,
                'name'              =>  $request->name,
                'dob'               =>  $request->dob,
                'pofbirth'          =>  $request->pofbirth,
                'sexe'              =>  $request->sexe,
                'nationality'       =>  $request->nationality,
                'mother'            =>  $request->mother,
                'father'            =>  $request->father,
                'profession'        =>  $request->profession,
                'coutume'           =>  $request->coutume,
                'taille'            =>  $request->taille,
                'eye_color'         =>  $request->eye_color,
                'cheuveux'          =>  $request->cheuveux,
                'pa_sign'           =>  $request->pa_sign,
                'addressFirstCountry'=> $request->addressFirstCountry,
                'addressSecondCountry' =>  $request->addressSecondCountry,
                'tuteur'            =>  $request->tuteur,
                'phone'             =>  $request->phone,
                'byUser'            =>  $byUser,
                'email'             =>  $request->email,
                'id_status'         =>  $id_status,
                );
        // save new citoyen
        $citoyen = GestionsCitoyens::create($citoyen_form);
        return redirect()->route('citoyens.index')->with(
                'success',
                'Citoyen ajouté avec succès');
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
        // find the citoyen using his unique id number
        $data=GestionsCitoyens::findOrFail($id);
        return view('citoyens.profile',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the citoyen using his unique id number
        $data=GestionsCitoyens::findOrFail($id);

        return view('citoyens.update',compact('data'));
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
        $id_status="Non confirmée";
        $this->checkForm($request);


        // generate a citoyens code
        $year=Date('Y');
        $month=Date('m');
        // get last id and add 1 to it
        $data=GestionsCitoyens::whereId($id)->first();
        $code=$data->citoyen_no;

        if ($request->id_status=="Confirmée") {

              $request->validate([
                'id_number'         =>  'required',
                'date_emission'     =>  'required',
                'date_expiration'   =>  'required',
                'place_emission'    =>  'required'
               ]);
               $id_status="Confirmée";
               $userName=$request->id_number;

              //if the user has a avatar to upload
          if($request->hasFile('avatar')){
               $avatar = $request->file('avatar');
               $filename =Date('m').rand(10000, 99999). '.' . $avatar->getClientOriginalExtension();
               Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/citoyens/' . $filename ) );
           }
           else{
                $filename="user.png";
           }

               // GET CITOYEN DATA FROM THE FORM
               $citoyen_form = array(
                   'avatar'            =>  $filename,
                   'surname'           =>  $request->surname,
                   'citoyen_no'        =>  $code,
                   'name'              =>  $request->name,
                   'dob'               =>  $request->dob,
                   'pofbirth'          =>  $request->pofbirth,
                   'sexe'              =>  $request->sexe,
                   'nationality'       =>  $request->nationality,
                   'mother'            =>  $request->mother,
                   'father'            =>  $request->father,
                   'profession'        =>  $request->profession,
                   'coutume'           =>  $request->coutume,
                   'taille'            =>  $request->taille,
                   'eye_color'         =>  $request->eye_color,
                   'cheuveux'          =>  $request->cheuveux,
                   'pa_sign'           =>  $request->pa_sign,
                   'addressFirstCountry'=> $request->addressFirstCountry,
                   'addressSecondCountry' =>  $request->addressSecondCountry,
                   'tuteur'            =>  $request->tuteur,
                   'phone'             =>  $request->phone,
                   'id_number'         =>  $request->id_number,
                   'date_emission'     =>  $request->date_emission,
                   'date_expiration'   =>  $request->date_expiration,
                   'place_emission'    =>  $request->place_emission,
                   'byUser'            =>  $byUser,
                   'email'             =>  $request->email,
                   'id_status'         =>  $id_status,
                   );
           // save new citoyen
           $citoyen = GestionsCitoyens::whereId($id)->update($citoyen_form);
           return redirect()->route('citoyens.index')->with(
                   'success',
                   'Citoyen actualisé avec succès');

        }else{
                     //if the user has a avatar to upload
          if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename =Date('m').rand(10000, 99999). '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/citoyens/' . $filename ) );
        }
        else{
             $filename="user.png";
        }
            // GET CITOYEN DATA FROM THE FORM
            $citoyen_form = array(
                'avatar'            =>  $filename,
                'surname'           =>  $request->surname,
                'citoyen_no'        =>  $code,
                'name'              =>  $request->name,
                'dob'               =>  $request->dob,
                'pofbirth'          =>  $request->pofbirth,
                'sexe'              =>  $request->sexe,
                'nationality'       =>  $request->nationality,
                'mother'            =>  $request->mother,
                'father'            =>  $request->father,
                'profession'        =>  $request->profession,
                'coutume'           =>  $request->coutume,
                'taille'            =>  $request->taille,
                'eye_color'         =>  $request->eye_color,
                'cheuveux'          =>  $request->cheuveux,
                'pa_sign'           =>  $request->pa_sign,
                'addressFirstCountry'=> $request->addressFirstCountry,
                'addressSecondCountry' =>  $request->addressSecondCountry,
                'tuteur'            =>  $request->tuteur,
                'phone'             =>  $request->phone,
                'byUser'            =>  $byUser,
                'email'             =>  $request->email,
                'id_status'         =>  $id_status,
                );
        // save new citoyen
        // $citoyen = GestionsCitoyens::create($citoyen_form);
          $citoyen = GestionsCitoyens::whereId($id)->update($citoyen_form);
            return redirect()->route('citoyens.index')->with(
                    'success',
                    'Citoyen actualisé avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
         $levelStatus=Auth::user()->level;
       // check if the user is an admin
        if ($levelStatus=="admin" || $levelStatus=="super-admin") {
                $hashedPassword=Auth::user()->getAuthPassword();
                // check if the user submitted the right password
                if (Hash::check($request->password, $hashedPassword)) {
                    $datas=GestionsCitoyens::whereId($request->id)->first();
                    // check if there is a consular card linked
                    $cardExist=GestionCartesConsulaire::where('id_number', '=', $datas->citoyen_no)->first();
                    if(!$cardExist)
                    {
                       $datas->delete();
                       return response()->json(['success' =>'Citoyen supprimé avec succès']);
                    }
                    return response()->json(['error' =>'Le citoyen est lié à une carte consulaire']);
                }
                else {
                    return response()->json(['error' =>'le mot de passe est incorrect']);
                }
         }
        else{
            return response()->json(['error' =>"Vous n'avez pas acces à ce niveau"]);
        }
    }


    // check the inputs
    public function checkForm($request){

        return $request->validate([
            // CITOYENS VALIDATIONS
            'surname'           =>  'required',
            'name'              =>  'required',
            // 'phone'             =>  'required',
            'pofbirth'          =>  'required',
            'sexe'              =>  'required',
            'nationality'       =>  'required',
            'profession'        =>  'required',
            'dob'               =>  'required',
            'taille'            =>  'required',
            'eye_color'         =>  'required',
            'cheuveux'          =>  'required',
            'id_status'         =>  'required',
            'addressSecondCountry'=>  'required',
        ]);
    }
    // export to excel
    public function getExcel()
    {
        return Excel::download(new CitoyenExport, 'liste_citoyens.xlsx');
    }

     //print all citoyen
     public function printCitoyens(Request $request)
     {

        // init
        $date1=$request->date1;
        $date2=$request->date2;
        $data="";
        if ($date1 != null && $date2 != null) {
            $data=DB::select("SELECT *  FROM gestions_citoyens  where gestions_citoyens.created_at BETWEEN '{$date1}' AND '{$date2}'");
        }
        else {
            $data=GestionsCitoyens::all();
        }
        return view('citoyens.print',compact('data','date1','date2'));
     }


   public function find(Request $request)
   {
        // init
        $date1=$request->date1;
        $date2=$request->date2;
        $data=DB::select("SELECT *  FROM gestions_citoyens  WHERE gestions_citoyens.created_at BETWEEN '{$date1}' AND '{$date2}'");

        return view('citoyens.filter',compact('data','date1','date2'));
   }
}

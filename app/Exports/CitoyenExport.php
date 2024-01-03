<?php

namespace App\Exports;

use App\GestionsCitoyens;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class CitoyenExport implements FromView
{

    public function view(): View
    {
        $data=DB::table('gestions_citoyens')
                    ->select('citoyen_no', 'surname','name','dob' ,'pofbirth' ,'sexe' ,'nationality' ,'mother' ,'father' ,'profession' ,'coutume' ,'taille' ,'eye_color' ,'cheuveux' ,'pa_sign' ,'addressFirstCountry' ,'addressSecondCountry' ,'tuteur' ,'phone' ,'id_number' ,'date_emission' ,'date_expiration' ,'place_emission','email','id_type','id_status'  )
                    ->get();
        return view('citoyens.exportdata', [
            'data' => $data
        ]);
    }
}

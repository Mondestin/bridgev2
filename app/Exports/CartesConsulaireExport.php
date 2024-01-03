<?php

namespace App\Exports;

use App\GestionCartesConsulaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
class CartesConsulaireExport implements FromView
{

    public function view(): View
    {
          $data=DB::table('gestions_citoyens')
                    ->join('gestion_cartes_consulaires','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->get();

        return view('cartes.export', [
            'data' => $data
        ]);
    }
}

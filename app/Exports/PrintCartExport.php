<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
class PrintCartExport implements FromView
{
    public function view(): View
    {
          $data=DB::table('gestions_citoyens')
                    ->join('gestion_cartes_consulaires','gestions_citoyens.citoyen_no','=','gestion_cartes_consulaires.id_number')
                    ->select('gestions_citoyens.*','gestion_cartes_consulaires.*')
                    ->where('gestion_cartes_consulaires.card_status', 'LIKE', 'Validée')
                    ->where('gestion_cartes_consulaires.print_status', 'LIKE', 'Non imprimée')
                    ->get();

        return view('cartes.exportprint', [
            'data' => $data
        ]);
    }
}

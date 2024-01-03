<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class PassExport implements FromView
{
    public function view(): View
    {
        //get all pass-card made and associated to people
        $data=DB::table('gestions_citoyens')
        ->join('lasser_passers','gestions_citoyens.citoyen_no','=','lasser_passers.id_number')
        ->select('gestions_citoyens.*','lasser_passers.*')
        ->get();
        
        return view('pass.exportdata', [
            'data' => $data
        ]);
    }
}

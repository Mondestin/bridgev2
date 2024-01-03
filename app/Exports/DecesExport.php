<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DecesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
  
    public function view(): View
    {
        //get all pass-card made and associated to people
        $data=DB::table('deces')
        ->select('*')
        ->get();
        
        return view('deces.exportdata', [
            'data' => $data
        ]);
    }
}

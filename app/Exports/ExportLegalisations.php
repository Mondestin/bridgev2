<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ExportLegalisations implements FromView
{
   /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data=DB::table('procurations')
                    ->select('*' )
                    ->get();
        return view('procurations.exportdata', [
            'data' => $data
        ]);
    }
}

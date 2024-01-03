<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
class ExportProcurations implements FromView
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

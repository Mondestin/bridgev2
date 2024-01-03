<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportMariage implements FromView
{   /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data=DB::table('mariages')
                    ->select('*' )
                    ->get();
        return view('mariage.exportdata', [
            'data' => $data
        ]);
    }
}

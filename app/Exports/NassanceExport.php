<?php

namespace App\Exports;


use App\Naissances;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class NassanceExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data=DB::table('naissances')
                    ->select('*' )
                    ->get();
        return view('naissances.exportdata', [
            'data' => $data
        ]);
    }
}

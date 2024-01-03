<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
class ExportAutorisations implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data=DB::table('authorisations')
                    ->select('*' )
                    ->get();
        return view('authorisations.exportdata', [
            'data' => $data
        ]);
    }
}

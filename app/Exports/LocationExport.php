<?php

namespace App\Exports;

use App\Models\Coordinate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LocationExport implements FromView
{
    
    public function view(): View
    {
        return view('template.export-coordinates', [
            'coordinates' => Coordinate::all()
        ]);
    }

    
}

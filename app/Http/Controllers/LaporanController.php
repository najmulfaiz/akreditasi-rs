<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Pokja;

class LaporanController extends Controller
{
    public function capaian() 
    {
        $pokjas = Pokja::all();
        $pdf    = PDF::loadView('laporan.capaian', compact('pokjas'));

        return $pdf->stream();
    }

    public function dokumen()
    {
    	$pokjas = Pokja::all();
        $pdf    = PDF::loadView('laporan.dokumen', compact('pokjas'));
        
        return $pdf->stream();
    }
}

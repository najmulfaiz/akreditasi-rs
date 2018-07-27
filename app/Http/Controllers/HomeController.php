<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function capaian()
    {
        $pokjas = \App\Pokja::all();

        $capaian = [];

        foreach($pokjas as $index => $pokja):
            $bab_skor = 0;
            $bab_maksimal = 0;

            foreach($pokja->standar as $standar):
                
                $skor = 0;
                $maksimal = 0;

                foreach($standar->elemen as $elemen):
                    $skor += $elemen->nilai;
                    $maksimal += 10;
                endforeach;
                
                $bab_skor += $skor;
                $bab_maksimal += $maksimal;

            endforeach;
            $skor = $bab_maksimal == 0 ? 0 : (($bab_skor / $bab_maksimal) * 100);

            $capaian[] = array(
                $pokja->singkatan,
                $skor
            );
        endforeach;

        return response()->json($capaian);
    }
}

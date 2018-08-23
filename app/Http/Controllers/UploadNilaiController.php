<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $standar = \App\Standar::find($id);
        $elemens = \App\Elemen::where('standar_id', $id)
                    ->orderBy('nama')
                    ->get();

        return view('upload-nilai.index', compact('elemens', 'id', 'standar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pokja()
    {
        $pokjas = \App\Pokja::all();

        return view('upload-nilai.pokja', compact('pokjas'));
    }

    public function standar($id)
    {
        $pokja = \App\Pokja::find($id);
        $standars = \App\Standar::where('pokja_id', $id)
                    ->orderBy('nama', 'asc')
                    ->get();

        return view('upload-nilai.standar', compact('standars', 'pokja'));
    }
}

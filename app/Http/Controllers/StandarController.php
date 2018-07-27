<?php

namespace App\Http\Controllers;

use App\Standar;
use Illuminate\Http\Request;

class StandarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $standars = Standar::orderBy('nama')
                    ->get();
        return view('standar.index', compact('standars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pokjas = \App\Pokja::orderBy('nama')
                    ->get();

        return view('standar.create', compact('pokjas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:15',
            'deskripsi' => 'required',
            'pokja' => 'required'
        ]);

        $standar = Standar::create([
            'nama' => $request['nama'],
            'deskripsi' => $request['deskripsi'],
            'pokja_id' => $request['pokja']
        ]);

        return redirect()->route('standar.index')->with('pesan', 'Standar "' . $standar->nama . '" berhasil ditambahkan!');
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
        $standar = Standar::findOrFail($id);
        $pokjas = \App\Pokja::orderBy('nama')
                    ->get();

        return view('standar.edit', compact('standar' ,'pokjas'));
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
        $this->validate($request, [
            'nama' => 'required|max:15',
            'deskripsi' => 'required',
            'pokja' => 'required'
        ]);

        $standar = Standar::findOrFail($id);

        $standar->nama      = $request['nama'];
        $standar->deskripsi = $request['deskripsi'];
        $standar->pokja_id  = $request['pokja'];
        $standar->update();

        return redirect()->route('standar.index')->with('pesan', 'Standar "' . $standar->nama . '" berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Standar::destroy($id);
    }
}

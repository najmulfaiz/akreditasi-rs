<?php

namespace App\Http\Controllers;

use App\Pokja;
use Illuminate\Http\Request;

class PokjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pokjas = Pokja::all();

        return view('pokja.index', compact('pokjas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pokja.create');
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
            'nama' => 'required|max:100'
        ]);

        $pokja = Pokja::create($request->all());

        return redirect()->route('pokja.index')->with('pesan', 'Pokja ' . $pokja->nama . ' berhasil ditambahkan!');
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
        $pokja = Pokja::findOrFail($id);

        return view('pokja.edit', compact('pokja'));
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
            'nama' => 'required|max:100'
        ]);

        $pokja = Pokja::findOrFail($id);

        $pokja->nama = $request['nama'];
        $pokja->update();

        return redirect()->route('pokja.index')->with('pesan', 'Pokja ' . $pokja->nama . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pokja::destroy($id);
    }
}
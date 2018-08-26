<?php

namespace App\Http\Controllers;

use App\Standar;
use Illuminate\Http\Request;
use Excel;

class StandarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pokja = \App\Pokja::where('id', $id)->first();

        $standars = Standar::where('pokja_id', $id)
                    ->orderBy('nama')
                    ->get();
        return view('standar.index', compact('standars', 'pokja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pokjas = \App\Pokja::orderBy('nama')
                    ->get();

        return view('standar.create', compact('id', 'pokjas'));
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

        return redirect()->route('standar.index', $standar->pokja_id)->with('pesan', 'Standar "' . $standar->nama . '" berhasil ditambahkan!');
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

        return redirect()->route('standar.index', $standar->pokja_id)->with('pesan', 'Standar "' . $standar->nama . '" berhasil diubah!');
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

    public function pokja()
    {
        $pokjas = \App\Pokja::all();

        return view('standar.pokja', compact('pokjas'));
    }

    public function import(Request $request, $id)
    {
        if($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()) {
                foreach($data as $key => $value) {
                    $standar = new Standar;
                    $standar->nama = $value->nama;
                    $standar->deskripsi = $value->deskripsi;
                    $standar->pokja_id = $id;
                    $standar->save();
                }

                return redirect()->route('standar.index', $id)->with('pesan', 'Standar berhasil di input');
            }
        }
        return redirect()->route('standar.index', $id)->with('pesan', 'Oops... terjadi kesalahan');
    }
}

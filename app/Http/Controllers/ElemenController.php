<?php

namespace App\Http\Controllers;

use App\Elemen;
use Illuminate\Http\Request;
use Excel;

class ElemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $standar = \App\Standar::find($id);
        $elemens = Elemen::where('standar_id', $id)
                    ->orderBy('nama')
                    ->get();

        return view('elemen.index', compact('elemens', 'id', 'standar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('elemen.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|max:50',
            'deskripsi' => 'required'
        ]);

        $elemen = Elemen::create([
            'nama' => $request['nama'],
            'deskripsi' => $request['deskripsi'],
            'standar_id' => $id
        ]);

        return redirect()->route('elemen.index', $id)->with('pesan', 'Elemen "' . $elemen->nama . '" berhasil ditambahkan!');
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
        $elemen = Elemen::findOrFail($id);

        return view('elemen.edit', compact('elemen'));
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
            'nama' => 'required|max:50',
            'deskripsi' => 'required'
        ]);

        $elemen = Elemen::findOrFail($id);

        $elemen->nama = $request['nama'];
        $elemen->deskripsi = $request['deskripsi'];
        $elemen->update();

        return redirect()->route('elemen.index', $elemen->standar_id)->with('pesan', 'Elemen "' . $elemen->nama . '" berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Elemen::destroy($id);
    }

    public function pokja()
    {
        $pokjas = \App\Pokja::all();

        return view('elemen.pokja', compact('pokjas'));
    }

    public function standar($id)
    {
        $pokja = \App\Pokja::find($id);
        $standars = \App\Standar::where('pokja_id', $id)
                    ->orderBy('nama', 'asc')
                    ->get();

        return view('elemen.standar', compact('standars', 'pokja'));
    }

    public function nilai(Request $request, $id)
    {
        $elemen = Elemen::findOrFail($id);

        $elemen->nilai = $request->nilai;
        $elemen->update();

        return response()->json([
            'error' => false,
            'msg' => 'Nilai berhasil disimpan'
        ]);
    }

    public function note(Request $request, $id)
    {
        $elemen = Elemen::findOrFail($id);

        $elemen->note = $request->note;
        $elemen->update();

        return response()->json([
            'error' => false,
            'msg' => 'Catatan berhasil disimpan'
        ]);
    }

    public function import(Request $request)
    {
        if($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()) {
                $standar_ = '';

                foreach($data as $key => $value) {
                    if($value->standar != $standar_) {
                        $standar_ = $value->standar;
                        $standar = \App\Standar::where('nama', '=', $value->standar)->first();
                        
                    }
                    
                    if($standar) {
                        $elemen = new Elemen;
                        $elemen->nama = $value->nama;
                        $elemen->deskripsi = $value->deskripsi;
                        $elemen->standar_id = $standar->id;
                        $elemen->save();
                    }
                }

                return redirect()->route('elemen.pokja')->with('pesan', 'Elemen berhasil di input');
            }
        }
        return redirect()->route('elemen.standar', $standar->id)->with('pesan', 'Oops... terjadi kesalahan');
    }
}

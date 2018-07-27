<?php

namespace App\Http\Controllers;

use App\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $elemen = \App\Elemen::find($id);
        $dokumens = Dokumen::orderBy('deskripsi')
                            ->where('elemen_id', $id)
                            ->get();

        return view('dokumen.index', compact('dokumens', 'id', 'elemen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('dokumen.create', compact('id'));
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
            'deskripsi' => 'required',
            'file' => 'required'
        ]);

        $input = $request->all();
        $input['filename'] = null;

        if($request->hasFile('file')) {
            $input['filename'] = 'upload/dokumen/' . date('ymdhis') . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/dokumen'), $input['filename']);
        }

        $dokumen = Dokumen::create([
            'deskripsi' => $input['deskripsi'],
            'filename' => $input['filename'],
            'elemen_id' => $id
        ]);

        return redirect()->route('dokumen.index', $id)->with('pesan', 'Dokumen "' . $dokumen->deskripsi . '" berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        // dd($dokumen);
        return response()->file(public_path($dokumen->filename));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        return view('dokumen.edit', compact('dokumen'));
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
            'deskripsi' => 'required'
        ]);

        $dokumen = Dokumen::findOrFail($id);

        $input = $request->all();
        $input['filename'] = $dokumen->filename;

        if($request->hasFile('file')) {
            if($dokumen->filename != NULL) {
                unlink(public_path($dokumen->filename));
            }

            $input['filename'] = 'upload/dokumen/' . date('ymdhis') . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/dokumen'), $input['filename']);
        }

        $dokumen->deskripsi = $input['deskripsi'];
        $dokumen->filename = $input['filename'];
        $dokumen->update();

        return redirect()->route('dokumen.index', $dokumen->elemen_id)->with('pesan', 'Dokumen "' . $dokumen->deskripsi . '" berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if($dokumen->filename != NULL) {
            unlink(public_path($dokumen->filename));
        }

        Dokumen::destroy($id);

        return response()->json([
            'error' => false,
            'msg' => 'Berhasil menghapus dokumen'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = [ 1 => 'Super Admin', 'Ketua Akreditasi', 'Ketua Pokja', 'Anggota Pokja'];
        $users = User::orderBy('name', 'asc')
                        ->get();

        return view('user.index', compact('users', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pokjas = \App\Pokja::orderBy('nama', 'asc')
                            ->get();

        return view('user.create', compact('pokjas'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'level' => 'required',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'level' => $request['level'],
            'pokja' => $request['pokja'],
        ]);

        return redirect()->route('user.index')->with('pesan', 'User ' . $user->name . ' berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $pokjas = \App\Pokja::orderBy('nama', 'asc')
                            ->get();

        return view('user.edit', compact('user', 'pokjas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:6|confirmed',
            'level' => 'required',
        ]);

        $user = User::findOrFail($id);
        
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->level    = $request['level'];
        $user->pokja    = $request['pokja'];
        $user->update();

        return redirect()->route('user.index')->with('pesan', 'User ' . $user->name . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}

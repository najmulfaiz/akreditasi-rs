<?php

Route::get('/', function () {
	return redirect('home');
    // return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/capaian', 'HomeController@capaian')->name('home.capaian');

Route::group(['middleware' => ['auth']], function () {
	Route::resource('user', 'UserController')->except(['show']);
	Route::resource('pokja', 'PokjaController')->except(['show']);
	Route::resource('standar', 'StandarController')->except(['show', 'index', 'create']);
	Route::get('/standar/{id}/create', 'StandarController@create')->name('standar.create');
	Route::get('/standar/{id}/list', 'StandarController@index')->name('standar.index');
	Route::get('standar/pokja', 'StandarController@pokja')->name('standar.pokja');

	// ELEMEN ROUTING
	Route::get('pokja/elemen', 'ElemenController@pokja')->name('elemen.pokja');
	Route::get('pokja/{id}/standar/elemen', 'ElemenController@standar')->name('elemen.standar');
	Route::get('pokja/standar/{id}/elemen', 'ElemenController@index')->name('elemen.index');
	Route::get('pokja/standar/{id}/elemen/create', 'ElemenController@create')->name('elemen.create');
	Route::post('pokja/standar/{id}/elemen', 'ElemenController@store')->name('elemen.store');
	Route::get('pokja/standar/elemen/{id}/edit', 'ElemenController@edit')->name('elemen.edit');
	Route::patch('pokja/standar/elemen/{id}', 'ElemenController@update')->name('elemen.update');
	Route::patch('pokja/standar/elemen/{id}/nilai', 'ElemenController@nilai')->name('elemen.nilai');
	Route::delete('pokja/standar/elemen/{id}', 'ElemenController@destroy')->name('elemen.destroy');
	Route::patch('elemen/{id}/note', 'ElemenController@note')->name('elemen.note');

	// UPLOAD & PENILAIAN ROUTING
	Route::get('pokja/upload-nilai', 'UploadNilaiController@pokja')->name('upload-nilai.pokja');
	Route::get('pokja/{id}/standar/upload-nilai', 'UploadNilaiController@standar')->name('upload-nilai.standar');
	Route::get('pokja/standar/{id}/upload-nilai', 'UploadNilaiController@index')->name('upload-nilai.index');

	// DOKUMEN ROUTING
	Route::get('dokumen/{id}/list', 'DokumenController@index')->name('dokumen.index');
	Route::get('dokumen/{id}/create', 'DokumenController@create')->name('dokumen.create');
	Route::post('dokumen/{id}/store', 'DokumenController@store')->name('dokumen.store');
	Route::get('dokumen/{id}/edit', 'DokumenController@edit')->name('dokumen.edit');
	Route::patch('dokumen/{id}/update', 'DokumenController@update')->name('dokumen.update');
	Route::delete('dokumen/{id}/delete', 'DokumenController@destroy')->name('dokumen.destroy');
	Route::get('dokumen/{id}/view', 'DokumenController@show')->name('dokumen.show');

	// LAPORAN ROUTING
	Route::get('laporan/capaian', 'LaporanController@capaian')->name('laporan.capaian');
	Route::get('laporan/dokumen', 'LaporanController@dokumen')->name('laporan.dokumen');
});

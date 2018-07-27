<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standar extends Model
{
    protected $table = 'standar';
    protected $fillable = [
    	'nama',
    	'deskripsi',
    	'pokja_id'
    ];

    public function pokja()
    {
    	return $this->belongsTo('App\Pokja');
    }

    public function elemen()
    {
        return $this->hasMany('App\Elemen');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokja extends Model
{
    protected $table = 'pokja';
    protected $fillable = [
    	'nama'
    ];

    public function standar()
    {
    	return $this->hasMany('App\Standar');
    }

    public function getKepanjanganAttribute()
    {
    	return explode('(', $this->nama)[0];
    }

    public function getSingkatanAttribute()
    {
    	return str_replace(')', '', explode('(', $this->nama)[1]);
    }
}

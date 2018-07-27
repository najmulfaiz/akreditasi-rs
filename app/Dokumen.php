<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $fillable = [
    	'deskripsi',
    	'filename',
    	'elemen_id'
    ];

    public function elemen()
    {
    	return $this->belongsTo('App\Elemen');
    }
}

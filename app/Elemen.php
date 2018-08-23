<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemen extends Model
{
    protected $table = 'elemen';
    protected $fillable = [
    	'nama',
    	'deskripsi',
    	'nilai',
    	'standar_id',
        'note'
    ];

    public function standar()
    {
    	return $this->belongsTo('App\Standar');
    }

    public function dokumen()
    {
        return $this->hasMany('App\Dokumen');
    }

    public function getSkorAttribute()
    {
        return $this->sum('nilai');
    }

    public function getMaksimalAttribute()
    {
        return $this->count() * 10;
    }

    public function getJmlDokumenAttribute()
    {
        // return $this->dokumen()->count();
    }
}
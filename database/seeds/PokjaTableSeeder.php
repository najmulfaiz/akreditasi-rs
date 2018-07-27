<?php

use Illuminate\Database\Seeder;
use App\Pokja;

class PokjaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pokjas = [
        	'SASARAN KESELAMATAN PASIEN (SKP)',
        	'HAK PASIEN DAN KELUARGA (HPK)',
        	'PENDIDIKAN PASIEN DAN KELUARGA (PPK)',
        	'PENINGKATAN MUTU & KESELAMATAN PASIEN (PMKP)',
        	'MILLENIUM DEVELOPMENT GOAL\'S (MDGs)',
        	'AKSES KE PELAYANAN & KONTINUITAS PELAYANAN (APK)',
        	'ASESMEN PASIEN (AP)',
        	'PELAYANAN PASIEN (PP)',
        	'PELAYANAN BEDAH DAN ANASTESI (PAB)',
        	'MANAJEMEN PENGGUNAAN OBAT (MPO)',
        	'MANAJEMEN KOMUNIKASI DAN INFORMASI (MKI)',
        	'KUALIFIKASI DAN PENDIDIKAN STAF (KPS)',
        	'PENCEGAHAN DAN PENGENDALIAN INFEKSI (PPI)',
        	'TATA KELOLA, KEPEMIMPINAN DAN PENGARAHAN (TKP)',
        	'MANAJEMEN FASILITAS DAN KESELAMATAN (MFK)'
        ];

        foreach ($pokjas as $pokja) {
        	Pokja::create([
        		'nama' => $pokja
        	]);
        }
    }
}

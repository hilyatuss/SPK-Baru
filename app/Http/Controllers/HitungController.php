<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\WP;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HitungController extends Controller
{
    function index()
    {
        // $alternatif  = Alternatif::with(['nilais'])->get();
        // $rel_alternatif = array();
        // foreach ($alternatif as $row) {
        //     foreach ($row->nilais as $nilai) {
        //         $rel_alternatif[$row->nim][$nilai->kode_kriteria] = $nilai->pivot->nilai;
        //         $data['alternatifs'][$row->nim] = $row;
        //     }
        // }

        // $kriteria = Kriteria::all();
        // $atribut = array();
        // $bobot = array();
        // foreach ($kriteria as $row) {
        //     $atribut[$row->kode_kriteria] = $row->atribut;
        //     $bobot[$row->kode_kriteria] = $row->bobot;
        //     $data['kriterias'][$row->kode_kriteria] = $row;
        // }
        // $wp = new WP($rel_alternatif, $atribut, $bobot);
        // foreach ($wp->vektor_v as $key => $val) {
        //     $alternatif = Alternatif::find($key);
        //     $alternatif->total = $val;
        //     $alternatif->rank = $wp->rank[$key];
        //     $alternatif->save();
        // }
        // $data['wp'] = $wp;
        // $data['title'] = 'Hasil Perhitungan';

        // return view('hitung.index', $data);

        $alternatif  = Alternatif::join('tb_rel_mahasiswa', 'tb_rel_mahasiswa.nim' ,'=', 'tb_mahasiswa.nim')
        ->join('tb_range', 'tb_range.id' ,'=', 'tb_rel_mahasiswa.range_id')->with('nilais')->get();
        
        $rel_alternatif = array();
        foreach ($alternatif as $row) {
            // foreach ($row->nilais as $nilai) {

            $rel_alternatif[$row->nim][$row->kode_kriteria] = $row->nilai;
            $data['alternatifs'][$row->nim] = $row;
            // }
        }

        // echo json_encode($alternatif);

        $kriteria = Kriteria::all();
        $atribut = array();
        $bobot = array();
        foreach ($kriteria as $row) {
            $atribut[$row->kode_kriteria] = $row->atribut;
            $bobot[$row->kode_kriteria] = $row->bobot;
            $data['kriterias'][$row->kode_kriteria] = $row;
        }
        $wp = new WP($rel_alternatif, $atribut, $bobot);
        foreach ($wp->vektor_v as $key => $val) {
            $alternatif = Alternatif::find($key);
            $alternatif->total = $val;
            $alternatif->rank = $wp->rank[$key];
            $alternatif->save();
        }
        $data['wp'] = $wp;
        $data['title'] = 'Hasil Perhitungan';

        return view('hitung.index', $data);
    }

    function cetak()
    {
        $data['title'] = 'Laporan Hasil Perhitungan';
        $data['rows'] = Alternatif::orderBy('rank')->get();
        $data['tgl'] = Carbon::now()->locale('id')->isoFormat('LL');
        return view('hitung.cetak', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class KriteriaController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Kriteria';
        $data['rows'] = Kriteria::orderBy('kode_kriteria')->get();
        $data['tgl'] = Carbon::now()->locale('id')->isoFormat('LL');
        return view('kriteria.cetak', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Kriteria';
        $data['limit'] = 10;
        $data['rows'] = Kriteria::where('nama_kriteria', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_kriteria')
            ->paginate($data['limit'])->withQueryString();
        return view('kriteria.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:tb_kriteria',
            'nama_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ], [
            'kode_kriteria.required' => 'Kode kriteria harus diisi',
            'kode_kriteria.unique' => 'Kode kriteria harus unik',
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
            'atribut.required' => 'Atribut harus diisi',
            'bobot.required' => 'Bobot harus diisi',
        ]);

        Kriteria::insert(
            array('kode_kriteria' => $request->kode_kriteria, 
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'bobot' =>  $request->bobot
        ));

        $count = count($request->range);
        foreach($request->range as $key => $row){
            if (--$count <= 0) {
                break;
            }
        
            DB::table('tb_range')->insert(array(
                'kode_kriteria' => $request->kode_kriteria,
                'range' => $row,
                'nilai' => $request->nilai[$key]
            ));
        }

        // $range = DB::table('tb_range')->where('kode_kriteria', '=', $request->kode_kriteria)->first();

        // query("INSERT INTO tb_rel_mahasiswa (nim, range_id) SELECT nim, ? FROM tb_mahasiswa", [$range->id]);

        return redirect('kriteria')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(string $kriteria)
    {
        $data['row'] = Kriteria::findOrFail($kriteria);
        $data['title'] = 'Ubah Kriteria';
        return view('kriteria.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $kriteria)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'range' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ], [
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
            'range.required' => 'Range harus diisi',
            'atribut.required' => 'Atribut harus diisi',
            'bobot.required' => 'Bobot harus diisi',
        ]);

        Kriteria::where('kode_kriteria', '=', $request->kode_kriteria)->update(
            array( 
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'bobot' =>  $request->bobot
        ));

        DB::table('tb_range')->where('kode_kriteria', '=', $request->kode_kriteria)->delete();

        foreach($request->range as $key => $row){
            DB::table('tb_range')->insert(array(
                'kode_kriteria' => $request->kode_kriteria,
                'range' => $row,
                'nilai' => $request->nilai[$key]
            ));
            
        }

        return redirect('kriteria')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $kriteria)
    {
        $kriteria = Kriteria::findOrFail($kriteria);
        $range = DB::table('tb_range')->where('kode_kriteria', $kriteria->kode_kriteria);
        DB::table('tb_rel_mahasiswa')->where(['range_id'=>$range->first()->id])->delete();
        $range->delete();
        Kriteria::where('kode_kriteria', $kriteria->kode_kriteria)->delete();
        // $kriteria->delete();
        return redirect('kriteria')->with('message', 'Data berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Mahasiswa;
use App\Models\Rel_Alternatif;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;
use Carbon\Carbon;
use Auth;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $data['kode_kriteria'] = $request->input('kode_kriteria');
        $data['title'] = 'Daftar Beasiswa Bidikmisi';
        $data['kriterias'] = Kriteria::all();
        return view ('mahasiswa.index',$data);

    }

    public function create()
    {
        $data['title'] = 'Daftar Beasiswa Bidikmisi';
        // $data['kriterias'] = Kriteria::join('tb_range', 'tb_range.kode_kriteria', '=', 'tb_kriteria.kode_kriteria')->get();
        $data['kriterias'] = Kriteria::all();
        $data['periode'] = DB::table('tb_periode')->latest('selesai')->first();
        $data['user'] = Auth::user();
        $data['cekData'] = DB::table('tb_mahasiswa')->where(['nim' => Auth::user()->nim])->first();

        // echo json_encode($data['kriterias']);
        return view('mahasiswa.create', $data);
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'nim' => 'required|min:9|unique:tb_mahasiswa',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'semester' => 'required'
        ], [
            'nim.required' => 'NIM harus diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'nim.min' => 'NIM salah',
            'nama_alternatif.required' => 'Nama Lengkap harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'prodi.required' => 'Prodi harus diisi',
            'semester.required' => 'Semester harus diisi'
        ]);

        $periode = DB::table('tb_periode')->latest('selesai')->first();

        DB::table('tb_mahasiswa')->insert(
            array(
            'nim' =>  $request->nim,
            'periode_id' => $periode->id,
            'nama_mahasiswa' => $request->nama_alternatif,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi' =>  $request->prodi,            
            'semester' => $request->semester));

        $kriteria = Kriteria::all();
        // $kriteria->nilai = "0";
        // $request->validate([
        //     'file' => 'required',
        //     'file.*' => 'mimes:PDF,pdf|max:20000'
        // ]);

        DB::table('tb_user')->where(['id' => Auth::user()->id])->update(['nim' => $request->nim]);
        
        foreach($kriteria as $no => $col){
            $namaFile = Carbon::now()->timestamp;


            if ($request->hasfile('file')) { 
                $filename = $request->file('file');
                if ($filename[$col->kode_kriteria]->isValid()) {
                    $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                    $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                    DB::table('tb_rel_mahasiswa')->insert(
                        array( 
                        'nim' => $request->nim,
                        'range_id' => $request->nilai[$col->kode_kriteria],
                        'file' => $file
                    ));
                }
            }else{
                DB::table('tb_rel_mahasiswa')->insert(
                    array( 
                    'nim' => $request->nim,
                    'range_id' => $request->nilai[$col->kode_kriteria]
                ));
            }
        }
        return redirect('mahasiswa')->with('message', 'Pendaftaran Berhasil!');
    }

}

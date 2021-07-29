<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'tb_mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;

    protected $fillable = ['nim', 'jenis_kelamin', 'prodi', 'semester', 'atribut', 'bobot'];

    public function nilais()
    {
        return $this->belongsToMany(Kriteria::class, 'tb_rel_mahasiswa', 'nim', 'range_id')->withPivot('id', 'file');
    }
}

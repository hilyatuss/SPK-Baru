<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'tb_mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;

    protected $fillable = ['nim', 'nama_mahasiswa', 'jenis_kelamin', 'prodi', 'nim', 'semester', 'nilai'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rel_Alternatif extends Model
{
    protected $table = 'tb_rel_mahasiswa';
    protected $primaryKey = 'id';

    protected $fillable = ['nim', 'range_id', 'nilai', 'file'];
}

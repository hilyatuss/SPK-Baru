@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link nav-kriteria active" aria-current="page" >Kriteria</a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-alternatif" aria-current="page" >Nilai Alternatif</a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-normalisasi" aria-current="page" >Normalisasi</a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-rangking" aria-current="page" >Perangkingan</a>
  </li>
</ul>

<div class="card card-primary card-outline kriteria"> 
    <div class="card-header">
        <h3 class="card-title">Kriteria</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                <th>Atribut</th>
                <th>Bobot</th>
                <th>Normal</th>
                <th>Pangkat</th>
            </thead>
            @foreach($kriterias as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $val->nama_kriteria }}</td>
                <td>{{ $val->atribut }}</td>
                <td>{{ $val->bobot }}</td>
                <td>{{ round($wp->bobot_normal[$key], 4) }}</td>
                <td>{{ round($wp->pangkat[$key], 4) }}</td>
            </tr>
            @endforeach
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ round(array_sum($wp->bobot), 4) }}</td>
                    <td>{{ round(array_sum($wp->bobot_normal), 4) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="card card-primary card-outline alternatif">
    <div class="card-header">
        <h3 class="card-title">Nilai Alternatif</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $val->nama_kriteria }}</th>
                @endforeach
            </thead>
            @foreach($wp->rel_alternatif as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_mahasiswa }}</td>
                @foreach($val as $k => $v)
                <td>{{ round($v, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card card-primary card-outline normalisasi">
    <div class="card-header">
        <h3 class="card-title">Normalisasi</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $key }}</th>
                @endforeach
            </thead>
            @foreach($wp->normal as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                @foreach($val as $k => $v)
                <td>{{ round($v, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card card-primary card-outline rangking">
    <div class="card-header">
        <h3 class="card-title">Perangkingan</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Rank</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Vektor S</th>
                <th>Vektor V</th>
            </thead>
            @foreach($wp->rank as $key => $val)
            <tr>
                <td>{{ $val }}</td>
                <td>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_mahasiswa }}</td>
                <td>{{ round($wp->vektor_s[$key], 4) }}</td>
                <td>{{ round($wp->vektor_v[$key], 4) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="card-footer">
        <a class="btn btn-info" href="{{ route('cetakHitungPerPeriode', request()->segment(count(request()->segments())) ) }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.kriteria').show();
        $('.alternatif').hide();
        $('.normalisasi').hide();
        $('.rangking').hide();

        $('.nav-kriteria').click(function(){
            $('.nav-kriteria').attr('class', 'nav-link nav-kriteria active');
            $('.nav-alternatif').attr('class', 'nav-link nav-alternatif');
            $('.nav-normalisasi').attr('class', 'nav-link nav-normalisasi');
            $('.nav-rangking').attr('class', 'nav-link nav-rangking');

            $('.kriteria').show();
            $('.alternatif').hide();
            $('.normalisasi').hide();
            $('.rangking').hide();
        });
        $('.nav-alternatif').click(function(){
            $('.nav-kriteria').attr('class', 'nav-link nav-kriteria');
            $('.nav-alternatif').attr('class', 'nav-link nav-alternatif active');
            $('.nav-normalisasi').attr('class', 'nav-link nav-normalisasi');
            $('.nav-rangking').attr('class', 'nav-link nav-rangking');

            $('.alternatif').show();
            $('.kriteria').hide();
            $('.normalisasi').hide();
            $('.rangking').hide();
        });
        $('.nav-normalisasi').click(function(){
            $('.nav-kriteria').attr('class', 'nav-link nav-kriteria');
            $('.nav-alternatif').attr('class', 'nav-link nav-alternatif');
            $('.nav-normalisasi').attr('class', 'nav-link nav-normalisasi active');
            $('.nav-rangking').attr('class', 'nav-link nav-rangking');

            $('.normalisasi').show();
            $('.kriteria').hide();
            $('.alternatif').hide();
            $('.rangking').hide();
        });
        $('.nav-rangking').click(function(){
            $('.nav-kriteria').attr('class', 'nav-link nav-kriteria');
            $('.nav-alternatif').attr('class', 'nav-link nav-alternatif');
            $('.nav-normalisasi').attr('class', 'nav-link nav-normalisasi');
            $('.nav-rangking').attr('class', 'nav-link nav-rangking active');

            $('.rangking').show();
            $('.kriteria').hide();
            $('.alternatif').hide();
            $('.normalisasi').hide();
        });
    });
</script>
@endsection
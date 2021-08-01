@extends('layout.app')
@section('content')
    <div class="alert alert-info">
        <h5><center>Selamat Datang Di Sistem Pendukung Keputusan Penerimaan Beasiswa Bidikmisi Politeknik Negeri Madiun</center></h5>
    </div>

    <div {{ is_hidden('pegawai.information') }}>
        <div class="row">
            @foreach($periode as $row)
            <?php
                $jumlahPendaftar = DB::table('tb_mahasiswa')->where(['periode_id' => $row->id])->count();
                $date_now = date("Y-m-d"); 
            ?>
            @if($date_now <= $row->selesai && $date_now >= $row->mulai)
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3><strong>{{ $jumlahPendaftar }}</strong></h3>
                        <h5>{{ $row->nama_periode }}</h5>
                        <p>{{ $row->mulai }} - {{ $row->selesai }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="dropdown small-box-footer">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
                            Info Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" tabindex="-1" href="{{ route('dataPerPeriode', $row->id) }}">Data Mahasiswa</a>
                            <a class="dropdown-item" tabindex="-1" href="{{ route('hitungPerPeriode', $row->id) }}">Hasil Perhitungan</a>
                        </div>
                    </div>
                    </div>
                </div>
            @else
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3><strong>{{ $jumlahPendaftar }}</strong></h3>
                        <h5>{{ $row->nama_periode }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="dropdown small-box-footer">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
                            Info Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" tabindex="-1" href="{{ route('dataPerPeriode', $row->id) }}">Data Mahasiswa</a>
                            <a class="dropdown-item" tabindex="-1" href="{{ route('hitungPerPeriode', $row->id) }}">Hasil Perhitungan</a>
                        </div>
                    </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
        <!-- <div class="col-md-5 col-sm-6 col-12">
        <div class="info-box bg-gradient">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="form-group col-md-8">
            <label>Tampilkan data :</label>
            <select class="form-control">
                <option value selected="selected">-- Pilih Periode --</option>
               
            </select>
            </div>
            <div class="form-group mr-1">
                <label style="color:white">Tampilkan dat</label>
                <button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
            </div>
        </div>
        </div> -->
    </div>
        

    <div class="col-md-7" {{ is_hidden('mahasiswa.information') }}>
        <div class="callout callout-warning">
            <h5><strong>Beasiswa Bidikmisi</strong></h5>

            <p>Bidikmisi yaitu bantuan biaya pendidikan bagi calon mahasiswa tidak mampu secara ekonomi dan memiliki potensi 
                akademik baik untuk menempuh pendidikan di perguruan tinggi pada program studi unggulan sampai lulus tepat waktu.</p>
        </div>
        <div class="callout callout-info">
            <h5><strong>Berkas Yang Perlu Disiapkan</strong></h5>

            <p>
                Sebelum anda mendaftarkan diri pada Sistem Pendukung Keputusan Penerimaan Beasiswa Bidikmisi, silahkan siapkan berkas-berkas di bawah ini:</br>
                1. Scan Struk Gaji Orangtua</br>
                2. Surat Keterangan Tidak Mampu</br>
                3. Struk Tagihan Air 3 bulan terakhir</br>
                4. Struk Tagihan Listrik 3 bulan terakhir</br>
                5. Surat PBB</br>
                6. Scan Kartu Keluarga</br>
                7. Scan Ijazah terakhir</br>
                8. Scan Raport Terakhir</br>
                9. Piagam Prestasi (opsional)</br>
                10. Foto Rumah tampak depan, ruang tamu, dan kamar mandi (dijadikan satu file format .pdf)
            </p>
        </div>
    </div>

    <!-- Main content -->
@endsection
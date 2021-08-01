@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-header">
		<form class="form-inline">
			<div class="form-group mr-1">
				<input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Pencarian..." />
			</div>
			<div class="form-group mr-1">
				<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
			</div>
			<div class="form-group mr-1" {{ is_hidden('nilai_mahasiswa.cetak') }}>
				<a class="btn btn-default" href="{{ route('nilai_mahasiswa.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
			<th width = "3px">No</th>
				<th width = "7px">NIM</th>
				<th>Nama Mahasiswa</th>
				@foreach($kriterias as $kriteria)
				<th width = "100px"><center>{{ $kriteria->nama_kriteria }}</center></th>
				<!-- <th>File</th> -->
				@endforeach
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td>{{ $row->nim }}</td>
				<td>{{ $row->nama_mahasiswa }}</td>
				<?php 
					$rel = DB::table('tb_rel_mahasiswa')->where(['nim' => $row->nim])->join('tb_range', 'tb_range.id' ,'=', 'tb_rel_mahasiswa.range_id')->get();
					foreach($rel as $col){
				?>
				<td>
					<center>
						{{ $col->nilai }}<br>
						<a href="{{ url('document').'/'.$col->file }}"  target="_blank"><i class="far fa-file nav-icon"></i></a>
					</center>
				</td>
				<?php } ?>
			</tr>
			@endforeach
		</table>
	</div>
	@if ($rows->hasPages())
	<div class="card-footer">
		{{ $rows->links() }}
	</div>
	@endif
</div>


@endsection
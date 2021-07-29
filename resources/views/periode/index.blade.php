@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}

<div class="card card-primary card-outline">
	<div class="card-header">
		<form class="form-inline">
			<div class="form-group mr-1">
				<!-- <a class="btn btn-primary" href="{{ route('kriteria.create') }}"><i class="fa fa-plus"></i> Tambah</a> -->
				<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th width = "3px">No</th>
				<th>Periode Mulai</th>
				<th>Periode Selesai</th>
				<th><center>Status</center></th>
				<th><center>Aksi</center></th>
			</thead>
        <tbody>
            @foreach($rows as $no => $row)
            <tr>
                <td>{{ $no+1 }} </td>
                <td><?php $tgl = explode("-", $row->mulai); echo $tgl[2]."-".$tgl[1]."-".$tgl[0];?></td>
                <td><?php $tgl = explode("-", $row->selesai); echo $tgl[2]."-".$tgl[1]."-".$tgl[0];?></td>
                @if(date("Y-m-d") <= $row->selesai && date("Y-m-d") >= $row->mulai)
                    <td>Buka</td>
                @else
                    <td>Tutup</td>
                @endif
                <td>
                    <a class="btn btn-xs btn-info" href="{{ route('periode.edit', $row->id) }}" data-toggle="modal" data-target="#modal-edit-{{ $row->id }}"><i class="fa fa-edit"></i> Ubah</a>
                    <form action="{{ route('periode.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @foreach ($rows as $row)
            <div class="modal fade" id="modal-edit-{{ $row->id }}"  tabindex="-1">
              <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data Periode Beasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <!-- form start -->
                    <form action="{{ route('periode.update', $row->id) }}" method="post">
                      <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ show_error($errors) }}
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                        <label>Dimulai</label>
                                        <input type="date" class="form-control datetimepicker-input" name="mulai" value="{{ old('mulai', $row->mulai) }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Selesai</label>
                                        <input type="date" class="form-control datetimepicker-input" name="selesai" value="{{ old('selesai', $row->selesai) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a class="btn btn-danger" href="{{ route('periode.index') }}"><i class="fa fa-backward"></i> Kembali</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
			    @endforeach
        </tbody>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade show" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Periode Beasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<form action="{{ URL('periode') }}" method="POST">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							{{ show_error($errors) }}
							{{ csrf_field() }}
							<div class="form-group">
                      <label>Dimulai</label>
                      <input type="date" class="form-control datetimepicker-input" name="mulai" value="{{ old('mulai') }}" />
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Selesai</label>
                      <input type="date" class="form-control datetimepicker-input" name="selesai" value="{{ old('selesai') }}" />
                  </div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
					<a class="btn btn-danger" href="{{ route('periode.index') }}"><i class="fa fa-backward"></i> Kembali</a>
				</div>
			</div>		
		</form>
	  </div>
    </div>
  </div>
</div>

@endsection


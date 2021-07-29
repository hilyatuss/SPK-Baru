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
			<div class="form-group mr-1">
				<!-- <a class="btn btn-primary" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Tambah</a> -->
				<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>Username</th>
				<th>Level</th>
				<th>Status</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				@foreach($rows as $key => $row)
				<tr>
					<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
					<td>{{ $row->username }}</td>
					<td>{{ $row->level }}</td>
					<td>{{ $row->status_user ? 'Aktif' : 'NonAktif' }}</td>
					<td>
						<!-- <a class="btn btn-xs btn-info" href="{{ route('user.edit', $row) }}"><i class="fa fa-edit"></i> Ubah</a> -->
						<a class="btn btn-xs btn-info" href="{{ route('user.edit', $row->id) }}" data-toggle="modal" data-target="#modal-edit-{{ $row->id }}" ><i class="fa fa-edit"></i> Ubah</a>
						<form action="{{ route('user.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
						</form>
					</td>
				</tr>
				@endforeach

				<!-- Modal Edit -->
				@foreach ($rows as $row)
					<div class="modal fade" id="modal-edit-{{ $row->id }}"  tabindex="-1">
						<div class="modal-dialog modal-l" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Edit Data User</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form action="{{ route('user.update', $row) }}" method="post">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														{{show_error($errors)}}
														{{ csrf_field() }}
														{{ method_field('PUT') }}
														<div class="form-group">
															<label>Username <span class="text-danger">*</span></label>
															<input class="form-control" type="text" name="username" value="{{ old('username', $row->username) }}" />
														</div>
														<div class="form-group">
															<label>Password</label>
															<input class="form-control" type="password" name="password" value="{{ old('password') }}" />
															<p class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</p>
														</div>
														<div class="form-group">
															<label>Level <span class="text-danger">*</span></label>
															<select class="form-control" name="level" id="level" value="{{ old('level', $row->level) }}" required>
																<option value selected="selected">-- Pilih Jenis Kelamin --</option>
																<?= get_level_option(old('level', $row->level)) ?>
															</select>
														<div class="form-group">
															<label>Status <span class="text-danger">*</span></label>
															<select class="form-control" name="status_user" id="status_user" value="{{ old('status_user', $row->status_user) }}">
																<option value selected="selected">-- Pilih Status --</option>	
																<?= get_status_user_option(old('status_user', $row->status_user)) ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer">
												<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
												<a class="btn btn-danger" href="{{URL('user')}}"><i class="fa fa-backward"></i> Kembali</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</tbody>	
			
		</table>
	</div>
	@if ($rows->hasPages())
	<div class="card-footer">
		{{ $rows->links() }}
	</div>
	@endif
</div>

<!-- Modal -->
<div class="modal fade show" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="{{ URL('user') }}" method="POST">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						{{ show_error($errors) }}
						{{ csrf_field() }}
						<div class="form-group">
							<label>Username <span class="text-danger">*</span></label>
							<input class="form-control" autocomplete="off" type="text" name="username" value="{{ old('username') }}" required/>
						</div>
						<div class="form-group">
							<label>Password <span class="text-danger">*</span></label>
							<input class="form-control" type="password" name="password" value="{{ old('password') }}" required/>
						<div class="form-group">
							<label>Password Confirmation<span class="text-danger">*</span></label>
							<input class="form-control" type="password" name="password_confirmation" value="{{ old('password') }}" required/>
						</div>
						<div class="form-group">
							<label>Level <span class="text-danger">*</span></label>
							<select class="form-control @error('level') is-invalid @enderror" name="level" required>
								<option value selected="selected">-- Pilih Level --</option>
								<?= get_level_option(old('level')) ?>
							</select>
						</div>		
						<div class="form-group">
							<label>Status <span class="text-danger">*</span></label>
							<select class="form-control @error('status_user') is-invalid @enderror" name="status_user" required>
								<option value selected="selected">-- Pilih Status --</option>
								<?= get_status_user_option(old('status_user')) ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
				<a class="btn btn-danger" href="{{ route('user.index') }}"><i class="fa fa-backward"></i> Kembali</a>
			</div>
		</div>
	</form>
	  </div>
    </div>
  </div>
</div>

@endsection
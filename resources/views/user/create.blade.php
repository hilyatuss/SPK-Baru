@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('user') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>Nama user <span class="text-danger">*</span></label>
						<input class="form-control" autocomplete="off" type="text" name="nama_user" value="{{ old('nama_user') }}" />
					</div>
					<div class="form-group">
						<label>Username <span class="text-danger">*</span></label>
						<input class="form-control" autocomplete="off" type="text" name="username" value="{{ old('username') }}" />
					</div>
					<div class="form-group">
						<label>Password <span class="text-danger">*</span></label>
						<input class="form-control" type="password" name="password" value="{{ old('password') }}" />
					</div>
					<div class="form-group">
						<label>Password Confirmation<span class="text-danger">*</span></label>
						<input class="form-control" type="password" name="password_confirmation" value="{{ old('password') }}" />
					</div>					
					<div class="form-group">
						<label>Level <span class="text-danger">*</span></label>
						<select class="form-control" name="level">
							<?= get_level_option(old('level')) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Status <span class="text-danger">*</span></label>
						<select class="form-control" name="status_user">
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
@endsection
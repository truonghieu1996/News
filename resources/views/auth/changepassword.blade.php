@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
		<div class="col-12 col-md-auto">
			<div class="card">
				<div class="card-header">Đổi mật khẩu</div>
				<div class="card-body">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('success') }}
						</div>
					@endif
					@if(session('warning'))
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('warning') }}
						</div>
					@endif
					<form role="form" method="post" action="{{ url('/changepassword') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="old_password">Mật khẩu cũ <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" id="old_password" name="old_password" placeholder="" autocomplete="off" required />
							@if($errors->has('old_password'))
								<div class="invalid-feedback"><strong>{{ $errors->first('old_password') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="new_password">Mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" id="new_password" name="new_password" placeholder="" autocomplete="off" required />
							@if($errors->has('new_password'))
								<div class="invalid-feedback"><strong>{{ $errors->first('new_password') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="new_password_confirmation">Xác nhận mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control{{ $errors->has('new_password_confirmation') ? ' is-invalid' : '' }}" id="new_password_confirmation" name="new_password_confirmation" placeholder="" autocomplete="off" required />
							@if($errors->has('new_password_confirmation'))
								<div class="invalid-feedback"><strong>{{ $errors->first('new_password_confirmation') }}</strong></div>
							@endif
						</div>
						
						<button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	
@endsection
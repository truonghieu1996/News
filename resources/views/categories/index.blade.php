@extends('layouts.app')

@section('content')
	@section('content')
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">Danh sách chủ đề</div>
				<div class="card-body">
					<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</button></p>
					<table id="DataList" class="table table-bordered table-hover table-sm table-responsive">
						<thead>
							<tr>
								<th width="8%">#</th>
								<th width="76%">Tên chủ đề</th>
								<th width="8%">Sửa</th>
								<th width="8%">Xóa</th>
							</tr>
						</thead>
						<tbody>
							@php $count = 1; @endphp
							@foreach($categories as $value)
								<tr>
									<td>{{ $count++ }}</td>
									<td>{{ $value->name }}</td>
									<td class="text-center"><a data-toggle="modal" data-target="#myModalEdit" onclick="getUpdate({{ $value->id }}, '{{ $value->name }}'); return false;" class="btn btn-warning btn-sm" style="width:40px;">Sửa</a></td>
									<td class="text-center"><a data-toggle="modal" data-target="#myModalDelete" onclick="getDelete({{ $value->id }}); return false;" class="btn btn-danger btn-sm" style="width:40px;">Xóa</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

    <form action="{{ url('/categories/add') }}" method="post">
		{{ csrf_field() }}
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm chủ đề</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Tên chủ đề <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" placeholder="" required />
							@if($errors->has('name'))
								<div class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></div>
							@endif
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Thêm</button>
					</div>
				</div>
			</div>chude
		</div>
	</form>

    <form action="{{ url('/categories/delete') }}" method="get">
		{{ csrf_field() }}
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa chủ đề</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<p class="font-weight-bold text-danger">Xác nhận xóa? Hành động này không thể phục hồi.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
						<button type="submit" class="btn btn-danger">Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>

    <form action="{{ url('/categories/update') }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật chủ đề</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name_edit">Tên chủ đề <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('name_edit') ? ' is-invalid' : '' }}" id="name_edit" name="name_edit" value="{{ old('name_edit') }}" placeholder="" required />
							@if($errors->has('name_edit'))
								<div class="invalid-feedback"><strong>{{ $errors->first('name_edit') }}</strong></div>
							@endif
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('javascript')
	<script type="text/javascript">
		function getUpdate(id, name) {
			$('#ID_edit').val(id);
			$('#name_edit').val(name);
		}
		
		function getDelete(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('name'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('name_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection
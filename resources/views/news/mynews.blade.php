@extends('layouts.app') 
@section('content') 
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Danh sách bài viết của tôi</div>
			<div class="card-body">
				<p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-plus" aria-hidden="true"></i> Đăng bài</button>
				</p>
				<table id="DataList" class="table table-bordered table-hover table-sm table-responsive">
					<thead>
						<tr>
							<th width="4%">#</th>
							<th width="10%">Hình ảnh</th>
							<th width="10%">Chủ đề</th>
							<th width="17%">Tiêu đề</th>
							<th width="10%">Ngày tạo</th>
							<th width="10%">Ngày sửa</th>
							<th width="9%">Trạng thái</th>
							<th width="9%">Chi tiết</th>
							<th width="8%">Sửa</th>
							<th width="8%">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@php $count = 1; 
							function getFirstImage($strContent) {
								$first_img = "";
								ob_start();
								ob_end_clean();
								$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $strContent, $matches);
								$first_img = $matches[1][0];
								if (empty($first_img)) {
									$first_img = "images/noimage.png";
								}
								return $first_img;
							}
						@endphp 
						@foreach($mynews as $value)
						<tr>
							<td>{{ $count++ }}</td>
							<td>
								<?php 
									echo "<img class='d-flex mr-3 rounded img-thumbnail' src='". getFirstImage($value->content) ."' width='90' alt='' />";
								?>
							</td>
							<td class="text-center">{{ $value->name_category }}</td>
							<td>{{ $value->title }}<br/><span class='small text-muted'>Có {{ $value->amount_view }} lượt xem.</span></td>
							<td>{{ $value->created_at }}</td>
							<td>{{ $value->updated_at }}</td>
							<td class="text-center">
								@if($value->approved == 1)
									<span class="badge badge-success">Đã duyệt</span>
								@else
									<span class="badge badge-warning">Chưa duyệt</span>
								@endif
							</td>
							<td class="text-center">
									<a href="{{ url('/news/detail/' . $value->id) }}" class="btn btn-warning btn-sm" style="width:40px;">Xem</a>
								</td>
							<td class="text-center">
								<a data-toggle="modal" data-target="#myModalEdit" onclick="getUpdate({{ $value->id }}, '{{ $value->title }}', {{ $value->category_id }}, '{{ $value->summary }}'); return false;" class="btn btn-warning btn-sm" style="width:40px;">Sửa</a>
							</td>
							<td class="text-center">
								<a data-toggle="modal" data-target="#myModalDelete" onclick="getDelete({{ $value->id }}); return false;" class="btn btn-danger btn-sm" style="width:40px;">Xóa</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<form action="{{ url('/news/add') }}" method="post">
	{{ csrf_field() }}
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Đăng bài viết</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="title">Tiêu đề
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" value="{{ old('title') }}"
						    placeholder="" required /> @if($errors->has('title'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('title') }}</strong>
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="category_id">Chủ đề
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<select class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" id="category_id" name="category_id" required>
							<option value="">-- Chọn chủ đề --</option>
							@foreach($categories as $value)
							<option value="{{ $value->id }}">{{ $value->name_category }}</option>
							@endforeach
						</select>
						@if($errors->has('category_id'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('category_id') }}</strong>
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="summary">Tóm tắt
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<textarea class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" id="summary" name="summary" placeholder=""
						    required></textarea>
						@if($errors->has('summary'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('summary') }}</strong>
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="content">Nội dung bài viết
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<textarea class="ckeditor form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" name="content" placeholder=""
						    required></textarea>
						@if($errors->has('content'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('content') }}</strong>
						</div>
						@endif
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Đăng bài</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form action="{{ url('/news/delete') }}" method="get">
	{{ csrf_field() }}
	<input type="hidden" id="ID_delete" name="ID_delete" value="" />
	<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabelDelete">Xóa chủ đề</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
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

<form action="{{ url('/news/update') }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" id="ID_edit" name="ID_edit" value="" />
	<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabelEdit">Cập nhật bài viết</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="form-group">
						<label for="title_edit">Tiêu đề
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<input type="text" class="form-control{{ $errors->has('title_edit') ? ' is-invalid' : '' }}" id="title_edit" name="title_edit" value="{{ old('title_edit') }}"
						    placeholder="" required /> @if($errors->has('title_edit'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('title_edit') }}</strong>
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="category_id_edit">Chủ đề
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<select class="form-control{{ $errors->has('category_id_edit') ? ' is-invalid' : '' }}" id="category_id_edit" name="category_id_edit" required>
							<option value="">-- Chọn chủ đề --</option>
							@foreach($categories as $value)
							<option value="{{ $value->id }}">{{ $value->name_category }}</option>
							@endforeach
						</select>
						@if($errors->has('category_id_edit'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('category_id_edit') }}</strong>
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="summary_edit">Tóm tắt
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<textarea class="form-control{{ $errors->has('summary_edit') ? ' is-invalid' : '' }}" id="summary_edit" name="summary_edit" placeholder=""
						    required></textarea>
						@if($errors->has('summary_edit'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('summary_edit') }}</strong>
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="content_edit">Nội dung bài viết
							<span class="text-danger font-weight-bold">*</span>
						</label>
						<textarea class="ckeditor form-control{{ $errors->has('content_edit') ? ' is-invalid' : '' }}" id="content_edit" name="content_edit" placeholder=""
						    required></textarea>
						@if($errors->has('content_edit'))
						<div class="invalid-feedback">
							<strong>{{ $errors->first('content_edit') }}</strong>
						</div>
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
        function getUpdate(id, title, category, summary) {
            $('#ID_edit').val(id);
            $('#title_edit').val(title);
            $('#category_id_edit').val(category);
            $('#summary_edit').val(summary);
            //CKEDITOR.instances.content_edit.setData(data);
        }

        function getDelete(id) {
            $('#ID_delete').val(id);
        }
    </script>
	@if($errors->has('title'))
			$('#myModal').modal('show');
	@endif
	@if($errors->has('content'))
			$('#myModal').modal('show');
	@endif
	@if($errors->has('summary'))
			$('#myModal').modal('show');
	@endif
	@if($errors->has('title_edit'))
			$('#myModal').modal('show');
	@endif
	@if($errors->has('content_edit'))
			$('#myModal').modal('show');
	@endif
	@if($errors->has('summary_edit'))
			$('#myModal').modal('show');
	@endif
@endsection
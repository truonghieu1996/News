@extends('layouts.app') @section('content') @section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Danh sách bài viết</div>
			<div class="card-body">
				<table id="DataList" class="table table-bordered table-hover table-sm table-responsive">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th width="10%">Hình ảnh</th>
							<th width="15%">Chủ đề</th>
							<th width="47%">Tiêu đề</th>
							<th width="10%">Trạng thái</th>
							<th width="8%">Chi tiết</th>
							<th width="5%">Xóa</th>
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
						@foreach($news as $value)
							<tr>
								<td>{{ $count++ }}</td>
								<td>
									<?php 
									echo "<img class='d-flex mr-3 rounded img-thumbnail' src='". getFirstImage($value->content) ."' width='90' alt='' />";
								?>
								</td>
								<td class="text-center">{{ $value->name_category }}</td>
								<td>{{ $value->title }}<br /><span class='small text-muted'>Đăng bởi {{ $value->name }}, có {{ $value->amount_view }} lượt xem.</span></td>
								<td class="text-center">
									@if($value->approved == 1)
										<a href="{{ url('/news/' . $value->id . '/approved/0') }}"><span class="badge badge-success">Đã duyệt</span></a>
									@else
										<a href="{{ url('/news/' . $value->id . '/approved/1') }}"><span class="badge badge-warning">Chưa duyệt</span></a>
									@endif
								</td>
								<td class="text-center">
									<a href="{{ url('/news/detail/' . $value->id) }}" class="btn btn-warning btn-sm" style="width:40px;">Xem</a>
								</td>
								<td class="text-center">
									<a data-toggle="modal" data-target="#myModalDelete" onclick="getDelete({{ $value->id }}); return false;" class="btn btn-danger btn-sm"
										style="width:40px;">Xóa</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

{{--  <form action="{{ url('/news/delete') }}" method="get">
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
</form>  --}}
@endsection @section('javascript')
<script type="text/javascript">
	function getDelete(id) {
		$('#ID_delete').val(id);
	}
</script>
@endsection
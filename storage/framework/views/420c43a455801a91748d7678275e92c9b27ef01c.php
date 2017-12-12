 
<?php $__env->startSection('content'); ?>
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
							<?php  
							$count = 1;
								function getFirstImage($strContent) {
									$first_img = "";
									ob_start();
									ob_end_clean();
									$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $strContent, $matches);
									if (!empty($output))
										$first_img = $matches[1][0];
									else
										$first_img = "/images/noimage.png";
									return $first_img;
								}
							 ?> 
								<?php $__currentLoopData = $mynews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($count++); ?></td>
									<td>
										<?php 
											echo "<img class='d-flex mr-3 rounded img-thumbnail' src='". getFirstImage($value->content) ."' width='90' alt='' />";
										?>
									</td>
									<td class="text-center"><?php echo e($value->name_category); ?></td>
									<td><?php echo e($value->title); ?>

										<br/>
										<span class='small text-muted'>Có <?php echo e($value->amount_view); ?> lượt xem.</span>
									</td>
									<td><?php echo e($value->created_at); ?></td>
									<td><?php echo e($value->updated_at); ?></td>
									<td class="text-center">
										<?php if($value->approved == 1): ?>
										<span class="badge badge-success">Đã duyệt</span>
										<?php else: ?>
										<span class="badge badge-warning">Chưa duyệt</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<a href="<?php echo e(url('/news/detail/' . $value->id .'/'.$value->amount_view.'/'.$value->user_id)); ?>" class="btn btn-warning btn-sm"
											style="width:40px;">Xem</a>
									</td>
									<td class="text-center">
										<a href="<?php echo e(url('/news/update/' . $value->id)); ?>" class="btn btn-warning btn-sm"
											style="width:40px;">sửa</a>
									</td>
									<td class="text-center">
										<a data-toggle="modal" data-target="#myModalDelete" onclick="getDelete(<?php echo e($value->id); ?>); return false;" class="btn btn-danger btn-sm"
											style="width:40px;">Xóa</a>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<form action="<?php echo e(url('/news/add')); ?>" method="post">
		<?php echo e(csrf_field()); ?>

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
							<input type="text" class="form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" id="title" name="title" value="<?php echo e(old('title')); ?>"
								placeholder="" required /> <?php if($errors->has('title')): ?>
							<div class="invalid-feedback">
								<strong><?php echo e($errors->first('title')); ?></strong>
							</div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="category_id">Chủ đề
								<span class="text-danger font-weight-bold">*</span>
							</label>
							<select class="form-control<?php echo e($errors->has('category_id') ? ' is-invalid' : ''); ?>" id="category_id" name="category_id" required>
								<option value="">-- Chọn chủ đề --</option>
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($value->id); ?>"><?php echo e($value->name_category); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<?php if($errors->has('category_id')): ?>
							<div class="invalid-feedback">
								<strong><?php echo e($errors->first('category_id')); ?></strong>
							</div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="summary">Tóm tắt
								<span class="text-danger font-weight-bold">*</span>
							</label>
							<textarea class="form-control<?php echo e($errors->has('summary') ? ' is-invalid' : ''); ?>" id="summary" name="summary" placeholder=""
								required></textarea>
							<?php if($errors->has('summary')): ?>
							<div class="invalid-feedback">
								<strong><?php echo e($errors->first('summary')); ?></strong>
							</div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="content">Nội dung bài viết
								<span class="text-danger font-weight-bold">*</span>
							</label>
							<textarea class="ckeditor form-control<?php echo e($errors->has('content') ? ' is-invalid' : ''); ?>" id="content" name="content" placeholder=""
								required></textarea>
							<?php if($errors->has('content')): ?>
							<div class="invalid-feedback">
								<strong><?php echo e($errors->first('content')); ?></strong>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Đăng bài</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<form action="<?php echo e(url('/news/delete')); ?>" method="get">
		<?php echo e(csrf_field()); ?>

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

	<?php if($errors->has('title')): ?> $('#myModal').modal('show'); <?php endif; ?> <?php if($errors->has('content')): ?> $('#myModal').modal('show');
	<?php endif; ?> <?php if($errors->has('summary')): ?> $('#myModal').modal('show'); <?php endif; ?> <?php if($errors->has('title_edit')): ?> $('#myModal').modal('show');
	<?php endif; ?> <?php if($errors->has('content_edit')): ?> $('#myModal').modal('show'); <?php endif; ?> <?php if($errors->has('summary_edit')): ?> $('#myModal').modal('show');
	<?php endif; ?> 
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">
		function getDelete(id) {
			$('#ID_delete').val(id);
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
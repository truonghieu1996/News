<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">Thông tin cơ bản</div>
				<div class="card-body">
					<table class="table table-bordered table-hover table-sm table-responsive">
						<thead>
							<tr>
								<th width="40%">Họ và tên</th>
								<th width="40%">Email</th>
								<th width="15%">Quyền</th>
								<th width="5%">Sửa</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo e($user->name); ?></td>
								<td><?php echo e($user->email); ?></td>
								<td>
                                    <?php if($user->role == 1): ?>
                                        Quản trị viên
                                    <?php else: ?>
                                        Người dùng
                                    <?php endif; ?>
                                </td>
								<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getUpdate(<?php echo e($user->id); ?>, '<?php echo e($user->name); ?>'); return false;" class="btn btn-warning btn-sm" style="width:40px;">Sửa</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

    <form action="<?php echo e(url('/profile/update')); ?>" method="post">
		<?php echo e(csrf_field()); ?>

		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật họ và tên</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name_edit">Họ và tên<span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control<?php echo e($errors->has('name_edit') ? ' is-invalid' : ''); ?>" id="name_edit" name="name_edit" value="<?php echo e(old('name_edit')); ?>" placeholder="" required />
							<?php if($errors->has('name_edit')): ?>
								<div class="invalid-feedback"><strong><?php echo e($errors->first('name_edit')); ?></strong></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">
		function getUpdate(id, name) {
			$('#ID_edit').val(id);
			$('#name_edit').val(name);
		}
	</script>
	<?php if($errors->has('name')): ?>
		$('#myModal').modal('show');
	<?php endif; ?>
	
	<?php if($errors->has('name_edit')): ?>
		$('#myModalEdit').modal('show');
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
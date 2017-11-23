<?php $__env->startSection('content'); ?>
	<div class="row justify-content-center">
		<div class="col-12 col-md-auto">
			<div class="card">
				<div class="card-header">Đổi mật khẩu</div>
				<div class="card-body">
					<?php if(session('success')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php echo e(session('success')); ?>

						</div>
					<?php endif; ?>
					<?php if(session('warning')): ?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php echo e(session('warning')); ?>

						</div>
					<?php endif; ?>
					<form role="form" method="post" action="<?php echo e(url('/changepassword')); ?>">
						<?php echo e(csrf_field()); ?>

						<div class="form-group">
							<label for="old_password">Mật khẩu cũ <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control<?php echo e($errors->has('old_password') ? ' is-invalid' : ''); ?>" id="old_password" name="old_password" placeholder="" autocomplete="off" required />
							<?php if($errors->has('old_password')): ?>
								<div class="invalid-feedback"><strong><?php echo e($errors->first('old_password')); ?></strong></div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="new_password">Mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control<?php echo e($errors->has('new_password') ? ' is-invalid' : ''); ?>" id="new_password" name="new_password" placeholder="" autocomplete="off" required />
							<?php if($errors->has('new_password')): ?>
								<div class="invalid-feedback"><strong><?php echo e($errors->first('new_password')); ?></strong></div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="new_password_confirmation">Xác nhận mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control<?php echo e($errors->has('new_password_confirmation') ? ' is-invalid' : ''); ?>" id="new_password_confirmation" name="new_password_confirmation" placeholder="" autocomplete="off" required />
							<?php if($errors->has('new_password_confirmation')): ?>
								<div class="invalid-feedback"><strong><?php echo e($errors->first('new_password_confirmation')); ?></strong></div>
							<?php endif; ?>
						</div>
						
						<button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
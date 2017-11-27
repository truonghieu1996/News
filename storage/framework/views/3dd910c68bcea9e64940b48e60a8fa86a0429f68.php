<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header"><?php echo e($new->title); ?></div>
				<div class="card-body">
					<p><?php echo e($new->summary); ?></p>
					<p><?php echo $new->content; ?></p>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
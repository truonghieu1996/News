 <?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">Trang chủ</div>
			<div class="card-body">
				<?php  
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
				 ?> 
					<?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-12">
						<div class="single-news">
							<div class="row">
								<div class="col-md-2">
									<div class="view overlay hm-white-slight z-depth-1-half">
										<?php 
									echo "<img class='d-flex mr-3 rounded img-thumbnail' src='". getFirstImage($value->content) ."' width='150' alt='' />";
								?>
										<a>
											<div class="mask"></div>
										</a>
									</div>
								</div>
								<div class="col-md-10">
									<p>
										<strong>
											<a href="<?php echo e(url('/news/detail/' . $value->id)); ?>"><?php echo e($value->title); ?></a>
											<br/>
											<span class='small text-muted'>Đăng bởi <?php echo e($value->name); ?>, đăng vào lúc <?php echo e($value->created_at); ?>, có <?php echo e($value->amount_view); ?> lượt xem.</span>
										</strong>
									</p>
									<a><?php echo e($value->summary); ?>

										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
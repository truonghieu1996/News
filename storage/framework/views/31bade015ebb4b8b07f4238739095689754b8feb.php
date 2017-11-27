 <?php $__env->startSection('content'); ?> <?php $__env->startSection('content'); ?>
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
						<?php  $count = 1;
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
							<tr>
								<td><?php echo e($count++); ?></td>
								<td>
									<?php 
									echo "<img class='d-flex mr-3 rounded img-thumbnail' src='". getFirstImage($value->content) ."' width='90' alt='' />";
								?>
								</td>
								<td class="text-center"><?php echo e($value->name_category); ?></td>
								<td><?php echo e($value->title); ?><br /><span class='small text-muted'>Đăng bởi <?php echo e($value->name); ?>, có <?php echo e($value->amount_view); ?> lượt xem.</span></td>
								<td class="text-center">
									<?php if($value->approved == 1): ?>
										<a href="<?php echo e(url('/news/' . $value->id . '/approved/0')); ?>"><span class="badge badge-success">Đã duyệt</span></a>
									<?php else: ?>
										<a href="<?php echo e(url('/news/' . $value->id . '/approved/1')); ?>"><span class="badge badge-warning">Chưa duyệt</span></a>
									<?php endif; ?>
								</td>
								<td class="text-center">
									<a href="<?php echo e(url('/news/detail/' . $value->id)); ?>" class="btn btn-warning btn-sm" style="width:40px;">Xem</a>
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


<?php $__env->stopSection(); ?> <?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	function getDelete(id) {
		$('#ID_delete').val(id);
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php $__env->startSection('content'); ?> 
    <form action="<?php echo e(url('/news/update')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" id="ID_edit" name="ID_edit" value="<?php echo e($new->id); ?>" />
        <div class="form-group">
            <div class="form-group">
                <label for="title_edit">Tiêu đề
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control<?php echo e($errors->has('title_edit') ? ' is-invalid' : ''); ?>" id="title_edit" name="title_edit"
                    value="<?php echo e($new->title); ?>" placeholder="" required /> <?php if($errors->has('title_edit')): ?>
                <div class="invalid-feedback">
                    <strong><?php echo e($errors->first('title_edit')); ?></strong>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="category_id_edit">Chủ đề
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <select class="form-control<?php echo e($errors->has('category_id_edit') ? ' is-invalid' : ''); ?>" id="category_id_edit" name="category_id_edit"
                    required>
                    <option value="">-- Chọn chủ đề --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name_category); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('category_id_edit')): ?>
                <div class="invalid-feedback">
                    <strong><?php echo e($errors->first('category_id_edit')); ?></strong>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="summary_edit">Tóm tắt
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <textarea class="form-control<?php echo e($errors->has('summary_edit') ? ' is-invalid' : ''); ?>" id="summary_edit" name="summary_edit"
                    placeholder="" required><?php echo e($new->summary); ?></textarea>
                <?php if($errors->has('summary_edit')): ?>
                <div class="invalid-feedback">
                    <strong><?php echo e($errors->first('summary_edit')); ?></strong>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="content_edit">Nội dung bài viết
                    <span class="text-danger font-weight-bold">*</span>
                </label>
                <textarea class="ckeditor form-control<?php echo e($errors->has('content_edit') ? ' is-invalid' : ''); ?>" id="content_edit" name="content_edit"
                    placeholder="" required><?php echo e($new->content); ?></textarea>
                <?php if($errors->has('content_edit')): ?>
                <div class="invalid-feedback">
                    <strong><?php echo e($errors->first('content_edit')); ?></strong>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>

    <?php if($errors->has('title_edit')): ?> $('#myModal').modal('show');<?php endif; ?> 
    <?php if($errors->has('content_edit')): ?> $('#myModal').modal('show'); <?php endif; ?> 
    <?php if($errors->has('summary_edit')): ?> $('#myModal').modal('show'); <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        document.getElementById("category_id_edit").value = "<?php echo $new->category_id;?>";
    </script> 
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
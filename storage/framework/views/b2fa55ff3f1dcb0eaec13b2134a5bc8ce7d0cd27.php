 <?php $__env->startSection('content'); ?> <?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">Danh sách người dùng</div>
            <div class="card-body">
                <table id="DataList" class="table table-bordered table-hover table-sm table-responsive">
                    <thead>
                        <tr>
                            <th width="8%">#</th>
                            <th width="36%">Họ và tên</th>
                            <th width="30%">Email</th>
                            <th width="10%">Quyền</th>
                            <th width="8%">Sửa</th>
                            <th width="8%">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $count = 1;  ?> <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($count++); ?></td>
                            <td><?php echo e($value->name); ?></td>
                            <td><?php echo e($value->email); ?></td>
                            <td>
                                <?php if($value->role==1): ?> Quản trị viên <?php else: ?> Người dùng <?php endif; ?>
                            </td>
                            <?php if($value->id != Auth::user()->id): ?>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#myModalEdit" onclick="getUpdate(<?php echo e($value->id); ?>, '<?php echo e($value->role); ?>'); return false;"
                                        class="btn btn-warning btn-sm" style="width:40px;">Sửa</a>
                                </td>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#myModalDelete" onclick="getDelete(<?php echo e($value->id); ?>); return false;"
                                        class="btn btn-danger btn-sm" style="width:40px;">Xóa</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="<?php echo e(url('/users/delete')); ?>" method="get">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" id="ID_delete" name="ID_delete" value="" />
    <div class="modal fade" id="myModalDelete" tabindex="-1" name="dialog" aria-labelledby="myModalLabelDelete" aria-hidden="true">
        <div class="modal-dialog" name="document">
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

<form action="<?php echo e(url('/users/update')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" id="ID_edit" name="ID_edit" value="" />
    <div class="modal fade" id="myModalEdit" tabindex="-1" name="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">
        <div class="modal-dialog" name="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabelEdit">Cập nhật người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role_edit">Quyền</label>
                        <select class="custom-select form-control" id="role_edit" name="role_edit">
                            <option value="1">Quản trị viên</option>
                            <option value="0">Người dùng</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thực hiện</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?> <?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    function getUpdate(id, role) {
        $('#ID_edit').val(id);
        $('#role_edit').val(role);
    }

    function getDelete(id) {
        $('#ID_delete').val(id);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
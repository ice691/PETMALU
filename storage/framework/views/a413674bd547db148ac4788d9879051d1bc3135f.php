<?php $__env->startSection('title', 'Registered Users'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender &amp; Civil Status</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $resourceList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php echo e($row->name); ?> <br>
                            <small class="text-info">Member since <em><?php echo e(date_create($row->created_at)->format('M d, Y')); ?></em></small>
                        </td>
                        <td><?php echo e(ucfirst($row->gender)); ?> &mdash; <?php echo e(ucfirst($row->civil_status)); ?></td>
                        <td><?php echo e($row->email); ?></td>
                        <td><?php echo e($row->address ?: 'N/A'); ?></td>
                        <td><?php echo e($row->mobile_number ?: 'N/A'); ?></td>
                        <td><?php echo $row->login_status ? '<span class="badge badge-success">Enabled</span>' : '<span class="badge badge-danger">Disabled</span>'; ?></td>
                        <td>
                            <a href="<?php echo e(MyHelper::resource('edit', ['id' => $row->id])); ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="1" class="text-center text-info">No data to show</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
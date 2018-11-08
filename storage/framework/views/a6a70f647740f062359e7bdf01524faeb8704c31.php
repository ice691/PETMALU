<?php $__env->startSection('title', 'Impound Request List'); ?>

<?php $__env->startSection('content'); ?>
<?php if($error = session('deletionError')): ?>
<div class="alert alert-danger">
    <?php echo e($error); ?>

</div>
<?php endif; ?>
<?php echo $__env->make('partials.search-bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<table class="table mt-0 table-hover">
    <thead>
        <tr>
            <th>Pet Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Date Registered</th>
            <th>Owner</th>
            <th class="text-center">Notes</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $resourceList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($row->pet_name); ?></td>
            <td><?php echo e(ucfirst($row->species)); ?></td>
            <td><?php echo e($row->breed ?: '-'); ?></td>
            <td><?php echo e($row->created_at->format('m/d/Y h:i A')); ?></td>
            <td>
                <a href="javascript:void(0)" class="peeks-profile" data-profile="<?php echo e($row->owner->toJson()); ?>">
                    <?php echo e($row->owner->name); ?>

                </a>
            </td>
            <td class="text-uppercase text-center">
                <span class="badge badge-primary"><?php echo e($row->notes); ?></span>
            </td>
            <td><?php echo e(ucfirst($row->registration_status)); ?></td>
            <td>
                <a href="<?php echo e(route('admin.pet-registration.edit', $row->id)); ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
                <a class="trash-row btn btn-sm btn-danger" href="#">
                    <i class="fa fa-trash"></i> Trash
                    <?php echo Form::open(['url'=> MyHelper::resource('destroy', $row->id), 'method'=> 'DELETE','class'=> 'hidden']); ?>

                    <?php echo Form::close(); ?>

                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="8" class="text-center text-info">
                <?php echo e(request()->registration_status ? 'No data matched with filter' : 'No pets registered'); ?>

            </td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('partials.profile-peek', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body mb-0">
        <h4 class="card-title">Pet Adoption Requests</h4>
    </div>
    <div class="card-body p-0">
        <table class="table mt-0">
            <thead>
                <tr>
                    <th>Date Requested</th>
                    <th>Pet Name</th>
                    <th>Species</th>
                    <th>Breed</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $resourceList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($row->created_at->format('M d, Y h:i A')); ?></td>
                    <td><?php echo e($row->pet->pet_name); ?></td>
                    <td><?php echo e(ucfirst($row->pet->species)); ?></td>
                    <td><?php echo e(ucfirst($row->pet->breed)); ?></td>
                    <td><?php echo e($row->adoption_purpose); ?></td>
                    <td><?php echo e(ucfirst($row->request_status)); ?></td>
                    <td>
                        <?php echo Form::open(['url' => route('user.adoption-request.cancel'), 'method' => 'POST', 'onsubmit' => "javascript: return confirm('Are you sure?')"]); ?>

                            <?php echo Form::hidden('id', $row->id); ?>

                            <button  type="submit" class="btn btn-danger btn-sm mt-2">Cancel</button>
                        <?php echo Form::close(); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-info">No pet requests registered</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', ['hidePageHeader' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
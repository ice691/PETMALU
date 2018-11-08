<?php $__env->startSection('title', "Reports: Impounded Pets"); ?>


<?php $__env->startSection('content'); ?><div class="row align-items-center">
  <div class="col-sm-10">
    <form class="form-inline">
        <div class="form-group mr-sm-3 mb-2">
          <label for="" class="mr-1">Pet Name</label>
          <?php echo Form::plainInput('text', 'pet_name', request()->pet_name, ['class' => 'form-control']); ?>

        </div>
        <div class="form-group mr-sm-3 mb-2">
          <label for="" class="mr-1">Start Date</label>
          <?php echo Form::plainInput('date', 'start_date', request()->start_date, ['class' => 'form-control']); ?>

        </div>
        <div class="form-group mr-sm-1 mb-2">
          <label for="" class="mr-1">End Date</label>
          <?php echo Form::plainInput('date', 'end_date', request()->end_date, ['class' => 'form-control']); ?>

        </div>
        <button type="submit" class="btn btn-info mb-2"><i class="fa fa-search"></i></button>
      </form>
  </div>
  <div class="col-sm-2 text-right">
    <h4>Count: <span class="badge badge-info"><?php echo e($data->count()); ?></span></h4>
  </div>
</div>
<table class="table mt-0 table-hover">
    <thead>
        <tr>
            <th>Pet Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Date Registered</th>
            <th>Owner</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
            <td>
                <a href="<?php echo e(route('admin.pet-registration.edit', $row->id)); ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
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

<?php echo $__env->make('layouts.admin', ['hideNewEntryLink' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
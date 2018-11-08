<?php $__env->startSection('title', 'Adoption Requests'); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.search-bar', ['registrationStatus' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
    <?php $__currentLoopData = $resourceList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-sm-3">
        <div class="card">
        <div style="height: 150px;background-image: url('<?php echo e($item->photo_filepath); ?>');background-repeat: no-repeat;background-size: cover;background-position: center center">
        </div>
          <div class="card-body">
            <h5 class="card-title"><?php echo e($item->pet_name); ?></h5>
            <dl class="row">
              <dt class="col-sm-6">Species</dt>
              <dd class="col-sm-6 mb-0"><?php echo e(ucfirst($item->species)); ?></dd>
              <dt class="col-sm-6">Breed</dt>
              <dd class="col-sm-6 mb-0"><?php echo e($item->breed); ?></dd>
              <dt class="col-sm-6">Request Count</dt>
              <dd class="col-sm-6 mb-0"><?php echo e($item->adoption_requests_count); ?></dd>
            </dl>
            <a href="<?php echo e(route('admin.pet-adoption-requests.index', $item->id)); ?>" class="btn btn-info mt-0 btn-sm btn-block" >Manage Requests</a>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', ['hideNewEntryLink' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
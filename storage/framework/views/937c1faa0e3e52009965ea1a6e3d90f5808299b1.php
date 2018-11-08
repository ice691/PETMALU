<?php $__env->startSection('content'); ?>
<div class="container">

      <?php if(auth()->guard()->guest()): ?>
      
      <!-- Heading Row -->
      <div class="row my-4">
        <div class="col-lg-12">
          <img class="img-fluid rounded" src=<?php echo e(asset('image/LOGO2.jpg')); ?> alt="">
        </div>
      </div>
      <!-- /.row -->
      <?php else: ?>
            <!-- Call to Action Well -->
            <h4 class="pb-2 border-bottom mb-3">Pets for Adoption</h4>
            <?php echo $__env->make('partials.search-bar', ['registrationStatus' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="row mt-3">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-sm-3">
            <div class="card">
            <div style="height: 150px;background-image: url('<?php echo e($item->photo_filepath); ?>');background-repeat: no-repeat;background-size: cover;background-position: center center">
            </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo e($item->pet_name); ?></h5>
                <dl class="row">
                  <dt class="col-sm-5">Species</dt>
                  <dd class="col-sm-7"><?php echo e(ucfirst($item->species)); ?></dd>
                  <dt class="col-sm-5">Breed</dt>
                  <dd class="col-sm-7"><?php echo e($item->breed); ?></dd>
                </dl>
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('user.adoption-request.create', ['pet_id' => $item->id])); ?>" class="btn btn-success mt-0 btn-sm btn-block" >Adopt</a>
                <?php else: ?>
                <em><small><a data-toggle="modal" data-target="#registration-modal" href="#">Regisration</a> required  to adopt pet.</small></em>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
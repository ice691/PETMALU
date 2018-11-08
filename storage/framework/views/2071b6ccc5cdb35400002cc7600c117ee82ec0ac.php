<?php $__env->startSection('title', "Pet Adoption Requests"); ?>


<?php $__env->startSection('content'); ?>
<div class="form-row">
  <div class="col-sm-4">
    <div class="card">
        <img class="card-img-top" src="<?php echo e($pet->photo_filepath); ?>" alt="Card image cap">
        <table class="table  table-hover mb-0">
          <tbody>
              <tr>
                  <td><strong>Name</strong></td>
                  <td><?php echo e($pet->pet_name); ?></td>
              </tr>
              <tr>
                  <td><strong>Date Seized</strong></td>
                  <td><?php echo e($pet->date_seized ? date_create($pet->date_seized)->format('M d, Y') : '-'); ?></td>
              </tr>
              <tr>
                  <td><strong>Cage Number</strong></td>
                  <td><?php echo e($pet->cage_number); ?></td>
              </tr>
              <tr>
                  <td><strong>Species</strong></td>
                  <td><?php echo e(ucfirst($pet->species)); ?></td>
              </tr>
              <tr>
                  <td><strong>Breed</strong></td>
                  <td><?php echo e(ucfirst($pet->breed)); ?></td>
              </tr>
              <tr>
                  <td><strong>Sex</strong></td>
                  <td><?php echo e(ucfirst($pet->sex)); ?></td>
              </tr>
              <tr>
                  <td><strong>Ownership</strong></td>
                  <td><?php echo e(ucfirst($pet->ownership)); ?></td>
              </tr>
              <tr>
                  <td><strong>Habitat</strong></td>
                  <td><?php echo e(ucfirst(str_replace('_', ' ', $pet->habitat))); ?></td>
              </tr>
              <tr>
                  <td><strong>Birthdate</strong></td>
                  <td><?php echo e($pet->birthdate ? date_create($pet->birthdate)->format('M d, Y') : 'n/a'); ?></td>
              </tr>
              <tr>
                  <td><strong>Area</strong></td>
                  <td><?php echo e($pet->origin); ?></td>
              </tr>
          </tbody>
      </table>
    </div>
  </div>
  <div class="col-sm-8">
    <?php if($pet->isAdopted()): ?>
      <div class="alert alert-success">
        This pet is already adopted.
      </div>
      <table class="table table-bordered table table-hover">
        <tbody>
          <tr>
            <td>Adopted by:</td>
            <td><a href="#"><?php echo e($pet->approvedAdoptionRequest->requestor->name); ?> </a></td>
          </tr>
          <tr>
            <td>Date:</td>
            <td><?php echo e(date_create($pet->approvedAdoptionRequest->adopted_at)->format('M d, Y h:i A')); ?></td>
          </tr>
          <tr>
            <td>Adoption Purpose:</td>
            <td><?php echo e($pet->approvedAdoptionRequest->adoption_purpose); ?></td>
          </tr>
          <tr>
            <td>Adoption Remarks:</td>
            <td><?php echo e($pet->approvedAdoptionRequest->adoption_remarks); ?></td>
          </tr>
        </tbody>
      </table>
    <?php endif; ?>
    <div class="card mb-2">
      <div class="card-header">
          List of Requests
        </div>
        <table class="table table-hover mb-0 table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Purpose</th>
              <th>Date</th>
              <th>Actions</th>
              <th>Logs</th>
            </tr>
          </thead>
          <tbody>

              <?php $__empty_1 = true; $__currentLoopData = $pet->adoptionRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr class="<?php echo e(optional($pet->approvedAdoptionRequest)->id === $item->id ? 'bg-success text-white' : ''); ?>">
              <td>
                <a href="javascript:void(0)" class="peeks-profile" data-profile="<?php echo e($item->requestor->toJson()); ?>"><?php echo e($item->requestor->name); ?></a>
              </td>
              <td><?php echo e($item->adoption_purpose); ?></td>
              <td><?php echo e(date_create($item->created_at)->format('M d, Y h:i A')); ?></td>
              <td>
                <?php if(!$pet->isAdopted()): ?>
                <?php echo Form::open(['url' => route('admin.adoption-request-notification', $item->id), 'method' => 'post', 'class' => 'ajax']); ?>

                <button type="submit" class="btn-warning btn"><i class="fa fa-envelope"></i></button>
                <?php echo Form::close(); ?>

                <?php endif; ?>
              </td>
              <td></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="text-center text-info">No requests for this pet</td></tr>
              <?php endif; ?>

          </tbody>
        </table>
    </div>
    <?php if(!$pet->isAdopted()): ?>
    <div class="card">
      <div class="card-header">
        Adoption Details
      </div>
      <div class="card-body">
        <?php echo Form::open(['url' => route('admin.pet-adoption-requests.approve', $pet->id), 'method' => 'post', 'files' => true, 'class' => 'ajax']); ?>

          <div class="row">
            <div class="col-5">
              <?php echo Form::selectGroup('Award adoption to', 'adoption_request_id', $adoptionRequestDropdownFormat->prepend('* SELECT *', '')); ?>

            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="form-group">
                  <label for="">Attach image</label>
                  <input type="file" name="photo" class="form-control pl-0" style="border:0">
                </div>
              </div>
            </div>
          </div>
          <?php echo Form::textareaGroup('Adoption Remarks', 'remarks', null, ['rows' => 3]); ?>

          <button type="submit" class="btn btn-submit btn-success">Save</button>

        <?php echo Form::close(); ?>

      </div>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partials.profile-peek', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', ['hideNewEntryLink' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
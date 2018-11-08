<?php $__env->startSection('title', "Adoption Details"); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-header text-center">
        Adopted Pet Profile
      </div>
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
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header text-center">
            Past Owner Profile
          </div>
            <table class="table  table-hover mb-0">
              <tbody>
                  <tr>
                      <td><strong>Name</strong></td>
                      <td><?php echo e($pet->owner->name); ?> (<?php echo e(ucfirst($pet->owner->gender)); ?>)</td>
                  </tr>
                  <tr>
                      <td><strong>Address</strong></td>
                      <td><?php echo e(ucfirst($pet->owner->address)); ?></td>
                  </tr>
                  <tr>
                      <td><strong>Civil Status</strong></td>
                      <td><?php echo e(ucfirst($pet->owner->civil_status)); ?></td>
                  </tr>
                  <tr>
                      <td><strong>Birthdate</strong></td>
                      <td><?php echo e(date_create($pet->owner->birthdate)->format('M d, Y')); ?></td>
                  </tr>
                  <tr>
                      <td><strong>Reason for impound</strong></td>
                      <td><?php echo e($pet->reason); ?></td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header text-center">
            New Owner Profile
          </div>
            <table class="table  table-hover mb-0">
              <tbody>
                  <tr>
                      <td><strong>Name</strong></td>
                      <td><?php echo e(data_get($pet, 'approvedAdoptionRequest.requestor.name')); ?> (<?php echo e(data_get($pet, 'approvedAdoptionRequest.requestor.gender')); ?>)</td>
                  </tr>
                  <tr>
                      <td><strong>Address</strong></td>
                      <td><?php echo e(data_get($pet, 'approvedAdoptionRequest.requestor.address')); ?></td>
                  </tr>
                  <tr>
                      <td><strong>Civil Status</strong></td>
                      <td><?php echo e(ucfirst(data_get($pet, 'approvedAdoptionRequest.requestor.civil_status'))); ?></td>
                  </tr>
                  <tr>
                      <td><strong>Birthdate</strong></td>
                      <td><?php echo e(date_create(data_get($pet, 'approvedAdoptionRequest.requestor.birthdate'))->format('M d, Y')); ?></td>
                  </tr>
                  <tr>
                      <td><strong>Purpose for adoption</strong></td>
                      <td><?php echo e(data_get($pet, 'approvedAdoptionRequest.adoption_purpose')); ?></td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card text-white mt-3">
      <img class="card-img" src="<?php echo e(data_get($pet, 'approvedAdoptionRequest.proof_of_adoption_filepath')); ?>" alt="Card image">
      <div class="card-img-overlay">
        <h5 class="card-title text-uppercase">Proof of adoption</h5>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', ['hideNewEntryLink' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
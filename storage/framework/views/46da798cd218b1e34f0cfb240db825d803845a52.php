<form class="form-inline">
    <?php if(isset($registrationStatus) && $registrationStatus): ?>
    <div class="form-group mr-sm-3 mb-2">
        <?php echo Form::plainSelect(
            'registration_status',
            ['' => '*ALL STATUS*', 'pending' => 'Pending Requests', 'rejected' => 'Rejected Requests'],
            request()->registration_status,
            ['class' => 'custom-select']); ?>

    </div>
    <?php endif; ?>
    <div class="form-group mr-sm-3 mb-2">
        <?php echo Form::plainSelect(
            'species',
            ['' => '*ALL SPECIES*', 'cat' => 'Cat', 'dog' => 'Dog', 'others' => 'Others'],
            request()->species,
            ['class' => 'custom-select']); ?>

    </div>
     <div class="form-group mr-sm-3 mb-2">
      <?php echo Form::plainInput('text', 'breed', request()->breed, ['class' => 'form-control', 'placeholder' => '** ALL BREEDS **']); ?>

    </div>
    <div class="form-group mr-sm-3 mb-2">
      <?php echo Form::plainInput('text', 'name', request()->name, ['class' => 'form-control', 'placeholder' => 'Name of pet']); ?>

    </div>
    <button type="submit" class="btn btn-info mb-2"><i class="fa fa-search"></i> Filter</button>
</form>

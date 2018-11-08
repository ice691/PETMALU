<?php $__env->startSection('title', 'Register Users'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <?php if(is_null($resourceData->id)): ?>
                    <?php echo Form::open(['url' => MyHelper::resource('store'), 'method' => 'POST']); ?>

                <?php else: ?>
                    <?php echo Form::model($resourceData, ['url' => MyHelper::resource('update', ['id' => $resourceData->id]), 'method' => 'PATCH', 'files' => true]); ?>

                <?php endif; ?>
                <?php echo Form::inputGroup('text', 'Full Name', 'name'); ?>

                    <?php echo Form::textAreaGroup('Address', 'address', null, ['rows' => '2']); ?>

                    <?php echo Form::inputGroup('number', 'Mobile Number', 'mobile_number', null, ['placeholder' => '09XXXXXXXXX']); ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo Form::inputGroup('email', 'Email Address', 'email'); ?>

                        </div>
                        <div class="col-sm-6">
                            <?php echo Form::inputGroup('date', 'Birthdate', 'birthdate'); ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo Form::selectGroup('Gender', 'gender', ['' => '*SELECT*', 'male' => 'Male', 'female' => 'Female']); ?>

                        </div>
                        <div class="col-sm-6">
                            <?php echo Form::selectGroup('Civil Status', 'civil_status', ['' => '*SELECT*', 'single' => 'Single', 'married' => 'Married', 'others' => 'Others']); ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo Form::passwordGroup('Password', 'password'); ?>

                        </div>
                        <div class="col-sm-6">
                            <?php echo Form::passwordGroup('Password, Again', 'password_confirmation'); ?>

                        </div>
                    </div>
                    <?php if($resourceData->id): ?>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php echo Form::selectGroup('Login Status', 'login_status', ['' => '*SELECT*', '0' => 'Disabled', '1' => 'Enabled']); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <hr>
                <button type="submit" class="btn btn-success">Submit</button>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
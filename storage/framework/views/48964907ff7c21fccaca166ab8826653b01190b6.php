<div class="modal fade" id="registration-modal" tabindex="-1" role="dialog" aria-labelledby="registration-modal-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registration-modal-label">Sign up</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo Form::open(['url' => url('/register'), 'method' => 'POST', 'class' => 'ajax', 'role' => 'form']); ?>

          <div class="modal-body">
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

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <?php echo Form::close(); ?>

        </div>

      </div>
    </div>

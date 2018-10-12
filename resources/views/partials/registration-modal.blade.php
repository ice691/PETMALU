<div class="modal fade" id="registration-modal" tabindex="-1" role="dialog" aria-labelledby="registration-modal-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registration-modal-label">Sign up</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {!! Form::open(['url' => url('/register'), 'method' => 'POST', 'class' => 'ajax', 'role' => 'form']) !!}
          <div class="modal-body">
            {!! Form::inputGroup('text', 'Full Name', 'name') !!}
            {!! Form::textAreaGroup('Address', 'address', null, ['rows' => '2']) !!}
            {!! Form::inputGroup('number', 'Mobile Number', 'mobile_number', null, ['placeholder' => '09XXXXXXXXX']) !!}
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::inputGroup('email', 'Email Address', 'email') !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::inputGroup('date', 'Birthdate', 'birthdate') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::selectGroup('Gender', 'gender', ['' => '*SELECT*', 'male' => 'Male', 'female' => 'Female']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::selectGroup('Civil Status', 'civil_status', ['' => '*SELECT*', 'single' => 'Single', 'married' => 'Married', 'others' => 'Others']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::passwordGroup('Password', 'password') !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::passwordGroup('Password, Again', 'password_confirmation') !!}
                </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>

      </div>
    </div>

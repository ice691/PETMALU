@extends('layouts.admin')

@section('title', 'Register Users')
@section('content')

<div class="row">
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                @if(is_null($resourceData->id))
                    {!! Form::open(['url' => MyHelper::resource('store'), 'method' => 'POST']) !!}
                @else
                    {!! Form::model($resourceData, ['url' => MyHelper::resource('update', ['id' => $resourceData->id]), 'method' => 'PATCH', 'files' => true]) !!}
                @endif
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
                    @if($resourceData->id)
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::selectGroup('Login Status', 'login_status', ['' => '*SELECT*', '0' => 'Disabled', '1' => 'Enabled']) !!}
                            </div>
                        </div>
                    @endif
                <hr>
                <button type="submit" class="btn btn-success">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

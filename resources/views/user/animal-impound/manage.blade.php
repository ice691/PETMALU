@extends('layouts.user')
@section('title', is_null($resourceData->id) ? 'New impound request' : 'Update impound request')

@section('content')

@if($errors->count())
    <div class="alert alert-danger">
        Please verify all fields to be correct
    </div>
@endif
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if(is_null($resourceData->id))
                    {!! Form::open(['url' => MyHelper::resource('store'), 'method' => 'POST', 'files' => true]) !!}
                @else
                    {!! Form::model($resourceData, ['url' => MyHelper::resource('update', ['id' => $resourceData->id]), 'method' => 'PATCH', 'files' => true]) !!}
                @endif
                <div class="row">
                    <div class="col-sm-3">
                        <img alt="" class="img-fluid rounded mx-auto d-block" src="{{ $resourceData->id ? $resourceData->photo_filepath : MyHelper::photoPlaceholder() }}">
                        <hr>
                        {!! Form::plainInput('file', 'photo') !!}
                        @if($errors->has('photo'))
                        <div class="text-danger mt-1">
                            <small>{{ $errors->first('photo') }}</small>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-9">
                        <div class="form-row">
                            <div class="col-sm-2">
                                {!! Form::selectGroup('Type', 'animal_type', ['' => '', 'feline' => 'Feline', 'canine' => 'Canine', 'others' => 'Others']) !!}
                            </div>
                            <div class="col-sm-2">
                                {!! Form::selectGroup('Sex', 'sex', ['' => '', 'male' => 'Male', 'female' => 'Female']) !!}
                            </div>
                            <div class="col-sm-8">
                                {!! Form::inputGroup('text', 'Name', 'name') !!}
                            </div>
                        </div>
                        {!! Form::textAreaGroup('Description and remarks', 'description', null, ['rows' => 3]) !!}
                        <div class="text-primary">
                            {!! Form::checkbox('vaccination_status', 1, 'The animal has been vaccinated?', null) !!}
                        </div>

                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Submit</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApzL1AXKwyfJT2tT5c5KkxFqnfv2txpQw&libraries=places&callback=initialize" async defer></script>
<script type="text/javascript">
    var autocomplete;
    function initialize() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('area'),
            { types: ['geocode', 'establishment'] }
        );
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            $('[name=area_latitude]').val(place.geometry.location.lat())
            $('[name=area_longitude]').val(place.geometry.location.lng())
        });
    }
</script>
@endpush

@extends('layouts.admin')
@section('title', is_null($resourceData->id) ? 'New Impound Request' : 'Update Impound Request List')

@section('content')

<div class="card">
    <div class="card-body">
        @if(is_null($resourceData->id))
            {!! Form::open(['url' => MyHelper::resource('store'), 'method' => 'POST', 'files' => true, 'class' => 'ajax', 'data-next-url' => MyHelper::resource('index')]) !!}
        @else
            {!! Form::model($resourceData, ['url' => MyHelper::resource('update', ['id' => $resourceData->id]), 'method' => 'PATCH', 'files' => true, 'class' => 'ajax', 'data-next-url' => MyHelper::resource('index')]) !!}
        @endif
        @if($resourceData->approvedAdoptionRequest)
            <div class="alert alert-warning">
                <i class="fa fa-info-circle"></i> Editing is disabled because this pet is already adopted.
            </div>
        @endif
        @if($resourceData->id)
            <div class="alert alert-info" role="alert">
              <h4 class="alert-heading">Reason for impound</h4>
              <p class="mb-0">{!! $resourceData->reason ?: '<em>No reason specified</em>' !!}</p>
            </div>
        @endif
        <div class="form-row">

            <div class="col-sm-5">
                {!! Form::inputGroup('text', 'Pet Name', 'pet_name') !!}
            </div>
            <div class="col-sm-7">
                <div class="form-row">
                    <div class="col-sm-6">
                        {!! Form::inputGroup('date', 'Date Seized', 'date_seized', null, ['max' => now()->format('Y-m-d')]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::inputGroup('text', 'Cage Number', 'cage_number') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-6">
                {!! Form::inputGroup('text', 'Location', 'origin') !!}
                {!! Form::hidden('origin_longitude') !!}
                {!! Form::hidden('origin_latitude') !!}
            </div>
            <div class="col-sm-3">
                {!! Form::selectGroup('Species', 'species', ['' => '*SELECT*', 'dog' => 'Dog', 'cat' => 'Cat', 'others' => 'Others']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::inputGroup('text', 'Breed', 'breed') !!}
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-3">
                {!! Form::selectGroup('Ownership', 'ownership', ['' => '*SELECT*', 'household' => 'Household', 'community' => 'Community']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::selectGroup('Habitat', 'habitat', ['' => '*SELECT*', 'caged' => 'Caged', 'leashed' => 'Leashed', 'roaming' => 'Roaming', 'house_only' => 'House Only']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::inputGroup('date', 'Birthdate', 'birthdate', null, ['max' => now()->format('Y-m-d')]) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::inputGroup('text', 'Color', 'color') !!}
            </div>
        </div>
        <hr>
        <div class="form-row">
            <div class="col-sm-2">
                {!! Form::selectGroup('Sex', 'sex', ['' => '*SELECT*', 'male' => 'Male', 'female' => 'Female']) !!}
            </div>
             <div class="col-sm-3">
                {!! Form::selectGroup('.. if female', 'female_sex_extra', ['' => '*SELECT*', 'intact' => 'Intact', 'spayed' => 'Spayed', 'pregnant' => 'Pregnant', 'lactating' => 'Lactating']) !!}
            </div>
            <div class="col-sm-2">
                {!! Form::inputGroup('number', '# of puppies', 'num_puppies') !!}
            </div>
        </div>
        <hr>
        <div class="form-row">
            <div class="col-sm-4">
                {!! Form::selectGroup('Contact with other animals', 'other_animal_contact', ['' => '*SELECT*', 'frequent' => 'Frequent', 'seldom' => 'Seldom', 'never' => 'Never']) !!}
            </div>
            <div class="col-sm-2">
                {!! Form::selectGroup('Tag', 'tag', ['' => '*SELECT*', 'collar' => 'Collar', 'microchip' => 'Microchip', 'tattoo_code' => 'Tattoo Code', 'others' => 'Others']) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::inputGroup('text', ".. if others", 'other_tag_extra') !!}
            </div>
        </div>
        <hr>
        <div class="form-row">
            <div class="col-sm-3">
                {!! Form::inputGroup('date', 'Date Vaccinated', 'date_vaccinated', null, ['max' => now()->format('Y-m-d')]) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::inputGroup('text', 'Vaccinated by', 'vaccinated_by') !!}
            </div>
            <div class="col-sm-2">
                {!! Form::selectGroup('Vaccination Source', 'vaccination_source', ['' => '*SELECT*'] +  array_combine(['BAI', 'DARFO', 'PLGU', 'MLGU', 'DOH', 'NGO', 'OIE'], ['BAI', 'DARFO', 'PLGU', 'MLGU', 'DOH', 'NGO', 'OIE'])) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::inputGroup('text', 'Vaccinate Stock #', 'vaccine_stock_number') !!}
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-3">
                {!! Form::selectGroup('Vaccination Type', 'vaccination_type', ['' => '*SELECT*', 'anti_rabies' => 'Anti Rabbies', 'others' => 'Others']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::inputGroup('text', 'Vaccination Remarks', 'vaccination_remarks') !!}
            </div>
        </div>
        <hr>
        <div class="form-row">
            <div class="col-sm-3">
                {!! Form::selectGroup('Routine Service Activity', 'routine_service_activity', ['' => '*SELECT*', 'castration' => 'castration', 'deworming' => 'Deworming', 'spaying' => 'Spaying', 'vitamin_injection' => 'Vitamin Injection', 'others' => 'Others']) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::inputGroup('text', '.. if others', 'other_routine_service_activity_extra') !!}
            </div>
            <div class="col-sm-5">
                {!! Form::inputGroup('text', 'Remarks', 'routine_service_remarks') !!}
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="d-block">Upload photo</label>
            <input type="file" name="photo" class="form-control border-0 p-0" />
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                {!! Form::selectGroup('Registration Status', 'registration_status', ['' => '*SELECT*', 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected']) !!}
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-success">Submit</button>
        {!! Form::close() !!}
    </div>
</div>

@endsection


@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApzL1AXKwyfJT2tT5c5KkxFqnfv2txpQw&libraries=places&callback=initialize" async defer></script>
<script type="text/javascript">
    var autocomplete;
    function initialize() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('origin'),
            { types: ['geocode', 'establishment'] }
        );
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            $('[name=origin_latitude]').val(place.geometry.location.lat())
            $('[name=origin_longitude]').val(place.geometry.location.lng())
        });
    }
</script>
<script>
    $(document).ready(function() {
        var isAdopted = {{ (bool)$resourceData->approvedAdoptionRequest }};
        if(isAdopted){
            $('select,input,textarea,[type=submit]')
                .attr('disabled', 'disabled')
                .css({
                    'border': 0
                })
        }
    });
</script>
@endpush

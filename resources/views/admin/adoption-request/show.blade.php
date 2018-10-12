@extends('layouts.admin')

@section('title', 'Pet Adoption Request')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="card mb-3">
            <img class="card-img-top" src="{{ $resourceData->pet->photo_filepath }}" alt="Card image cap">
            <table class="table table-hover mb-0 border-bottom">
                <tbody>
                    <tr>
                        <td>Given Name</td>
                        <td><strong>{{ $resourceData->pet->pet_name }}</strong></td>
                    </tr>
                    <tr>
                        <td>Species</td>
                        <td><strong>{{ ucfirst($resourceData->pet->species) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Breed</td>
                        <td><strong>{{ ucfirst($resourceData->pet->breed) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Owner</td>
                        <td><strong>{{ $resourceData->pet->owner->name }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if($resourceData->pet->origin_latitude && $resourceData->pet->origin_longitude)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Pet Origin Map
                    </h5>
                    <p class="card-text">
                        {{ $resourceData->pet->origin }}
                    </p>
                </div>
                <div class="card-body p-0 border-top" id="map" data-lat="{{ $resourceData->pet->origin_latitude }}" data-lng="{{ $resourceData->pet->origin_longitude }}" style="height: 200px;">

                </div>
            </div>
        @else
            <div class="alert alert-danger text-center"><i class="fa fa-info-circle"></i> No tagged origin for this pet</div>
        @endif
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-0">Requestor Information</h5>
            </div>
            <table class="table table-hover mb-0 border-bottom">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><strong>{{ $resourceData->requestor->name }}</strong></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><strong>{{ $resourceData->requestor->email }}</strong></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><strong>{{ $resourceData->requestor->address }}</strong></td>
                    </tr>
                    <tr>
                        <td>Adoption Purpose</td>
                        <td><strong>{{ $resourceData->adoption_purpose }}</strong></td>
                    </tr>
                    <tr>
                        <td>Actions</td>
                        <td>
                            {!! Form::open(['url' => MyHelper::resource('update', $resourceData->id), 'method' => 'patch', 'class' => 'ajax']) !!}
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group mb-0">
                                        {!! Form::select('request_status', ['pending'  => 'Pending', 'approved' => 'Approve', 'rejected' => 'Reject'], $resourceData->request_status, ['class' => 'form-select']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
  function initMap() {
    if($('#map').length){
        var myLatLng = {lat: $('#map').data('lat'), lng: $('#map').data('lng')};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
          center: myLatLng,
          draggable:false
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Pet Location'
        });
    }

  }
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.submit').click()
    });
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApzL1AXKwyfJT2tT5c5KkxFqnfv2txpQw&callback=initMap">
</script>
@endpush

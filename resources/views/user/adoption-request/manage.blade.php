@extends('layouts.user', ['hidePageHeader' => true])

@section('content')
<h4 class="mb-3">Pet Adoption Request</h4>
<div class="form-row">
    <div class="col-sm-4">
        <div class="card">
            <img class="card-img-top" src="{{ $pet->photo_filepath }}" alt="Card image cap">
            <table class="table table-hover mb-0 border-bottom">
                <tbody>
                  <tr>
                      <td><strong>Name</strong></td>
                      <td>{{ $pet->pet_name }}</td>
                  </tr>
                  <tr>
                      <td><strong>Date Seized</strong></td>
                      <td>{{ $pet->date_seized ? date_create($pet->date_seized)->format('M d, Y') : '-' }}</td>
                  </tr>
                  <tr>
                      <td><strong>Species</strong></td>
                      <td>{{ ucfirst($pet->species) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Breed</strong></td>
                      <td>{{ ucfirst($pet->breed) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Sex</strong></td>
                      <td>{{ ucfirst($pet->sex) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Ownership</strong></td>
                      <td>{{ ucfirst($pet->ownership) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Habitat</strong></td>
                      <td>{{ ucfirst(str_replace('_', ' ', $pet->habitat)) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Birthdate</strong></td>
                      <td>{{ $pet->birthdate ? date_create($pet->birthdate)->format('M d, Y') : 'n/a' }}</td>
                  </tr>
                  <tr>
                      <td><strong>Area</strong></td>
                      <td>{{ $pet->origin }}</td>
                  </tr>
              </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-8">
        @if($pet->origin_latitude && $pet->origin_longitude)
            <div class="card">
                <div class="card-body p-0" id="map" data-lat="{{ $pet->origin_latitude }}" data-lng="{{ $pet->origin_longitude }}" style="height: 500px;">

                </div>
            </div>
        @else
            <div class="alert alert-danger text-center mb-0"><i class="fa fa-info-circle"></i> No tagged origin for this pet</div>
        @endif
        <div class="card mt-2">
            <div class="card-body">
                @if($request = auth()->user()->adoptionRequest($pet))
                    <p class="card-text">
                        You have submitted an adoption request:
                    </p>
                    <p class="card-text">
                        <strong class="text-info d-block">{{ $request->adoption_purpose }}</strong>
                        <small class="text-muted">{{ $request->created_at->format('m/d/Y h:i A') }}</small>
                        {!! Form::open(['url' => route('user.adoption-request.cancel'), 'method' => 'POST', 'onsubmit' => "javascript: return confirm('Are you sure?')"]) !!}
                            {!! Form::hidden('id', $request->id)!!}
                            <button  type="submit" class="btn btn-danger btn-block mt-2">Cancel this request</button>
                        {!! Form::close() !!}
                    </p>
                @else
                    <h5 class="card-title">State your purpose for adoption</h5>
                    {!! Form::open(['url' => route('user.adoption-request.store'), 'method' => 'POST', 'class' => 'ajax']) !!}
                    {!! Form::textareaGroup(null, 'adoption_purpose', null, ['rows' => '3']) !!}
                    {!! Form::hidden('pet_id', $pet->id) !!}
                    {!! Form::checkbox('agreement', '1', 'I agree to pay 150.00 in adoption fees.') !!}
                    <button type="submit" class="btn btn-block btn-success">Send request</button>
                    {!! Form::close() !!}
                @endif
            </div>
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
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApzL1AXKwyfJT2tT5c5KkxFqnfv2txpQw&callback=initMap">
</script>
@endpush

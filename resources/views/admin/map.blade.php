@extends('layouts.admin')

@section('title', 'Map')

@section('content')
<div class="alert alert-info">
    Click on the marker to view details.
</div>
<div class="card">
    <div class="card-body p-0">
        <div id="map" style="width:100%;height: 570px"></div>
    </div>
</div>
@endsection

@push('js')
<script>
  function initMap() {
    var locations = @json($locations);
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: {
        lat: 10.3157,
        lng: 123.8854
      }
    });
    $.each(locations, function (i, location) {
        var marker = new google.maps.Marker({
            position: {
                lat: location['area_latitude'],
                lng: location['area_longitude'],
            },
            map: map,
            title: location['area']
        });
        var infowindow = new google.maps.InfoWindow({
          content: '<dl class="row">'+
            '<dt class="col-sm-3">Name</dt><dd class="col-sm-9">'+location['name']+'</dd>'+
            '<dt class="col-sm-3">Address</dt><dd class="col-sm-9">'+location['area']+'</dd>'+
            '<dt class="col-sm-3">Date</dt><dd class="col-sm-9">'+location['date_seized']+'</dd>'+
            '<dl>'
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    })
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApzL1AXKwyfJT2tT5c5KkxFqnfv2txpQw&callback=initMap">
</script>
@endpush

@extends('layouts.admin', ['hideNewEntryLink' => true])
@section('title', 'Adoption Requests')


@section('content')
@include('partials.search-bar', ['registrationStatus' => false])
<div class="row">
    @foreach($resourceList as $item)
      <div class="col-sm-3">
        <div class="card">
        <div style="height: 150px;background-image: url('{{ $item->photo_filepath }}');background-repeat: no-repeat;background-size: cover;background-position: center center">
        </div>
          <div class="card-body">
            <h5 class="card-title">{{ $item->pet_name }}</h5>
            <dl class="row">
              <dt class="col-sm-6">Species</dt>
              <dd class="col-sm-6 mb-0">{{ ucfirst($item->species) }}</dd>
              <dt class="col-sm-6">Breed</dt>
              <dd class="col-sm-6 mb-0">{{ $item->breed }}</dd>
              <dt class="col-sm-6">Request Count</dt>
              <dd class="col-sm-6 mb-0">{{ $item->adoption_requests_count }}</dd>
            </dl>
            <a href="{{ route('admin.pet-adoption-requests.index', $item->id) }}" class="btn btn-info mt-0 btn-sm btn-block" >Manage Requests</a>
          </div>
        </div>
      </div>
    @endforeach

  </div>
@endsection

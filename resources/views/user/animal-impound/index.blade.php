@extends('layouts.user')

@section('title', 'Impound Requests')
@section('content')
<div class="row">
    @foreach($resourceList as $item)
    <div class="col-sm-3">
        <div class="card">
        <div style="height: 150px;background-image: url('{{ $item->photo_filepath }}');background-repeat: no-repeat;background-size: cover;background-position: center center">
        </div>
          <div class="card-body">
            <h5 class="card-title">{{ $item->name }}</h5>
            <p class="card-text">{{ $item->description }}</p>
            <dl class="row">
              <dt class="col-sm-6">Type</dt>
              <dd class="col-sm-6">{{ ucfirst($item->animal_type) }}</dd>
              <dt class="col-sm-6">Vaccinated</dt>
              <dd class="col-sm-6">{{ $item->vaccination_status ? 'Yes' : 'No' }}</dd>
              <dt class="col-sm-6">Status</dt>
              <dd class="col-sm-6">{{ $item->adoption_status_text  }}</dd>
            </dl>
            <a href="{{ route('user.animal-impound.edit', $item->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
          </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

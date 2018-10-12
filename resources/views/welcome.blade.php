@extends('layouts.user')

@section('content')
<div class="container">

      @guest
      {{-- LANDING PAGE --}}
      <!-- Heading Row -->
      <div class="row my-4">
        <div class="col-lg-12">
          <img class="img-fluid rounded" src={{asset('image/LOGO2.jpg')}} alt="">
        </div>
      </div>
      <!-- /.row -->
      @else
            <!-- Call to Action Well -->
            <h4 class="pb-2 border-bottom mb-3">Pets for Adoption</h4>
            @include('partials.search-bar', ['registrationStatus' => false])
      <div class="row mt-3">
        @foreach($items as $item)
          <div class="col-sm-3">
            <div class="card">
            <div style="height: 150px;background-image: url('{{ $item->photo_filepath }}');background-repeat: no-repeat;background-size: cover;background-position: center center">
            </div>
              <div class="card-body">
                <h5 class="card-title">{{ $item->pet_name }}</h5>
                <dl class="row">
                  <dt class="col-sm-5">Species</dt>
                  <dd class="col-sm-7">{{ ucfirst($item->species) }}</dd>
                  <dt class="col-sm-5">Breed</dt>
                  <dd class="col-sm-7">{{ $item->breed }}</dd>
                </dl>
                @auth
                <a href="{{ route('user.adoption-request.create', ['pet_id' => $item->id]) }}" class="btn btn-success mt-0 btn-sm btn-block" >Adopt</a>
                @else
                <em><small><a data-toggle="modal" data-target="#registration-modal" href="#">Regisration</a> required  to adopt pet.</small></em>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
      @endguest


</div>
@endsection

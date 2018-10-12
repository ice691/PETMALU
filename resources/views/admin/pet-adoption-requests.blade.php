@extends('layouts.admin', ['hideNewEntryLink' => true])
@section('title', "Pet Adoption Requests")


@section('content')
<div class="form-row">
  <div class="col-sm-4">
    <div class="card">
        <img class="card-img-top" src="{{ $pet->photo_filepath }}" alt="Card image cap">
        <table class="table  table-hover mb-0">
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
                  <td><strong>Cage Number</strong></td>
                  <td>{{ $pet->cage_number }}</td>
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
    @if($pet->isAdopted())
      <div class="alert alert-success">
        This pet is already adopted.
      </div>
      <table class="table table-bordered table table-hover">
        <tbody>
          <tr>
            <td>Adopted by:</td>
            <td><a href="#">{{ $pet->approvedAdoptionRequest->requestor->name }} </a></td>
          </tr>
          <tr>
            <td>Date:</td>
            <td>{{ date_create($pet->approvedAdoptionRequest->adopted_at)->format('M d, Y h:i A') }}</td>
          </tr>
          <tr>
            <td>Adoption Purpose:</td>
            <td>{{ $pet->approvedAdoptionRequest->adoption_purpose }}</td>
          </tr>
          <tr>
            <td>Adoption Remarks:</td>
            <td>{{ $pet->approvedAdoptionRequest->adoption_remarks }}</td>
          </tr>
        </tbody>
      </table>
    @endif
    <div class="card mb-2">
      <div class="card-header">
          List of Requests
        </div>
        <table class="table table-hover mb-0 table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Purpose</th>
              <th>Date</th>
              <th>Actions</th>
              <th>Logs</th>
            </tr>
          </thead>
          <tbody>

              @forelse($pet->adoptionRequests as $item)
              <tr class="{{ optional($pet->approvedAdoptionRequest)->id === $item->id ? 'bg-success text-white' : '' }}">
              <td>
                <a href="javascript:void(0)" class="peeks-profile" data-profile="{{ $item->requestor->toJson() }}">{{ $item->requestor->name }}</a>
              </td>
              <td>{{ $item->adoption_purpose }}</td>
              <td>{{ date_create($item->created_at)->format('M d, Y h:i A') }}</td>
              <td>
                @if(!$pet->isAdopted())
                {!! Form::open(['url' => route('admin.adoption-request-notification', $item->id), 'method' => 'post', 'class' => 'ajax']) !!}
                <button type="submit" class="btn-warning btn"><i class="fa fa-envelope"></i></button>
                {!! Form::close() !!}
                @endif
              </td>
              <td></td>
              </tr>
              @empty
                <tr><td colspan="5" class="text-center text-info">No requests for this pet</td></tr>
              @endforelse

          </tbody>
        </table>
    </div>
    @if(!$pet->isAdopted())
    <div class="card">
      <div class="card-header">
        Adoption Details
      </div>
      <div class="card-body">
        {!! Form::open(['url' => route('admin.pet-adoption-requests.approve', $pet->id), 'method' => 'post', 'files' => true, 'class' => 'ajax']) !!}
          <div class="row">
            <div class="col-5">
              {!! Form::selectGroup('Award adoption to', 'adoption_request_id', $adoptionRequestDropdownFormat->prepend('* SELECT *', '')) !!}
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="form-group">
                  <label for="">Attach image</label>
                  <input type="file" name="photo" class="form-control pl-0" style="border:0">
                </div>
              </div>
            </div>
          </div>
          {!! Form::textareaGroup('Adoption Remarks', 'remarks', null, ['rows' => 3]) !!}
          <button type="submit" class="btn btn-submit btn-success">Save</button>

        {!! Form::close() !!}
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

@include('partials.profile-peek')

@push('js')
@endpush

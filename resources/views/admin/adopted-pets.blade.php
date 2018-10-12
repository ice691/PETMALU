@extends('layouts.admin', ['hideNewEntryLink' => true])
@section('title', "Reports: Adopted Pets")


@section('content')
<div class="row align-items-center">
  <div class="col-sm-10">
    <form class="form-inline">
        <div class="form-group mr-sm-3 mb-2">
          <label for="" class="mr-1">Pet Name</label>
          {!! Form::plainInput('text', 'pet_name', request()->pet_name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group mr-sm-3 mb-2">
          <label for="" class="mr-1">Start Date</label>
          {!! Form::plainInput('date', 'start_date', request()->start_date, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group mr-sm-1 mb-2">
          <label for="" class="mr-1">End Date</label>
          {!! Form::plainInput('date', 'end_date', request()->end_date, ['class' => 'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-info mb-2"><i class="fa fa-search"></i></button>
      </form>
  </div>
  <div class="col-sm-2 text-right">
    <h4>Count: <span class="badge badge-info">{{ $data->count() }}</span></h4>
  </div>
</div>
<table class="table mt-2 table-hover">
    <thead>
        <tr>
            <th>Pet</th>
            <th>Past Owner</th>
            <th>New Owner</th>
            <th>Date Adopted</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
      @forelse($data as $row)
        <tr>
          <td>
            <strong>{{ $row->pet_name }}</strong>
            <br>
            {{ ucfirst($row->species) }} ({{ ucfirst($row->breed) }})
          </td>
            <td>
                <a href="javascript:void(0)" class="peeks-profile" data-profile="{{ data_get($row, 'owner')->toJson() }}">
                    {{ data_get($row, 'owner.name') }}
                </a>
            </td>
          <td>
              <a href="javascript:void(0)" class="peeks-profile" data-profile="{{ data_get($row, 'approvedAdoptionRequest.requestor')->toJson() }}">
                  {{ data_get($row, 'approvedAdoptionRequest.requestor.name') }}
              </a>
          </td>
          <td>
            {{ date_create(data_get($row, 'approvedAdoptionRequest.adopted_at'))->format('M d, Y h:i A') }}
          </td>
          <td>
            <a href="{{ route('admin.adopted-pets.show', ['pet' => $row->id]) }}" class="btn btn-primary btn-sm" href="#">View full details</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center text-info">No adopted pet recorded</td>
        </tr>
      @endforelse
    </tbody>
</table>
@endsection

@include('partials.profile-peek')

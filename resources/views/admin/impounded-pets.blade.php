@extends('layouts.admin', ['hideNewEntryLink' => true])
@section('title', "Reports: Impounded Pets")


@section('content')<div class="row align-items-center">
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
<table class="table mt-0 table-hover">
    <thead>
        <tr>
            <th>Pet Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Date Registered</th>
            <th>Owner</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $row)
        <tr>
            <td>{{ $row->pet_name }}</td>
            <td>{{ ucfirst($row->species) }}</td>
            <td>{{ $row->breed ?: '-' }}</td>
            <td>{{ $row->created_at->format('m/d/Y h:i A') }}</td>
            <td>
                <a href="javascript:void(0)" class="peeks-profile" data-profile="{{ $row->owner->toJson() }}">
                    {{ $row->owner->name }}
                </a>
            </td>
            <td>
                <a href="{{ route('admin.pet-registration.edit', $row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center text-info">
                {{ request()->registration_status ? 'No data matched with filter' : 'No pets registered' }}
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

@include('partials.profile-peek')

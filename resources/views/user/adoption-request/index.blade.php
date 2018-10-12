@extends('layouts.user', ['hidePageHeader' => true])

@section('content')
<div class="card">
    <div class="card-body mb-0">
        <h4 class="card-title">Pet Adoption Requests</h4>
    </div>
    <div class="card-body p-0">
        <table class="table mt-0">
            <thead>
                <tr>
                    <th>Date Requested</th>
                    <th>Pet Name</th>
                    <th>Species</th>
                    <th>Breed</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($resourceList as $row)
                <tr>
                    <td>{{ $row->created_at->format('M d, Y h:i A') }}</td>
                    <td>{{ $row->pet->pet_name }}</td>
                    <td>{{ ucfirst($row->pet->species) }}</td>
                    <td>{{ ucfirst($row->pet->breed) }}</td>
                    <td>{{ $row->adoption_purpose }}</td>
                    <td>{{ ucfirst($row->request_status) }}</td>
                    <td>
                        {!! Form::open(['url' => route('user.adoption-request.cancel'), 'method' => 'POST', 'onsubmit' => "javascript: return confirm('Are you sure?')"]) !!}
                            {!! Form::hidden('id', $row->id)!!}
                            <button  type="submit" class="btn btn-danger btn-sm mt-2">Cancel</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-info">No pet requests registered</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

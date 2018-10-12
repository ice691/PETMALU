@extends('layouts.admin')

@section('title', 'Impounded Animals')
@section('content')
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Sex</th>
                    <th>Date Seized</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($resourceList as $row)
                <tr>
                    <td>
                        <img src="{{ $row->photo_filepath }}" alt="{{ $row->name }}" width="50" height="50">
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>{{ ucfirst($row->animal_type) }}</td>
                    <td>{{ ucfirst($row->sex) }}</td>
                    <td>{{ date_create($row->date_seized)->format('M d, Y') }}</td>
                    <td>{{ $row->area }}</td>
                    <td>{{ $row->adoption_status_text }}</td>
                    <td>
                        <a href="{{ route('admin.animal-adoption.edit', $row->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Edit</a>

                        {!! Form::open(['url' => route('admin.animal-adoption.destroy', $row->id), 'method' => 'DELETE', 'style' => 'display:inline-block']) !!}
                            <a href="#" class="btn btn-sm btn-danger trash-row"><i class="fa fa-trash"></i> Delete</a>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-info">No data to show</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

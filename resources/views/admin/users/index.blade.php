@extends('layouts.admin')

@section('title', 'Registered Users')
@section('content')
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender &amp; Civil Status</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($resourceList as $row)
                    <tr>
                        <td>
                            {{ $row->name }} <br>
                            <small class="text-info">Member since <em>{{ date_create($row->created_at)->format('M d, Y') }}</em></small>
                        </td>
                        <td>{{ ucfirst($row->gender) }} &mdash; {{ ucfirst($row->civil_status) }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->address ?: 'N/A' }}</td>
                        <td>{{ $row->mobile_number ?: 'N/A' }}</td>
                        <td>{!! $row->login_status ? '<span class="badge badge-success">Enabled</span>' : '<span class="badge badge-danger">Disabled</span>' !!}</td>
                        <td>
                            <a href="{{ MyHelper::resource('edit', ['id' => $row->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="1" class="text-center text-info">No data to show</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Report')
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
        </table>
    </div>
</div>
@endsection

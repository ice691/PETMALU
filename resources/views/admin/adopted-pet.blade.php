@extends('layouts.admin', ['hideNewEntryLink' => true])
@section('title', "Adoption Details")


@section('content')
<div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-header text-center">
        Adopted Pet Profile
      </div>
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
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header text-center">
            Past Owner Profile
          </div>
            <table class="table  table-hover mb-0">
              <tbody>
                  <tr>
                      <td><strong>Name</strong></td>
                      <td>{{ $pet->owner->name }} ({{ ucfirst($pet->owner->gender) }})</td>
                  </tr>
                  <tr>
                      <td><strong>Address</strong></td>
                      <td>{{ ucfirst($pet->owner->address) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Civil Status</strong></td>
                      <td>{{ ucfirst($pet->owner->civil_status) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Birthdate</strong></td>
                      <td>{{ date_create($pet->owner->birthdate)->format('M d, Y') }}</td>
                  </tr>
                  <tr>
                      <td><strong>Reason for impound</strong></td>
                      <td>{{ $pet->reason }}</td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header text-center">
            New Owner Profile
          </div>
            <table class="table  table-hover mb-0">
              <tbody>
                  <tr>
                      <td><strong>Name</strong></td>
                      <td>{{ data_get($pet, 'approvedAdoptionRequest.requestor.name') }} ({{ data_get($pet, 'approvedAdoptionRequest.requestor.gender') }})</td>
                  </tr>
                  <tr>
                      <td><strong>Address</strong></td>
                      <td>{{ data_get($pet, 'approvedAdoptionRequest.requestor.address') }}</td>
                  </tr>
                  <tr>
                      <td><strong>Civil Status</strong></td>
                      <td>{{ ucfirst(data_get($pet, 'approvedAdoptionRequest.requestor.civil_status')) }}</td>
                  </tr>
                  <tr>
                      <td><strong>Birthdate</strong></td>
                      <td>{{ date_create(data_get($pet, 'approvedAdoptionRequest.requestor.birthdate'))->format('M d, Y') }}</td>
                  </tr>
                  <tr>
                      <td><strong>Purpose for adoption</strong></td>
                      <td>{{ data_get($pet, 'approvedAdoptionRequest.adoption_purpose') }}</td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card text-white mt-3">
      <img class="card-img" src="{{ data_get($pet, 'approvedAdoptionRequest.proof_of_adoption_filepath') }}" alt="Card image">
      <div class="card-img-overlay">
        <h5 class="card-title text-uppercase">Proof of adoption</h5>
      </div>
    </div>
  </div>
</div>
@endsection

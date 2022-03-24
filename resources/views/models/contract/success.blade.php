@extends('layouts.app')

@section('content')
    <!--
    <div class="col-md-6 offset-md-3">
    <x-forms.alert title="SUCCESS" message="Contract Created Successfully!" type="success" />
    </div>
    -->
    <div class="card col-md-6 offset-md-3">
        <div class="card-header text-center">
            <h4>Contract successfully taken</h4>
        </div>
        <div class="card-body">
            <div><b>Congratulations!</b> You have received the Contract.<br>All informations will follow shortly. Please check your SMS-Inbox.</div>
            <table class="table table-striped mt-2">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Latitude</th>
                        <td>{{ $contract->lat }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Longitude</th>
                        <td>{{ $contract->lon }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Location</th>
                        <td>{{ $contract->postcode->codename }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Firstname</th>
                        <td>{{ $contract->contact_firstname }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Lastname</th>
                        <td>{{ $contract->contact_lastname }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone</th>
                        <td>{{ $contract->contact_phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Additional Information</th>
                        <td>{{ $contract->info }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

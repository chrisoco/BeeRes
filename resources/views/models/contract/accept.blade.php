@extends('layouts.app')

@section('content')
<div class="container">
    <!--
    <div class="col-md-6 offset-md-3">
    <x-forms.alert title="SUCCESS" message="Contract Created Successfully!" type="success" />
    </div>
    -->
    <div class="card col-md-6 offset-md-3">

        <div class="card-header text-center">
            <h4>Contract available!</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('contract.accept', $contract->id) }}">
                @csrf
                @method('POST')

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Info</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Location</th>
                            <td>{{ $contract->postcode->codename }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="fw-bold">
                    Once the contract has been accepted and handed over, it is binding and must be fulfilled!
                </div>

                <div class="form-group">
                    <input class="@error('acc') is-invalid @enderror" type="checkbox" name="acc" id="acc">
                    <label class="form-label mt-4" for="acc">
                        I have read and agree to the terms and conditions.<span class="text-danger">*</span>
                    </label>
                    @error('acc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input class="btn btn-block btn-success mt-3" type="submit" value="Accept" />

            </form>
        </div>
    </div>

</div>

@endsection

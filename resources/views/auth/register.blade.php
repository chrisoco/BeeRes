@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card col-md-6 offset-md-3">

        <div class="card-header text-center">
            <h4>Beekeeper-Register</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                @method('POST')

                <x-forms.input type="text" name="firstname" title="Firstname" />
                <x-forms.input type="text" name="lastname" title="Lastname" />
                <x-forms.input type="text" name="phone" title="Phone" />
                <x-forms.input type="email" name="email" title="E-Mail" />
                <x-forms.password confirm="true" />

                <div class="form-group">
                    <input class="custom-checkbox @error('agb') is-invalid @enderror" type="checkbox" name="agb" id="agb" value="{{ old('agb') }}">
                    <label class="form-label mt-4" for="agb">AGB Accepted<span class="text-danger">*</span></label>
                    @error('agb')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input class="btn btn-block btn-primary mt-3" type="submit" value="Register" />

            </form>
        </div>
    </div>

</div>

@endsection

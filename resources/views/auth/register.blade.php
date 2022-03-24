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

                <x-forms.input type="text"  name="firstname" title="Firstname" value="{{ old('firstname') }}" />
                <x-forms.input type="text"  name="lastname"  title="Lastname"  value="{{ old('lastname') }}" />
                <x-forms.input type="text"  name="phone"     title="Phone"     value="{{ old('phone') }}" placeholder="076 581 35 96" />
                <x-forms.input type="email" name="email"     title="E-Mail"    value="{{ old('email') }}" />
                <x-forms.password confirm="true" />

                <div class="form-group mt-4">
                    <input class="@error('agb') is-invalid @enderror" type="checkbox" name="agb" id="agb">
                    <span>I hereby confirm that I have taken note that my contact information may be disclosed for the beekeeper search<span class="text-danger">*</span></span>
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

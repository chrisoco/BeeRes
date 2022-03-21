@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card col-md-6 offset-md-3">

        <div class="card-header text-center">
            <h4>Beekeeper-Register</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('contract.store') }}">
                @csrf
                @method('POST')

                <x-forms.number name="lat" title="Latitude"  min="47" max="48" placeholder="47.39036" value="{{ old('lat') }}" />
                <x-forms.number name="lon" title="Longitude" min="8" max="9" placeholder="8.49087" value="{{ old('lon') }}" />

                <hr />
                <h4 class="text-center">Contact Information</h4>
                <x-forms.input type="text"  name="contact_firstname" title="Firstname" value="{{ old('contact_firstname') }}" required="false" />
                <x-forms.input type="text"  name="contact_lastname" title="Lastname" value="{{ old('contact_lastname') }}" required="false" />
                <x-forms.input type="text"  name="contact_phone" title="Phone" value="{{ old('contact_phone') }}" required="false" />

                <x-forms.textarea name="info" title="Additional Information" value="{{ old('info') }}" required="false" />


                <input class="btn btn-block btn-primary mt-3" type="submit" value="Register" />

            </form>
        </div>
    </div>

</div>

@endsection

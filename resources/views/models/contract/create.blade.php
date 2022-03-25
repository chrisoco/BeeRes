@extends('layouts.app')

@section('content')
    <div class="card col-md-8 col-lg-4 offset-md-2 offset-lg-4">
        <div class="card-header text-center">
            <h4>Contract-Create</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('contract.store') }}">
                @csrf
                @method('POST')
                @error('plz-api')
                <x-forms.alert title="Error" message="{{ $message }}" type="danger" />
                @enderror
                <x-forms.number name="lat" title="Latitude"  min="47" max="48" placeholder="47.39036" value="{{ old('lat') }}" step=".00001" />
                <x-forms.number name="lon" title="Longitude" min="8"  max="9"  placeholder="8.49087"  value="{{ old('lon') }}" step=".00001" />
                @error('plz-api')
                <x-forms.number name="plz" title="Postcode" min="8000" max="9000" placeholder="8048" value="{{ old('plz') }}" step="1" required="false" />
                @enderror
                <hr />
                <h4 class="text-center">Contact Information</h4>
                <x-forms.input type="text"  name="contact_firstname" title="Firstname" value="{{ old('contact_firstname') }}" required="false" />
                <x-forms.input type="text"  name="contact_lastname"  title="Lastname"  value="{{ old('contact_lastname') }}"  required="false" />
                <x-forms.input type="text"  name="contact_phone"     title="Phone"     value="{{ old('contact_phone') }}"     required="false" placeholder="076 581 35 96" />
                <x-forms.textarea name="info" title="Additional Information" value="{{ old('info') }}" required="false" />
                <input class="btn btn-block btn-primary mt-3" type="submit" value="Create Contract" />
            </form>
        </div>
    </div>
    </div>
@endsection

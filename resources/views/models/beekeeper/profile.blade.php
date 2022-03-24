@extends('layouts.app')

@section('content')
    <div class="card col-md-8 col-lg-6 offset-md-2 offset-lg-3">
        <div class="card-header text-center">
            <h4>Profile</h4>
        </div>
        <div class="card-body pt-0">
            <form method="POST" action="">
                @csrf
                @method('PUT')
                <x-forms.input type="text"     name="firstname" title="Firstname"    value="{{ $beekeeper->firstname }}"   />
                <x-forms.input type="text"     name="lastname"  title="Lastname"     value="{{ $beekeeper->lastname }}"    />
                <x-forms.input type="text"     name="phone"     title="Phone"        value="{{ $beekeeper->phone }}"       />
                <x-forms.input type="email"    name="email"     title="E-Mail"       value="{{ $beekeeper->user->email }}" />
                <x-forms.input type="password" name="old_pw"    title="Old Password" value="" />
                <x-forms.password confirm="true" />
                <input class="btn btn-block btn-success mt-3" type="button" value="Update" />
                <button class="btn btn-danger btn-block my-2" type="button">Delete</button>
                <a href="{{ route('jurisdiction') }}" class="btn btn-secondary btn-block">PLZ - Jurisdiction</a>
            </form>
        </div>
    </div>
@endsection

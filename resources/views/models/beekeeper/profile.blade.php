@extends('layouts.app')

@section('style')
@endsection

@section('content')
    <div class="container">

        <div class="card col-md-6 offset-md-3">

            <div class="card-header text-center">
                <h1>PROFILE</h1>
                <p class="text-danger">Wird nicht im Rahmen der IPA realisiert.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')

                    <x-forms.input type="text" name="firstname" title="Firstname" />
                    <x-forms.input type="text" name="lastname" title="Lastname" />
                    <x-forms.input type="text" name="phone" title="Phone" />
                    <x-forms.input type="email" name="email" title="E-Mail" />
                    <x-forms.input type="password" name="old_pw" title="Old Password" />
                    <x-forms.password confirm="true" />

                    <input class="btn btn-block btn-success mt-3" type="button" value="Update" />
                    <button class="btn btn-danger btn-block my-2" type="button">Delete</button>
                    <a href="{{ route('jurisdiction') }}" class="btn btn-secondary btn-block">PLZ - Jurisdiction</a>

                </form>
            </div>
        </div>



    </div>
@endsection

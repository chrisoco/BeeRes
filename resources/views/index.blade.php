@extends('layouts.app')

@section('style')
    @auth @else
    <style>
        @media (min-width: 768px) {
            .col-md-border:not(:last-child) {
                border-right: 2px solid #d7d7d7;
            }
        }
    </style>
    @endauth
@endsection

@section('content')
@auth
    @include('imker_search')
@else

    <div class="container-fluid">
        <div class="row" style="min-height: 70vh;">

            <div class="col-md-6 col-md-border d-flex justify-content-center m-auto">

                <div class="h-100 w-100">

                    @include('imker_search')

                </div>

            </div>

            <div class="col-md-6 col-md-border d-flex justify-content-center m-auto">

                <div class="w-100 w-100">

                    @include('auth.login')

                </div>

            </div>

        </div>
    </div>
@endauth
@endsection

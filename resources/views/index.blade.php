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
    IMKER SEARCH
@else

    <div class="container-fluid">
        <div class="row" style="min-height: 70vh;">

            <div class="col-md-6 col-md-border d-flex justify-content-center justify-content-md-end mb-5 pe-md-5">

                <div class="h-100">

                    IMKER-Search

                </div>

            </div>

            <div class="col-md-6 col-md-border d-flex justify-content-center m-auto">

                <div class="w-100">

                    @include('auth.login')

                </div>

            </div>

        </div>
    </div>
@endauth
@endsection

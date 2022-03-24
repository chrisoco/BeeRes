@extends('layouts.app')

@section('style')

    <style>
        @media (min-width: 768px) {
            .col-md-border:not(:last-child) {
                border-right: 2px solid #d7d7d7;
            }
        }
    </style>

@endsection

@section('content')

<div class="container-fluid">
    <div class="row" style="min-height: 70vh;">
        <!-- LEFT SIDE -->
        <div class="col-md-6 col-md-border d-flex justify-content-center m-auto">
            <div class="h-100 w-100">
                <div class="card col-lg-8 offset-lg-2 mb-2 mb-lg-0">
                    <div class="card-header text-center"><h4>Active PLZ</h4></div>

                    <div class="card-body overflow-auto" style="height: 20rem">

                        <form action="{{ route('jurisdiction.update') }}" method="POST" id="jurisdictionForm">
                            @csrf
                            @method('POST')

                            <div class="d-none" id="delJur"></div>
                            <div class="d-none" id="addJur"></div>

                            <div class="list-group" id="currentJur">
                                @foreach($postcodes as $postcode)
                                    <div class="list-group-item list-group-item-action">
                                        {{ $postcode->postcode . ' | ' . $postcode->name }}
                                        <button type="button" class="btn btn-danger float-end" onclick="del({{ $postcode->id }}, this.parentElement)">X</button>
                                    </div>
                                @endforeach

                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <button form="jurisdictionForm" type="submit" class="btn btn-success btn-block">Speichern</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->

        <div class="col-md-6 col-md-border d-flex justify-content-center m-auto">
            <div class="h-100 w-100">

                <div class="card col-lg-8 offset-lg-2 mb-2 mb-lg-0">
                    <div class="card-header text-center"><h4>Search PLZ</h4></div>

                    <div class="card-body" style="height: 20rem">

                        <input type="text" class="form-control" id="searchInput" onkeyup="search(this)" placeholder="PLZ Search" autocomplete="off">

                        <div class="list-group overflow-auto" style="max-height: 15.5rem" id="searchOutput"></div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<script>const searchURL = '{{ route('search.plz') }}';</script>
<script src="{{ asset('js/jurisdiction.js') }}"></script>
@endsection

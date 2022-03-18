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
    <script>

        function del(id, el) {

            const delJur = document.getElementById('delJur');

            let duplicate = false;

            document.getElementsByName('delJur[]').forEach(element => {
                if(element.value == id) {
                    duplicate = true;
                    element.remove();
                }
            });

            if(duplicate) {
                el.style.border = '1px solid rgba(0, 0, 0, 0.125)';

            } else {
                el.style.border = '1px solid red';

                let input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'delJur[]');
                input.setAttribute('value', id);

                delJur.append(input);
            }

        }
    </script>

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

                            <div class="list-group" id="">
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



            </div>
        </div>

    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Home') }}</div>

                    <div class="card-body">
                        Welcome to SweetMUN !!!<br>
                        <ol class="list-group">
                            @foreach($conferences as $conference)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#collapse_conference_{{$conference}}"
                                >
                                    {{$conference}}
                                </li>
                                <div class="collapse" id="collapse_conference_{{$conference}}">
                                    hi
                                </div>
                            @endforeach

                        </ol>
                        <a href="{{route('app.conference.add')}}">Add Conference</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

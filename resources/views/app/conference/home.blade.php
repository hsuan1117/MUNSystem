@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Home') }}</div>

                    <div class="card-body">
                        Welcome to SweetMUN !!!<br>
                        @if (count($userData->conferences) == 0)
                            <div class="alert alert-danger">
                                You don't have any conference!
                            </div>
                        @endif
                        <ol class="list-group">
                            @foreach($confData as $confID=>$conference)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#collapse_conference_{{$confID}}"
                                >
                                    {{$conference}}
                                </li>
                                <div class="collapse" id="collapse_conference_{{$confID}}">
                                    <div> ID: {{$confID}}</div>
                                    <current-step endpoint="{{route('app.conference.action.getStep',$confID)}}"></current-step>
                                    <div>
                                        <a href="{{route('app.conference.conference',$confID)}}"
                                           class="btn btn-sm btn-success ">Conference Page</a>
                                    </div>
                                </div>
                            @endforeach

                        </ol>
                        <br>
                        <div class="btn-group-vertical w-100">
                            <a href="{{route('app.conference.add')}}" class="btn btn-primary">Add Conference</a>
                            <br>
                            <a href="{{route('app.conference.join')}}" class="btn btn-info ">Join Conference</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Votes') }}</div>

                    <div class="card-body">
                        Votes<br>
                        <ol class="list-group">
                            @foreach($votes as $vote)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#collapse_conference_{{$vote}}"
                                >
                                    {{$infos[$vote]}}
                                </li>
                                <div class="collapse" id="collapse_conference_{{$vote}}">
                                    <div> ID: {{$vote}}</div>
                                    <div>
                                        <!--TODO: MUST Implement Voting Page-->
                                        <a href="{{route('app.conference.voting.voting',[$conf_id,$vote])}}"
                                           class="btn btn-sm btn-success ">Voting Page</a>
                                    </div>
                                </div>
                            @endforeach

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

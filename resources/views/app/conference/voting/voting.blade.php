@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Voting') }}</div>

                    <div class="card-body">
                        Welcome to <b>{{Session::get('ConferenceName','Conference')}}</b> (ID: {{$conf_id}}) !!!<br>

                        <ol class="list-group">
                            <li class="alert bg-info d-flex justify-content-between align-items-center bg-success">
                                <div>Yes : {{$votesCount["Yes"]}}</div>
                                <div>No  : {{$votesCount["No"]}}</div>
                                <div>Abstain : {{$votesCount["Abstain"]}}</div>
                            </li>
                            @foreach($roles as $role=>$account)
                                @if($admin)
                                    <voting
                                        endpoint="{{route('app.conference.action.voting.change',[$conf_id,$vote_id])}}"
                                        vote="{{$votes[$role] ?? json_encode([
                                            'role'=>$role,
                                            'voting'=>'Yes'
                                        ])}}"
                                        id="{{$vote_id}}"
                                        :admin="true"
                                    ></voting>
                                @else
                                    <voting
                                        endpoint="{{route('app.conference.action.voting.change',[$conf_id,$vote_id])}}"
                                        vote="{{$votes[$role] ?? json_encode(array([
                                            'role'=>$role,
                                            'voting'=>'Yes'
                                        ]))}}"
                                        id="{{$vote_id}}"
                                        :admin="false"
                                    ></voting>
                                @endif
                            @endforeach
                        </ol>
                    <!--<div class="btn-group-vertical w-100">
                            <a href="{{route('app.conference.add')}}" class="btn btn-primary">Add Conference</a>
                            <a href="{{route('app.conference.add')}}" class="btn btn-info disabled">Join Conference</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

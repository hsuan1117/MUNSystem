@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Roll Call') }}</div>

                    <div class="card-body">
                        Welcome to <b>{{Session::get('ConferenceName','Conference')}}</b> (ID: {{$conf_id}}) !!!<br>

                        <ol class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-success">
                                <div>P : {{$rollCallsCount["P"]}}</div>
                                <div>PV : {{$rollCallsCount["PV"]}}</div>
                                <div>A : {{$rollCallsCount["A"]}}</div>
                            </li>
                            @foreach($roles as $role=>$account)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#collapse_role_{{md5($role)}}"
                                >
                                    {{$role}}
                                </li>
                                <div class="collapse show " id="collapse_role_{{md5($role)}}">
                                    <roll-call
                                        :endpoint="'{{route('app.conference.action.roleCall.change',$conf_id)}}'"
                                        :role="'{{$role}}'"
                                        :status="'{{$rollCalls[$role]}}'"
                                    ></roll-call>
                                </div>
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

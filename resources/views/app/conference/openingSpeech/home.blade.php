@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Opening Speech') }}</div>

                    <div class="card-body">
                        Welcome to <b>{{Session::get('ConferenceName','Conference')}}</b> (ID: {{$conf_id}}) !!!<br>
                        Edit and reload page to see words effects!!<br>
                        <count-down deadline="2020-08-08T12:00:00.000+08:00"></count-down>
                        <ol class="list-group">
                            {{$EZTime}}
                            @foreach($roles as $role=>$account)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#collapse_role_{{$role}}"
                                >
                                    {{$role}} <span class="badge pull-right">{{strlen($speeches[$role]??'')}} words</span>
                                </li>
                                <div class="collapse " id="collapse_role_{{$role}}">
                                    <opening-speech
                                        endpoint="{{route('app.conference.action.openingSpeech.change',$conf_id)}}"
                                        role="{{$role}}"
                                        :article="`{{$speeches[$role] ?? ""}}`"
                                    ></opening-speech>
                                </div>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

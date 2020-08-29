@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Role Home') }}</div>

                    <div class="card-body">
                        Welcome to SweetMUN !!!<br>
                        roles: {{count($roles)}}
                        <ol class="list-group">
                            @foreach($roles as $role=>$account)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#collapse_role_{{md5($role)}}"
                                >
                                    {{$role}}
                                </li>
                                <div class="collapse" id="collapse_role_{{md5($role)}}">
                                    @foreach($account as $user)
                                        <ol>{{$user}}</ol>
                                    @endforeach
                                </div>
                            @endforeach
                        </ol>
                        <br>
                        <a href="{{route('app.conference.role.add',$conf_id)}}" class="btn btn-primary">Add Role</a>
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

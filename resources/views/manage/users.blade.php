@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users list') }}</div>
                    <!--<div class="alert alert-danger">If you don't see anything, that means you don't have permission.</div>-->
                    <div class="card-body">
                        <ol class="list-group">
                            @foreach($users as $user)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#collapse_user_{{$user->id}}"
                                >
                                    {{$user->name}}
                                    <!--<span class="badge badge-primary badge-pill">1</span>
                                    <span class="badge badge-warning badge-pill">1</span>-->
                                    <div class="float-right">
                                        {{$user->email}}
                                    </div>
                                </li>
                                <div class="collapse" id="collapse_user_{{$user->id}}">
                                    <div class="card card-body">
                                        {{gettype($user->conferences)}}
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

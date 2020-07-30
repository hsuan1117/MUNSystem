@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users list') }}</div>

                    <div class="card-body">
                        @permitTo('CreateAdmin')
                        <ol class="list-group">
                            @foreach($users as $user)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$user->name}}
                                    <!--<span class="badge badge-primary badge-pill">1</span>
                                    <span class="badge badge-warning badge-pill">1</span>-->
                                    <div class="float-right">
                                        {{$user->email}}
                                    </div>
                                </li>
                            @endforeach

                        </ol>
                        @endpermitTo
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

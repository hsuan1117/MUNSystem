@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference') }}</div>

                    <div class="card-body">
                        {{$conf_id}}
                        {{gettype($conf_data)}}<br>
                        <a href="{{route('app.conference.role.home',$conf_id)}}" class="btn btn-primary">Conference Roles</a>
                        <a href="{{route('app.conference.roleCall.home',$conf_id)}}" class="btn btn-primary">Roll Call</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

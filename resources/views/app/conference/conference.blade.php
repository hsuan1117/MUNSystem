@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference') }}</div>

                    <div class="card-body">
                        <current-step endpoint="{{route('app.conference.action.getStep',$conf_id)}}"></current-step>
                        {{gettype($conf_data)}}<br>
                        <a href="{{route('app.conference.role.home',$conf_id)}}" class="btn btn-primary">Conference Roles (Countries)</a>
                        <a href="{{route('app.conference.roleCall.home',$conf_id)}}" class="btn btn-primary">Roll Call</a>
                        <a href="{{route('app.conference.openingSpeech.home',$conf_id)}}" class="btn btn-primary">Opening Speech</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

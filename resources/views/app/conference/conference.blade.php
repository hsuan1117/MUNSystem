@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference') }}</div>

                    <div class="card-body">
                        <current-step endpoint="{{route('app.conference.action.getStep',$conf_id)}}"></current-step>
                        <!--{{gettype($conf_data)}}<br>-->
                        <div class="container">
                            <div class="list-group">
                                <a href="{{route('app.conference.role.home',$conf_id)}}" class="list-group-item list-group-item-action">Conference Roles (Countries)</a>
                                <a href="{{route('app.conference.roleCall.home',$conf_id)}}" class="list-group-item list-group-item-action">Roll Call</a>
                                <a href="{{route('app.conference.openingSpeech.home',$conf_id)}}" class="list-group-item list-group-item-action">Opening Speech</a>
                                <a href="{{route('app.conference.amendment.home',$conf_id)}}" class="list-group-item list-group-item-action">Amendment</a>
                                <a href="{{route('app.conference.note.home',$conf_id)}}" class="list-group-item list-group-item-action">Note</a>
                                <a href="{{route('app.conference.voting.home',$conf_id)}}" class="list-group-item list-group-item-action">Vote</a>
                                <a href="{{route('app.conference.settings.home',$conf_id)}}" class="list-group-item list-group-item-action">Settings</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

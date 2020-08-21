@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Amendment') }}</div>

                    <div class="card-body">
                        Welcome to <b>{{Session::get('ConferenceName','Conference')}}</b> (ID: {{$conf_id}}) !!!<br>
                        <ol class="list-group">
                            @foreach($amendments as $amendment)
                                @if($admin)
                                    <amendment
                                        endpoint="{{route('app.conference.action.amendment.change',$conf_id)}}"
                                        accept-endpoint="{{route('app.conference.action.amendment.accept',$conf_id)}}"
                                        amendment="{{$amendment}}"
                                        :admin="true"
                                    ></amendment>
                                @else
                                    <amendment
                                        endpoint="{{route('app.conference.action.amendment.change',$conf_id)}}"
                                        accept-endpoint="{{route('app.conference.action.amendment.accept',$conf_id)}}"
                                        amendment="{{$amendment}}"
                                        :admin="false"
                                    ></amendment>
                                @endif
                            @endforeach
                        </ol>
                        <br>
                        <a href="{{route('app.conference.amendment.add',$conf_id)}}" class="btn btn-primary w-100">Add Amendment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

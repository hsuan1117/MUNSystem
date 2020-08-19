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
                                <amendment
                                    endpoint="{{route('app.conference.action.amendment.change',$conf_id)}}"
                                    amendment="{{$amendment}}"></amendment>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

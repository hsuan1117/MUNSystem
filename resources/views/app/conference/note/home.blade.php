@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Note') }}</div>

                    <div class="card-body">
                        Welcome to <b>{{Session::get('ConferenceName','Conference')}}</b> (ID: {{$conf_id}}) !!!<br>
                        <ol class="list-group">
                            @foreach($notes as $note)
                                @if($admin)
                                    <note
                                        endpoint="{{route('app.conference.action.note.change',$conf_id)}}"
                                        accept-endpoint="{{route('app.conference.action.note.accept',$conf_id)}}"
                                        note="{{$note}}"
                                        :admin="true"
                                    ></note>
                                @else
                                    <note
                                        endpoint="{{route('app.conference.action.note.change',$conf_id)}}"
                                        accept-endpoint="{{route('app.conference.action.note.accept',$conf_id)}}"
                                        note="{{$note}}"
                                        :admin="false"
                                    ></note>
                                @endif
                            @endforeach
                        </ol>
                        <br>
                        <a href="{{route('app.conference.note.add',$conf_id)}}" class="btn btn-primary w-100">Add Note</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
